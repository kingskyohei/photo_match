<?php

session_start();
// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';

// エラーメッセージの初期化
$errorMessage = "";

//全画面からの変数を画面用出力変数に代入
$name = $_POST["name"];
$furigana = $_POST["furigana"];
$mail = $_POST["mail"];
$user_name = $_POST["user_name"];
$password = $_POST["password"];


//セッションに保持
$_SESSION["name"] = $name;
$_SESSION["furigana"] = $furigana;
$_SESSION["mail"] = $mail;
$_SESSION["user_name"] = $user_name;
$_SESSION["password"] = $password;

 // テンプレートファイル読み込み
include_once '../include/view/register_confirm.php';

