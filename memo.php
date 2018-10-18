やること

軽微の修正
・seeder
・注文確定処理
・配送希望カレンダーアイコン
・ユーザ登録後、商品一覧画面へリダイレクト => 完了
・confirm画面のURLがGETで受け取っているからおかしい => 計算処理後にリダイレクトして計算結果をリダイレクト先で使いたい時どうすれば渡せるか、または他の方法があるかがわからない
・ItemsControllerの中身を他のControllerに分ける（ItemsControllerに集中している状況だから無理がある）
・注文決済処理で在庫数が更新されない
・あるユーザが過去に買ったことがある商品を注文した場合、カートテーブルのレコードが更新される（新規レコードが生成されない） => 修正を加えるべきかがいまいち判断できない
・カートに追加ボタンと注文確定ボタンを押すと光る
・注文決済のクエリに無駄があり処理時間が遅い
・管理者画面でベタ書きで書いているSQLをORM活用して修正する => 複数モデルに対してリレーションを取得することは出来ないので無理っぽい。。。
・数字を３桁ごとにカンマ区切りしたい
・000000001, 00000002, ...のゼロ埋めの連番にしたい
・CSVインポートしてDBにINSERTしたらremenber_token, created_at, updated_atがNULLで登録される
・売上一覧画面の売上合計金額がページャで表示された注文金額の合計で計算していて、年月の売上合計金額と一致しない

機能の追加
・管理者画面
　・注文確定処理 => 0.75日
　・顧客一覧画面 => 0.5日
　・商品一覧画面 => 0.5日
　・商品追加画面
　・商品売上画面
・管理者機能
　・顧客一覧機能 => 1日
　・商品一覧機能 => 1日
　・商品追加機能
　・商品売上機能


やること（10/8(月)までに終わらす）
・配送希望カレンダーアイコン => 0.25日
・顧客一覧画面 => 0.5日
・商品一覧画面 => 0.5日
・顧客一覧機能 => 1日
・商品一覧機能 => 1日


・注文確定処理
・商品売上一覧（日付を入力して、その日付に注文された商品を一覧表示する）
・日報作成で今日の分を作成する
・勤怠システムの個人実績から時間を修正する
・合計金額はSQLで計算して出していいし、Controllerでループ回して出して良いが、多分SQLの方が効率が良いからSQLでやる

まずは画面と機能を一通り作って、最終的にBootstrapでデザインする。

・送信ボタン
・自分自身のURLに送るようにする
・注文明細の横に明細の金額を書くようにする
・テーブルにする

仮の売上一覧画面でのSQL  {画面で指定したyyyy-mm形式の年月}
select sum(items.price)
from orders
join order_details
on orders.id = order_details.order_id
join items
on order_details.item_id = items.id
where DATE_FORMAT(orders.order_time, '%Y-%m') = '2018-10'
group by orders.id;

DB::table('orders)
    ->select(sum(items.price))
    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
    ->join('items', 'order_details.item_id', '=', 'items.id')
    ->where(DB::raw('DATE_FORMAT(orders.order_time, '%Y%m') = {画面で指定したyyyy-mm形式の年月}'))
    ->groupBy('orders.id');

気づき
・一回の注文で複数の商品を注文した場合、明細がその種類数分だけ作られる
・明細単位でまず合計する
・明細単位を合計して売上高を計算する
・$date = new Carbon()は本日の日時を取得
・date_format($date, 'Y-m')でyyyy-mm形式の日付を取得
・getのリクエストを送るにはhiddenで埋め込んだものをgetで送る
・postのリクエストを送るにはfromのnameに埋め込んだものをpostで送る
・FORMのPOST通信で変な挙動になったらcsrf_field()を疑え
・ユーザ画面の仕様を聞いてなかったから本来作らなくていいアップロード機能を作成するのにすごい時間をかけてしまった。（結局作れないとわかる）早く仕様を確認する。

やること(10/4)
・明細金額を表示 => 完了
・日付の保持 => 完了
・売上画面でのCSV保存 => 完了
・CSVファイルダウンロード => 完了
・詳細ページに遷移 => 完了

やること(10/5)
・CSVファイルアップロード => 完了
・注文明細リンクで画面遷移 => 完了

やること(10/9)
・Modelに処理移す => 完了
・商品CSVファイルアップロード(Trucate後INSERT) => 完了
・商品CSVファイルダウンロード => 完了

やること(10/10)
・クエリを1000件ずつ区切る => 完了
・TRANCATE&INSERTをDBに区切る => 完了

やること（10/11）
・ItemsControllerのDB処理部分をModelに移す => 完了
・ユーザ一覧 => 完了
・Form.validation => 完了
・ユーザ一覧表示（顧客ID、顧客名、メールアドレス、パスワード、電話番号）、編集リンク、削除リンク　=> 完了
・ユーザダウンロード作成処理 => 完了

やること（10/12）
・passwordは最初空白で入れて、横にチェックボックス作成、チェック付いてたら更新 => 完了
　付いてなかったら更新できない。JSでチェック消したらパスワード消す。
・validationはチェックボックスのチェックの有無を判定して、入ってたら入れるし、入ってなかったらパスワードを更新対象から除外する => 完了

やること（10/15）
・ユーザ情報一覧に注文一覧リンクを追加する => 完了
・注文一覧に注文詳細リンクを追加する => 完了

やること（10/16）
・ユーザ詳細情報に注文決済情報を表示 => 完了
・ユーザ詳細情報にお届け先情報を表示 => 完了

やること（10/17）
・見た目をBootstrapで綺麗にする => 完了

やること（10/18）
・ヘッダバーでリンクを作成
・料金のカンマ区切り => 完了
・商品一覧作成 => 完了
・ページャー作成 => 完了
・日付の書式（-を/に変える）
・商品の追加・編集・削除


CSV作成
①DBから取得した注文番号とリンクと注文金額と合計金額などをFileに書き込む
②CSVファイルとして保存

sudo php artisan serve --host=0.0.0.0 --port=80  // PHPサーバ立ち上げ
php artisan migrate                              // マイグレーション実行
php artisan db:seed                              // Seeder実行

vscode 
⌘ Cmd
⌥ Option
⇧ Shift
^ Ctrl

vscode
矩形選択：⌥⌘⇧
タブ移動：^tab
行削除　：^⇧K
同じ単語にカーソル当てる：⌘D

git
作業ツリーの変更の取り消し：git checkout .
ステージングへの追加の取り消し：git HEAD


データベースの中身を新しくする方法
drop database homestead;
create database homestead;
use homestead;
php artisan migrate
php artisan db:seed

コントローラ作成
php artisan make:controller AdminUserOrderController

