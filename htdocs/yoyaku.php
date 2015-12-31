<?php

session_start();

// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';

/*  */
$user_id = $_SESSION["user_id"];
$mt_user_id = $_SESSION["mt_user_id"];

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$year = substr($start_date,0,4);
$month = substr($start_date,5,2);
$date = substr($start_date,8,2);

$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

$hour = $end_time - $start_time;



// ログイン状態のチェック
if (!isset($_SESSION["user_id"])) {
  header("Location: logout.php");
  exit;
}




 // テンプレートファイル読み込み
include_once '../include/view/yoyaku.php';
