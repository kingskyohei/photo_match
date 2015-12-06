
<?php
session_start();

$db['host'] = "localhost";  // DBサーバのurl
$db['user'] = "root";
$db['pass'] = "kings531";
$db['dbname'] = "photo_match";

//ログインユーザー
$user_name = $_SESSION["user_name"];


//　閲覧ユーザーのid
//$mt_user_id = $_GET["user_id"];

// ログイン状態のチェック
if (!isset($_SESSION["user_name"])) {
  header("Location: logout.php");
  exit;
}


// エラーメッセージの初期化
$errorMessage = "";


// mysqlへの接続
$mysqli = new mysqli($db['host'], $db['user'], $db['pass']);
if ($mysqli->connect_errno) {
  print('<p>データベースへの接続に失敗しました。</p>' . $mysqli->connect_error);
  exit();
}

// データベースの選択
$mysqli->select_db($db['dbname']);

// userテーブルへクエリの実行
$query = "SELECT * FROM pm_user WHERE user_id = $userid ";
//$query = "SELECT * FROM biyo_news where news_id = 1";


$result = $mysqli->query($query);

if (!$result) {
  print('クエリーが失敗しました。' . $mysqli->error);
  $mysqli->close();
  exit();
}

while ($row = $result->fetch_assoc()) {
  // パスワード(暗号化済み）の取り出し 
  $user_name = $row['user_name'];
}

// 予約テーブルへクエリの実行
$yoyaku_query = "SELECT * FROM yoyaku_table WHERE mt_user_id = '" . $userid . "'";
//$query = "SELECT * FROM biyo_news where news_id = 1";

$yoyaku_result = $mysqli->query($yoyaku_query);

if (!$yoyaku_result) {
  print('クエリーが失敗しました。' . $mysqli->error);
  $mysqli->close();
  exit();
}

while ($yoyaku_row = $yoyaku_result->fetch_assoc()) {
  // パスワード(暗号化済み）の取り出し 
  $yoyaku_id = $yoyaku_row['yoyaku_id'];
  $flg = $yoyaku_row['syonin_flg'];
  $mt_user_id = $yoyaku_row['user_id'];
}

//　閲覧ユーザーのid
//$mt_user_id = $_GET["user_id"];

$_SESSION["userid"] = $userid;
$_SESSION["mt_user_id"] = $mt_user_id;

 // テンプレートファイル読み込み
include_once '../include/view/mypage.php';