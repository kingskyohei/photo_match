<?php
session_start();
/*
$db['host'] = "localhost";  // DBサーバのurl
$db['user'] = "root";
$db['pass'] = "kings531";
$db['dbname'] = "photo_match";
*/
// MySQL接続情報
$host   = 'localhost'; // データベースのホスト名又はIPアドレス
$user   = 'root';  // MySQLのユーザ名
$passwd = 'kings531';    // MySQLのパスワード
$dbname = 'photo_match';    // データベース名

$userid = $_SESSION["userid"];
$mt_user_id = $_SESSION["mt_user_id"];
// ログイン状態のチェック
if (!isset($_SESSION["userid"])) {
  header("Location: logout.php");
  exit;
}
// エラーメッセージの初期化
$errorMessage = "";

//送信相手のID

//$userid = 3;
$title = "撮影";
$year = "2015";
$month = "11";
$date = "30";
$hour = 2;
$price = 1500;
$syonin_flg = 0; 

//全画面からの変数を画面用出力変数に代入
$name = $_SESSION["name"];
$jyutaku_name = $_SESSION["jyutaku_name"];
//$mail = $_SESSION["mail"];
$request = $_SESSION["request"];
$date = $_SESSION["date"];
$start_time = $_SESSION["start_time"];
$end_time = $_SESSION["end_time"];
$place = $_SESSION["place"];
$comment = $_SESSION["comment"];


/*
var_dump($name);
var_dump($jyutaku_name);
var_dump($mail);
var_dump($request);
var_dump($date);
var_dump($start_time);
var_dump($end_time);
var_dump($place);
var_dump($comment);
*/

// コネクション取得
if ($link = mysqli_connect($host, $user, $passwd, $dbname)) {

  // mysqlへの接続
  mysqli_set_charset($link, 'utf8');

  // 挿入
  $query = 'INSERT INTO yoyaku_table(user_id,mt_user_id,title,content,place,year,month,date,start_time,end_time,hour,syonin_flg,register_time) VALUES (\''. $userid .'\',\'' . $mt_user_id .'\',\'' . $title .'\',\''. $comment .'\',\'' . $place .'\',\'' . $year . '\',\''. $month .'\',\'' . $date . '\',\'' . $start_time . '\',\'' . $end_time . '\',\'' . $hour . '\',\'' . $syonin_flg . '\', cast(now() as datetime))';
 
  // クエリを実行します
  if (mysqli_query($link, $query) === TRUE) {
      //print 'テーブル更新成功';
  } else {
      //print 'テーブル更新失敗';
  }

  /*
  if ($mysqli->connect_errno) {
    print('<p>データベースへの接続に失敗しました。</p>' . $mysqli->connect_error);
    exit();
  }

  // データベースの選択
  $mysqli->select_db($db['dbname']);

  // 処理1.予約テーブルへの挿入

  //mysqli_set_charset($link, 'utf8');

  $query = 'INSERT INTO yoyaku_table(user_id,title,content,place,year,month,date,start_time,end_time,hour,register_time) VALUES (\''. $user_id .'\',' . $title .'\','. $comment .'\',' . $place .'\',' . $year . '\','. $month .'\',' . $date . '\',' . $start_time . '\',' . $end_time . '\',' . $hour . '\', cast(now() as datetime))';
  var_dump($query);
  */

}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="css/yoyaku_comp.css">-->
</head>
<body>
  <div id="page">
    <div class="container">
      <h1>予約依頼送信完了</h1>
        <a href="./main.php" class="btn btn-default">戻る</a> 
    </div><!-- /container -->
  </div><!-- /page -->
  <script src="./js/jquery-1.11.3.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
</body>
</html>