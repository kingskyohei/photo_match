<?php
session_start();
// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';

// エラーメッセージの初期化
$errorMessage = "";

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
$mt_user_id = $_SESSION["mt_user_id"];

//var_dump($mt_user_name);


//　閲覧ユーザーのid
if (!(isset($mt_user_id))){
  $mt_user_id = $_GET["user_id"];
}

// ログイン状態のチェック
/*
if (!isset($_SESSION["USERID"])) {
  header("Location: logout.php");
  exit;
}
*/




try{
    $result = $user_mst_access -> show_profile($mt_user_id);
    foreach($result as $row) {
    // パスワード(暗号化済み）の取り出し 
      $mt_user_name = $row['user_name'];
      $age = $row['age'];

    }
  }catch(Exception $e){
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
  }


try{
    $result_yoyaku = $match_tbl_access -> schedule_show($mt_user_id);
    //var_dump($result_yoyaku);
    foreach ($result_yoyaku as $row){
      // パスワード(暗号化済み）の取り出し
      $yoyaku_id = $row['yoyaku_id'];
      $yoyaku_title = $row['title'];
      $content = $row['content'];
      $year = $row['year'];
      $month = $row['month'];
      $date = $row['date'];
      $start_time = substr($row['start_time'],1,2) . ':' . substr($row['start_time'],2,2);   
      $end_time = substr($row['end_time'],1,2) . ':' . substr($row['end_time'],2,2);   
      $start_datetime_display = $year . '-' . $month . '-' . $date .' ' . $start_time ;
      $end_datetime_display = $year . '-' . $month . '-' . $date .' ' . $end_time ;
    }
  }catch(Exception $e){
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
  }



//var_dump($yoyaku_id);
//var_dump($year);
//var_dump($content);
//var_dump($start_time);
//var_dump($start_datetime_display);
//var_dump($end_datetime_display);
$_SESSION["mt_user_id"] = $mt_user_id;
$_SESSION["userid"] = $userid;


 // テンプレートファイル読み込み
include_once '../include/view/profile.php';
