<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use App\OrderDetail;
use Carbon\Carbon;
use App\Order;
use App\Item;
use App\User;
use DB;

class AdminController extends Controller
{
    public function index() {

        return view('/admin/index');
    }

    /** 月別の商品をすべて取得 */
    public function show_earning(Request $request) {

        $selected_day = new Carbon($request->input('month'));
        $selected_year = date_format($selected_day, 'Y');
        $selected_month = date_format($selected_day, 'm');
        $orders_in_month = $this->select_earning_data($selected_day);
        $total_price = 0;
        foreach ($orders_in_month as $order_in_month) {
            $total_price += $order_in_month->price;
        }
        if(isset($_GET["csv"])) {
            $csv = $this->csv_format($orders_in_month, $total_price);
            $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');
            return $this->downloadCSV($csv);
        }
        return view('/admin/earnings', compact('selected_year', 'selected_month', 'total_price', 'orders_in_month'));
    }

    /** 選択した日付の注文番号と注文金額を取得 */
    public function select_earning_data($selected_day) {

        $selected_year = date_format($selected_day, 'Y');
        $selected_month = date_format($selected_day, 'm');

        $sub = Order::select('o.id as id')
            ->selectRaw('od.payment_number * i.price as p')
            ->from('orders as o')
            ->join('order_details as od', 'o.id', '=', 'od.order_id')
            ->join('items as i', 'od.item_id', '=', 'i.id')
            ->toSql();

        $orders_in_month = DB::table(DB::raw("({$sub}) as sub"))
            ->select('sub.id as id')
            ->selectRaw('sum(sub.p) as price')
            ->groupBy('sub.id')
            ->get();

        return $orders_in_month;
    }

    /** CSV出力するデータの格納 */
    public function csv_format($orders_in_month, $total_price) {
        $row = [];
        $row[] = array('注文番号', '注文金額', '合計金額');
        foreach ($orders_in_month as $id => $order) {
            if ($id == 0) {
                $col = [$order->id, $order->price, $total_price];
            } else {
                $col = [$order->id, $order->price];
            }
            $row[] = $col;
        }
        return $row;
    }

    /** CSVダウンロード */
    public function downloadCSV($csv) {
        return new StreamedResponse(
            function() use ($csv) {
                $stream = fopen('php://output', 'w');
                foreach($csv as $line) {
                    fputcsv($stream, $line);
                }
                fclose($stream);
            },
            200,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="users.csv"',
            ]
        );
    }

    public function show_earning_detail($id) {
        $earning_detail_datas = select(DB::raw(
                'order_details.id as id, 
                items.name as name, 
                order_details.price as price, 
                order_details.payment_number as number, 
                order_details.price * order_details.payment_number as total_price'
            ))
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('items', 'items.id', '=', 'order_details.item_id')
            ->where('orders.id', '=', $id)
            ->get();

        return view('/admin/earning_detail', compact('earning_detail_datas'));
    }

}
