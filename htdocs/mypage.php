<?php

// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';

session_start();

// user_mstのインスタンス生成
$user_mst_access = new User_Mst_Access();

// match tableのインスタンス生成
$match_tbl_access = new Match_Tbl_Access();

/*
$db['host'] = "localhost";  // DBサーバのurl
$db['user'] = "root";
$db['pass'] = "kings531";
$db['dbname'] = "photo_match";
*/
//ログインユーザー
$user_id = $_SESSION["user_id"];
$user_name = $_SESSION["user_name"];



//$_SESSION["user_id"] = 
//　閲覧ユーザーのid
//$mt_user_id = $_GET["user_id"];

// ログイン状態のチェック
if (!isset($_SESSION["user_id"])) {
  header("Location: logout.php");
  exit;
}

// エラーメッセージの初期化
$errorMessage = "";

try{
    $result = $user_mst_access -> show_profile($user_id);

    foreach($result as $row) {
    // パスワード(暗号化済み）の取り出し 
      $user_name = $row['user_name'];

    }
  }catch(Exception $e){
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
  }


try{
    $yoyaku = $match_tbl_access -> match_show($user_id);

    foreach($yoyaku as $row) {
    // パスワード(暗号化済み）の取り出し 
      $mt_user_id = $row['mt_user_id'];
      $yoyaku_id = $row['yoyaku_id'];
      $flg = $row['syonin_flg'];
    }
  }catch(Exception $e){
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
  }


$_SESSION["user_id"] = $user_id;
//$_SESSION["mt_user_id"] = $mt_user_id;

 // テンプレートファイル読み込み
include_once '../include/view/mypage.php';