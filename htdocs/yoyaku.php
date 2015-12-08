<?php

session_start();

// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';

/*
$db['host'] = "localhost";  // DBサーバのurl
$db['user'] = "root";
$db['pass'] = "kings531";
$db['dbname'] = "photo_match";
*/
$user_id = $_SESSION["user_id"];
$mt_user_id = $_SESSION["mt_user_id"];
//var_dump($userid);
//var_dump($mt_user_id);

// ログイン状態のチェック
if (!isset($_SESSION["user_id"])) {
  header("Location: logout.php");
  exit;
}

 // テンプレートファイル読み込み
include_once '../include/view/yoyaku.php';
