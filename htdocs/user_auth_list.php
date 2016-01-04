<?php

// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';
require_once '../include/model/entity.php';
 // セッション開始
require_once __DIR__ . '/vendor/autoload.php';

session_start();

$fb = new Facebook\Facebook([
  'app_id' => '607604302712166',
  'app_secret' => '35717e7bd645c484da39ff12a6c9ea8b',
  'default_graph_version' => 'v2.4',
  'default_access_token' => isset($_SESSION['facebook_access_token']) ? $_SESSION['facebook_access_token'] : '607604302712166|35717e7bd645c484da39ff12a6c9ea8b'
]);

$access_token = $_SESSION['facebook_access_token'];

// ユーザーID
$user_id = $_SESSION["user_id"];
//var_dump($user_id);
// ユーザーネーム
$user_name = $_SESSION["user_name"];
// ユーザー区分
$user_kbn = $_SESSION["user_kbn"];

//var_dump($_POST['change_status']);

$errorMessage = "";

if($user_kbn === "1"){

  // カメラマンクラスのインスタンスを生成
  $user_syubetu = new Cameraman();

  try{

    $user_mst = new User_Mst_Access();
 
    $result = $user_mst -> user_list();

  }catch(Exception $e){
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
  }

}else{

}


  // 次画面に自分と予約相手のログインIDを渡す

  // ログイン状態を維持する
  $_SESSION["user_id"] = $user_id;
  // 予約相手のプロフィールを表示する
  $_SESSION["mt_user_id"] = $mt_user_id;
  // 予約相手のユーザー区分
  $_SESSION["mt_user_kbn"] = $mt_user_kbn;


// 画面表示ファイル(view)の読み込み
include_once '../include/view/user_auth_list.php';




