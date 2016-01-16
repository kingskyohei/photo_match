<?php

// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';
require_once '../include/model/entity.php';
 // セッション開始
require_once __DIR__ . '/vendor/autoload.php';

session_start();

//fbの設定
$fb = new Facebook\Facebook([
  'app_id' => '607604302712166',
  'app_secret' => '35717e7bd645c484da39ff12a6c9ea8b',
  'default_graph_version' => 'v2.4',
  'default_access_token' => isset($_SESSION['facebook_access_token']) ? $_SESSION['facebook_access_token'] : '607604302712166|35717e7bd645c484da39ff12a6c9ea8b'
]);

//　
$access_token = $_SESSION['facebook_access_token'];

// ユーザーID
$user_id = $_SESSION["user_id"];
//var_dump($user_id);
// ユーザーネーム
$user_name = $_SESSION["user_name"];
// ユーザー区分
$user_kbn = $_SESSION["user_kbn"];

//var_dump($_POST['change_status']);

if($_POST['change_status'] === '1'){

  // 
  $yoyaku = new Yoyaku();
  // 選択した予約IDを取得
  $yoyaku_id = $_POST['yoyaku_id'];
  //　選択した予約IDのステータスを取得 
  $status = $_POST['change_status'];
  // 予約テーブルの承認フラグのステータスを更新する
  $yoyaku -> yoyaku_update($status,$yoyaku_id);
  // マッチテーブルの確定した予約の情報を登録する
  $yoyaku -> match_insert($yoyaku_id);

}

try {
  $response = $fb->get('/me?fields=id,email,gender,link,locale,name,timezone,updated_time,verified,last_name,first_name,middle_name');

  //var_dump($response);
  $user = $response->getGraphUser();
  //echo 'Name: ' . $user['name'] .$user['email']. 'ID' .$user['id'] ;
  //exit; //redirect, or do whatever you want
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  //echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  //echo 'Facebook SDK returned an error: ' . $e->getMessage();
}



$helper = $fb->getRedirectLoginHelper();
$logoutUrl = $helper->getLogoutUrl($access_token, 'http://localhost/photo_match2/htdocs/login.php');

  
/*
// ログアウト時にログアウト画面に遷移する。
if (!isset($_SESSION["user_id"])) {
  header("Location: logout.php");
  exit;
}
*/
//var_dump($user_id);
// エラーメッセージの初期化
$errorMessage = "";

if($user_kbn === "1"){

  // カメラマンクラスのインスタンスを生成
  $user_syubetu = new Cameraman();

  try{
    // ユーザーマスタとToolテーブルから画面に表示するログインユーザーの情報を取得
    $result = $user_syubetu -> show_profile($user_id,$user_kbn);
    
    $result_photo = $user_syubetu -> show_photos($user_id);

    // 画面に表示するカメラマンのプロフィール情報(プロフィール、カメラ)を設定
    foreach($result as $row) { 

      //カメラマンのプロフィール情報
      $user_name = $row['name'];
      //カメラの情報
      $camera_syurui = $row['camera_syurui'];

      $camera_syurui_suryo = $row['camera_syurui_suryo'];

      $lens_syurui = $row['lens_syurui'];

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
    $result = $user_syubetu -> show_profile($user_id,$user_kbn);

    // 画面に表示するカメラマンのプロフィール情報(プロフィール、カメラ)を設定
    foreach($result as $row) {
      //カメラマンのプロフィール情報 
      $user_name = $row['user_name'];
    }
  }catch(Exception $e){
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
  }
}

try{
    // 予約クラスのインスタンス作成
    $yoyaku_class = new Yoyaku();
    // マッチテーブルから予約情報を取得
    $yoyaku = $yoyaku_class -> match_show($user_id);
    // 
    $new_yoyaku = count($yoyaku);
    //echo $new_yoyaku;
    //exit;
    // 画面に表示する予約情報 
    foreach($yoyaku as $row) {
        // 予約相手のID
        $mt_user_id = $row['mt_user_id'];
        // 予約相手のユーザー区分
        $mt_user_kbn = $row['mt_user_kbn'];
        // 予約管理番号
        $yoyaku_id = $row['yoyaku_id'];
        // 承認フラグ(申請許可=1 申請前/拒否=0)
        $flg = $row['syonin_flg'];
    }
  }catch(Exception $e){
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
  }
  // 次画面に自分と予約相手のログインIDを渡す

  // ログイン状態を維持する
  $_SESSION["user_id"] = $user_id;
  // 予約相手のプロフィールを表示する
  $_SESSION["mt_user_id"] = $mt_user_id;
  // 予約相手のユーザー区分
  $_SESSION["mt_user_kbn"] = $mt_user_kbn;


  // ユーザー区分が"1"(カメラマン)
  if($user_kbn === "1"){
    // 画面表示ファイル(view)の読み込み
    include_once '../include/view/mypage_camera.php';
  }else{
    // 画面表示ファイル(view)の読み込み
    include_once '../include/view/mypage_model.php';
  }




