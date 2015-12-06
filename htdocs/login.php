<?php

// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';

// セッション開始
session_start();

// user_mstのインスタンス生成
$user_mst_access = new User_Mst_Access();

/*画面から入力したIDとパスワード*/
$user_name = $_POST["user_name"];
$password = $_POST["password"];
// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["user_name"])) {

  // １．ユーザIDの入力チェック
  if (empty($_POST["user_name"])) {
    $errorMessage = "ユーザIDが未入力です。";
  } else if (empty($_POST["password"])) {
    $errorMessage = "パスワードが未入力です。";
  } 

/*
  var_dump($_POST["user_name"]);
  var_dump($_POST["password"]);
  var_dump($user_name);
  var_dump($password);
  */
  // ２．ユーザIDとパスワードが入力されていたら認証する
  if (!empty($_POST["user_name"]) && !empty($_POST["password"])) {
    // mysqlへの接続
    try {
  		  if($user_mst_access->login($user_name,$password)){
          $_SESSION["user_name"] = $user_name;
    	    header("Location: mypage.php");

        	exit;
        }else{
          // throw new Exception('DBアクセスエラー');
        }
    } catch (Exception $e) {
        print "エラー!: " . $e->getMessage() . "<br/>";
        die();
    }
  }
} 
 // テンプレートファイル読み込み
include_once '../include/view/login.php';