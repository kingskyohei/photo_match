<?php

// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';
require_once '../include/model/entity.php';

session_start();

//ログインユーザー
$user_id = $_SESSION["user_id"];
$user_name = $_SESSION["user_name"];
$user_kbn = $_SESSION["user_kbn"];

$yoyaku_class = new Yoyaku();

// ログイン状態のチェック
if (!isset($_SESSION["user_id"])) {
  header("Location: logout.php");
  exit;
}

// エラーメッセージの初期化
$errorMessage = "";


if($user_kbn === "1"){

  $user_syubetu = new Cameraman();

  try{
      $result = $user_syubetu -> show_profile($user_id,$user_kbn);
      //var_dump($result);
      foreach($result as $row) {
      // パスワード(暗号化済み）の取り出し 
        $user_name = $row['user_name'];
        $camera_syurui = $row['camera_syurui'];
        $camera_syurui_suryo = $row['camera_syurui_suryo'];
        $lens_syurui = $row['lens_syurui'];
        //$user_camera = $row['']
        //var_dump($user_name);
        //var_dump($camera_syurui);
      }
    }catch(Exception $e){
      print "エラー!: " . $e->getMessage() . "<br/>";
      die();
    }


  try{
      $yoyaku = $yoyaku_class -> match_show($user_id);

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
  include_once '../include/view/mypage_camera.php';

}else{
  $user_syubetu = new Model();  

  try{
      $result = $user_syubetu -> show_profile($user_id,$user_kbn);
      //var_dump($result);
      foreach($result as $row) {
      // パスワード(暗号化済み）の取り出し 
        $user_name = $row['user_name'];


        //$user_camera = $row['']
        //var_dump($user_name);
        //var_dump($camera_syurui);
      }
    }catch(Exception $e){
      print "エラー!: " . $e->getMessage() . "<br/>";
      die();
    }
   // テンプレートファイル読み込み
  include_once '../include/view/mypage_model.php';

}


