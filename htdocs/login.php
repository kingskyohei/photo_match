<?php

// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';

//Facebook SDK for PHP の src/ にあるファイルを

 // セッション開始
require_once __DIR__ . '/vendor/autoload.php';
 
//セッションを一旦消す
//session_destroy();

session_start();

//fbログインで得たセッションを一度消す
$_SESSION['facebook_access_token'] =null;

$fb = new Facebook\Facebook([
  'app_id' => '607604302712166',
  'app_secret' => '35717e7bd645c484da39ff12a6c9ea8b',
  'default_graph_version' => 'v2.4',
  'default_access_token' => isset($_SESSION['facebook_access_token']) ? $_SESSION['facebook_access_token'] : '607604302712166|35717e7bd645c484da39ff12a6c9ea8b'
]);

try {
  $response = $fb->get('/me?fields=id,email,gender,link,locale,name,timezone,updated_time,verified,last_name,first_name,middle_name');
  //var_dump($response);
  $user = $response->getGraphUser();
  echo 'Name: ' . $user['name'] .$user['email']. 'ID' .$user['id'] ;
  //exit; //redirect, or do whatever you want
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  //echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  //echo 'Facebook SDK returned an error: ' . $e->getMessage();
}
 

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_likes'];
$loginUrl = $helper->getLoginUrl('http://localhost/photo_match2/htdocs/login2.php', $permissions);



// user_mstのインスタンス生成

$user_mst_access = new User_Mst_Access();
/*画面から入力したIDとパスワード*/
$user_name = $_POST["user_name"];
$password = $_POST["password"];

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["user_name"])) {
  // １．ユーザIDの入力チェック
  if (empty($_POST["user_name"])) {
    $errorMessage = "ユーザIDが未入力です。";
  } else if (empty($_POST["password"])) {
    $errorMessage = "パスワードが未入力です。";
  } 

  // ２．ユーザIDとパスワードが入力されていたら認証する
  if (!empty($_POST["user_name"]) && !empty($_POST["password"])) {
    // mysqlへの接続
    try {
        $rtn = $user_mst_access->login($user_name,$password);

  		  if(isset($rtn)){
          $_SESSION["user_id"] = $rtn['user_id'];
          $_SESSION["user_name"] = $user_name;
          $_SESSION["user_kbn"] = $rtn['user_kbn'];
          var_dump($rtn['user_kbn']);
     	    header("Location: mypage.php");
        	exit;
        }else{
          // throw new Exception('DBアクセスエラー');
        }
    } catch (Exception $e) {
        print "エラー!: " . $e->getMessage() . "<br/>";
        die();
    }
  }
} 
 // テンプレートファイル読み込み
include_once '../include/view/login.php';