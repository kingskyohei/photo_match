<?php
session_start();
// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';
// 関数ファイル読み込み
require_once '../include/model/entity.php';

// エラーメッセージの初期化
$errorMessage = "";

// user_mstのインスタンス生成
$user_mst_access = new User_Mst_Access();

// match tableのインスタンス生成
$match_tbl_access = new Match_Tbl_Access();

//ログインユーザー
$user_id = $_SESSION["user_id"];
$user_name = $_SESSION["user_name"];
$mt_user_id = $_SESSION["mt_user_id"];
$mt_user_kbn = $_SESSION["mt_user_kbn"];

//var_dump($mt_user_id);
//var_dump($mt_user_kbn);


// index.htmlから遷移した場合、セッションIDにmt_user_idが入力されている
// mypageから遷移した場合、セッションIDにmt_user_idが入力されている
//　↓なんの想定？
if (!(isset($mt_user_id))){
  $mt_user_id = $_GET["user_id"];
}

// エラーメッセージの初期化
$errorMessage = "";

if($mt_user_kbn === "1"){

  // カメラマンクラスのインスタンスを生成
  $user_syubetu = new Cameraman();

  try{

    // ユーザーマスタとToolテーブルから画面に表示するログインユーザーの情報を取得
    $result = $user_syubetu -> show_profile($mt_user_id,$mt_user_kbn);
    
    // 画面に表示するカメラマンのプロフィール情報(プロフィール、カメラ)を設定
    foreach($result as $row) {      
      // カメラマンのプロフィール情報
      $user_name = $row['user_name'];
      // カメラの情報
      $camera_syurui = $row['camera_syurui'];
      $camera_syurui_suryo = $row['camera_syurui_suryo'];
      $lens_syurui = $row['lens_syurui'];
      $mt_user_name = $row['user_name'];
      $age = $row['age'];
    }
  }catch(Exception $e){
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
  }

}else{

  // モデルクラスのインスタンスを生成する
  $user_syubetu = new Model();  

  try{
    // 画面に表示するモデルのプロフィール情報を設定
    $result = $user_syubetu -> show_profile($mt_user_id,$mt_user_kbn);
    // 画面に表示するカメラマンのプロフィール情報(プロフィール、カメラ)を設定
    foreach($result as $row) {
      //カメラマンのプロフィール情報 
      $mt_user_name = $row['user_name'];
      
      //$mt_user_kbn = $row['mt_user_kbn'];
    }
  }catch(Exception $e){
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
  }
}

/*
try{

    // 表示対象ユーザーの情報を取得する。
    $result = $user_mst_access -> show_profile($mt_user_id,$mt_user_kbn);
    // 
    foreach($result as $row) {
    // パスワード(暗号化済み）の取り出し 
      $mt_user_name = $row['user_name'];
      $age = $row['age'];
    }
  }catch(Exception $e){
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
  }
*/

try{
    // 
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

$_SESSION["mt_user_id"] = $mt_user_id;
$_SESSION["userid"] = $userid;

 // テンプレートファイル読み込み
include_once '../include/view/profile.php';
