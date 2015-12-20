<?php
session_start();

// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';
// 関数ファイル読み込み
require_once '../include/model/entity.php';

$yoyaku = new Yoyaku();

$user_id = $_SESSION["user_id"];
$mt_user_id = $_SESSION["mt_user_id"];
// ログイン状態のチェック
if (!isset($_SESSION["user_id"])) {
  header("Location: logout.php");
  exit;
}
// エラーメッセージの初期化
$errorMessage = "";

//全画面からの変数を画面用出力変数に代入
$title = $_SESSION["title"];
$content = $_SESSION["content"];
$place = $_SESSION["place"];
$mail = $_SESSION["mail"];
$year = $_SESSION["year"];
$month = $_SESSION["month"];
$date = $_SESSION["date"];
$start_time = $_SESSION["start_time"];
$end_time = $_SESSION["end_time"];
$hour = $_SESSION["hour"];

try{

  $yoyaku_info_list["title"] = $title;
  $yoyaku_info_list["content"] = $content;
  $yoyaku_info_list["place"] = $place;
  $yoyaku_info_list["mail"] = $mail;
  $yoyaku_info_list["year"] = $year;
  $yoyaku_info_list["month"] = $month;
  $yoyaku_info_list["date"] = $date;
  $yoyaku_info_list["start_time"] = $start_time;
  $yoyaku_info_list["end_time"] = $end_time;
  $yoyaku_info_list["hour"] = $hour;

  $rtn_id = $yoyaku->yoyaku_insert($user_id,$mt_user_id,$yoyaku_info_list);
  //var_dump($rtn_id);

}catch(Exception $e){
  print "エラー!: " . $e->getMessage() . "<br/>";
  die();
}


// コネクション取得
/*
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

  
  if ($mysqli->connect_errno) {
    print('<p>データベースへの接続に失敗しました。</p>' . $mysqli->connect_error);
    exit();
  }

  // データベースの選択
  $mysqli->select_db($db['dbname']);

  // 処理1.予約テーブルへの挿入

  //mysqli_set_charset($link, 'utf8');

  $query = 'INSERT INTO yoyaku_table(user_id,title,content,place,year,month,date,start_time,end_time,hour,register_time) VALUES (\''. $user_id .'\',' . $title .'\','. $comment .'\',' . $place .'\',' . $year . '\','. $month .'\',' . $date . '\',' . $start_time . '\',' . $end_time . '\',' . $hour . '\', cast(now() as datetime))';
  //var_dump($query);
  

}
*/
 // テンプレートファイル読み込み
include_once '../include/view/yoyaku_comp.php';