<?php

// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';


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

if(isset($access_token)){

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

  //FBIDの補完
  $fb_id = $user['id'];
  //ユーザーネームの補完
  $user_name = $user['name'];
  //facebook登録メールアドレスの補完
  $email = $user['email'];
  //facebook登録性別の補完  
  $gender = $user['gender'];
  //性別表示の変換
  if($gender === "male"){
    $gender = "男性";
  }else{
    $gender = "女性";
  }
  //var_dump($fb_id);
  //var_dump($email);
  //var_dump($gender);
}

$_SESSION['fb_id'] = $fb_id;


/*

$request = new FacebookRequest(
  $session,
  'GET',
  '/me?fields=id,email,gender,link,locale,name,timezone,updated_time,verified,last_name,first_name,middle_name'
);

*/



// テンプレートファイル読み込み
include_once '../include/view/register.php';
?>