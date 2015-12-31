<?php
// 設定ファイル読み込み
require_once '../include/conf/const.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once '../include/model/function.php';
session_start();
 
$fb = new Facebook\Facebook([
  'app_id' => '607604302712166',
  'app_secret' => '35717e7bd645c484da39ff12a6c9ea8b',
  'default_graph_version' => 'v2.4',
  'default_access_token' => isset($_SESSION['facebook_access_token']) ? $_SESSION['facebook_access_token'] : '607604302712166|35717e7bd645c484da39ff12a6c9ea8b'
]);
 
$helper = $fb->getRedirectLoginHelper();
 
try {
  $accessToken = $helper->getAccessToken();

} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  //echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  //echo 'Facebook SDK returned an error: ' . $e->getMessage();
}
 
if (isset($accessToken)) {
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;

} elseif ($helper->getError()) {
  // The user denied the request
}


//fb認証のログインIDが登録されているユーザーの場合
/*
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
*/
//var_dump($user);
//exit;

//$user_mst = new User_Mst_Access();

//$result2 = $user_mst -> fb_login_check($user['id']);

//var_dump($user['id']);
//$_SESSION['result2'] = $result2;

//var_dump($_SESSION['result2']);

header('Location: login3.php');
 