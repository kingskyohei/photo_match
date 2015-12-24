<?php

// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';


session_start();


require './vendor/autoload.php';

# v5

$fb = new Facebook\Facebook([
  'app_id' => '999683393387587',
  'app_secret' => 'd6edbec6172fedf09adabcce2e7510e4',
  'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email', 'user_posts'];
$callback = 'http://localhost/photo_match2/htdocs/register.php';
$loginUrl = $helper->getLoginUrl($callback, $permissions);
//var_dump($loginUrl);
//var_dump($helper -> getError());
try {

  $accessToken = $helper->getAccessToken();
  //var_dump($accessToken);

} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // There was an error communicating with Graph
  echo $e->getMessage();
  exit;
}
 
if (isset($accessToken)) {
  // User authenticated your app!
  // Save the access token to a session and redirect
  $_SESSION['facebook_access_token'] = (string) $accessToken;
  // Log them into your web framework here . . .
  echo 'Successfully logged in!';
  exit;
} elseif ($helper->getError()) {
  // The user denied the request
  // You could log this data . . .
  var_dump($helper->getError());
  var_dump($helper->getErrorCode());
  var_dump($helper->getErrorReason());
  var_dump($helper->getErrorDescription());
  // You could display a message to the user
  // being all like, "What? You don't like me?"
  exit;
}
 
// If they've gotten this far, they shouldn't be here
http_response_code(400);









/*

$request = new FacebookRequest(
  $session,
  'GET',
  '/me?fields=id,email,gender,link,locale,name,timezone,updated_time,verified,last_name,first_name,middle_name'
);

*/

echo '<a href="'.$loginUrl.'">Log in with Facebook!</a>';



// テンプレートファイル読み込み
include_once '../include/view/register.php';
?>