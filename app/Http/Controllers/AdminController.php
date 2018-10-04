<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
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
        $a = $orders_in_month->toArray();
        dd($orders_in_month->toArray());
        dd([
                ['id', 'name', 'age'],
                ['1', 'tanaka', '20'],
            ]);
        $total_price = 0;
        foreach ($orders_in_month as $order_in_month) {
            $total_price += $order_in_month->price;
        }

        if(isset($_GET["csv"])) {
            return $this->downloadCSV($orders_in_month);
        }
        return view('/admin/earnings', compact('selected_year', 'selected_month', 'total_price', 'orders_in_month'));
    }

    /** 選択した日付の注文番号と合計金額を取得 */
    public function select_earning_data($selected_day) {

        $selected_year = date_format($selected_day, 'Y');
        $selected_month = date_format($selected_day, 'm');

        $orders_in_month = DB::table('orders')
            ->select(DB::raw('sum(items.price) as price, orders.id as id'))
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('items', 'order_details.item_id', '=', 'items.id')
            ->whereYear('orders.order_time', '=', $selected_year)
            ->whereMonth('orders.order_time', '=', $selected_month)
            ->groupBy('orders.id')
            ->get();
        
        return $orders_in_month;
    }

    /** CSVダウンロード */
    public function downloadCSV($orders_in_month) {

        return new StreamedResponse(
            function() {
                $csv = $orders_in_month->toArray();
                // $csv = [
                //     ['id', 'name', 'age'],
                //     ['1', 'tanaka', '20'],
                // ];
                // $csv = User::all(['id', 'name'])->toArray();
                $stream = fopen('php://output', 'w');
                foreach($csv as $line) {
                    $line = $line.toArray();
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

}
