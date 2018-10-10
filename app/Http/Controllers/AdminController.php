<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use App\OrderDetail;
use Carbon\Carbon;
use App\Http\Test;
use SplFileObject;
use App\Order;
use App\Item;
use App\User;
use DB;

class AdminController extends Controller
{
    public function index() {
        return view('/admin/index');
    }

    public function show_items() {
        $items = Item::all();
        return view('/admin/items', compact('items'));
    }
    
    /** 月別商品情報取得 */
    public function show_earning(Request $request) {
        $selected_day = new Carbon($request->input('month'));
        $selected_year = date_format($selected_day, 'Y');
        $selected_month = date_format($selected_day, 'm');
        $orders_in_month = $this->select_earning_data($selected_day);
        $total_price = $this->order_price($orders_in_month);
        return view('/admin/earnings', compact('selected_year', 'selected_month', 'total_price', 'orders_in_month'));
    }

    /** 注文詳細情報取得 */
    public function show_earning_detail($id) {
        $earning_detail_datas = Order::select_earning_detail($id);

        return view('/admin/earning_detail', compact('earning_detail_datas'));
    }

    /** CSVダウンロード */
    public function downloadCSV(Request $request) {
        $selected_day = new Carbon($request->input('month'));
        $orders_in_month = $this->select_earning_data($selected_day);
        $total_price = $this->order_price($orders_in_month);
        $csv = $this->csv_format($orders_in_month, $total_price);
        $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');
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

    /** private */

    /** 選択日付の注文番号と注文金額を取得 */
    private function select_earning_data($selected_day) {

        $selected_year = date_format($selected_day, 'Y');
        $selected_month = date_format($selected_day, 'm');
        
        $orders_in_month = Order::select_earning_data($selected_year, $selected_month);

        return $orders_in_month;
    }

    /** 注文金額計算 */
    private function order_price($orders_in_month) {
        $total_price = 0;
        foreach ($orders_in_month as $order_in_month) {
            $total_price += $order_in_month->price;
        }
        return $total_price;
    }

    /** CSV出力データの格納 */
    private function csv_format($orders_in_month, $total_price) {
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

}
