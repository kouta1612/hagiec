<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use App\Item;

class AdminItemsController extends Controller
{
    /** 商品情報ダウンロード */
    public function downloadCSV() {
        $items = Item::all();
        $csv = $this->csv_format($items);
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
                'Content-Disposition' => 'attachment; filename="items.csv"',
            ]
        );
    }

    /** 商品情報アップロード */
    public function uploadCSV(Request $request) {
        $this->validate($request, [
            'csv_file' => 'required|mimes:txt'
        ]);
        $uploaded_file = $request->file('csv_file');
        $file_path = $uploaded_file->path();
        $file = fopen($file_path, "r");
        $csv = array();
        $i = 0;
        while($line = fgetcsv($file)) {
            if($i > 0) {
                mb_convert_variables('UTF-8', 'SJIS-win', $line);
                $csv[] = array(
                    'id'            => $line[0], 
                    'name'          => $line[1], 
                    'price'         => $line[2], 
                    'category_id'   => $line[3], 
                    'country'       => $line[4], 
                    'description'   => $line[5], 
                    'delivery_date' => $line[6],
                    'image_url'     => $line[7], 
                    'stock_number'  => $line[8],
                );
            }
            $i++;
        }
        fclose($file);

        // 商品テーブル更新
        Item::truncate_insert($csv);

        return redirect('/admin');
    }

    /** private */

    /** CSV出力データの格納 */
    private function csv_format($items) {
        $row = [];
        $row[] = array('商品ID', '商品名', '金額', 'カテゴリID', '原産国', '商品説明', '配送日数', '商品画像URL', '在庫数');
        foreach($items as $item) {
            $col = [$item->id, $item->name, $item->price, $item->category_id, $item->country, $item->description, $item->delivery_date, $item->image_url, $item->stock_number];
            $row[] = $col;
        }
        return $row;
    }

}
