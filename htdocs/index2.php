<?php
require_once __DIR__ . '/vendor/autoload.php';
 
session_start();
 
$fb = new Facebook\Facebook([
  'app_id' => '607604302712166',
  'app_secret' => '35717e7bd645c484da39ff12a6c9ea8b',
  'default_graph_version' => 'v2.4',
  'default_access_token' => isset($_SESSION['facebook_access_token']) ? $_SESSION['facebook_access_token'] : '607604302712166|35717e7bd645c484da39ff12a6c9ea8b'
]);



try {
  $response = $fb->get('/me?fields=id,name');
  //var_dump($response);
  $user = $response->getGraphUser();
  echo 'Name: ' . $user['name'];
  exit; //redirect, or do whatever you want
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
}
 
$helper = $fb->getRedirectLoginHelper();
//var_dump($helper);
$permissions = ['email', 'user_likes'];
$loginUrl = $helper->getLoginUrl('http://localhost/photo_match2/htdocs/login2.php', $permissions);
echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';