<?php
session_start();

// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';

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
$title = $_POST["title"];
$content = $_POST["content"];
$place = $_POST["place"];
$mail = $_POST["mail"];
$year = $_POST["year"];
$month = $_POST["month"];
$date = $_POST["date"];
$start_time = $_POST["start_time"];
$end_time = $_POST["end_time"];
$place = $_POST["place"];
$hour = $_POST["hour"];

//セッションに保持
$_SESSION["title"] = $title;
$_SESSION["content"] = $content;
$_SESSION["place"] = $place;
$_SESSION["mail"] = $mail;
$_SESSION["year"] = $year;
$_SESSION["month"] = $month;
$_SESSION["date"] = $date;
$_SESSION["start_time"] = $start_time;
$_SESSION["end_time"] = $end_time;
$_SESSION["place"] = $place;
$_SESSION["hour"] = $hour;

 // テンプレートファイル読み込み
include_once '../include/view/yoyaku_confirm.php';