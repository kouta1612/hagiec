<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\StreamedResponse;
use App\HTTP\Requests\AdminUserRequest;
use Illuminate\Http\Request;
use App\User;

class AdminUserController extends Controller
{
    /** ユーザ情報ダウンロード */
    public function downloadCSV() {
        $users = User::all();
        $csv = $this->csv_format($users);
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

    /** ユーザ編集画面 */
    public function show($id) {
        $user = User::find($id);
        return view('/admin/user_edit')->with('user', $user);
    }

    /** ユーザ編集処理 */
    public function edit(AdminUserRequest $request) {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->tel = $request->tel;
        $user->save();
        return redirect('/admin/user');
    }

    /** private */

    /** CSV出力データの格納 */
    private function csv_format($users) {
        $row = [];
        $row[] = array('顧客ID', '顧客名', 'メールアドレス', 'パスワード', '電話番号');
        foreach($users as $user) {
            $col = [$user->id, $user->name, $user->email, $user->password, $user->tel];
            $row[] = $col;
        }
        return $row;
    }
}
