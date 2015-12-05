<?php

// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';

session_start();

$userid = $_SESSION["userid"];
$mt_user_id = $_SESSION["mt_user_id"];


// ログイン状態のチェック
if (!isset($_SESSION["userid"])) {
  header("Location: logout.php");
  exit;
}
// エラーメッセージの初期化
$errorMessage = "";

//全画面からの変数を画面用出力変数に代入
$name = $_POST["name"];
$jyutaku_name = $_POST["jyutaku_name"];
$mail = $_POST["mail"];
$request = $_POST["request"];
$date = $_POST["date"];
$start_time = $_POST["start_time"];
$end_time = $_POST["end_time"];
$place = $_POST["place"];
$comment = $_POST["comment"];

//セッションに保持
$_SESSION["name"] = $name;
$_SESSION["jyutaku_name"] = $jyutaku_name;
$_SESSION["mail"] = $mail;
$_SESSION["request"] = $request;
$_SESSION["date"] = $date;
$_SESSION["start_time"] = $start_time;
$_SESSION["end_time"] = $end_time;
$_SESSION["place"] = $place;
$_SESSION["comment"] = $comment;

 // テンプレートファイル読み込み
include_once '../include/view/register_confirm.php';

