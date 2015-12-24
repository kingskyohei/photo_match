<?php

// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';

//Facebook SDK for PHP の src/ にあるファイルを

 // セッション開始
session_start();


/* facebookログイン */
//サーバ内の適当な場所にコピーしておく
/*
require_once("facebook/facebook.php");

$config = array(
    'appId'  => '1658042994475389',
    'secret' => '3837b3a9b992c734346cd36e45c05922'
);

$facebook = new Facebook($config);

$params = array('redirect_uri' => 'http://localhost/photo_match2/htdocs/mypage.php');
$params = array('scope' => 'email');
$loginUrl = $facebook->getLoginUrl($params);
//$loginUrl = $facebook->getLoginUrl();
$user = $facebook->api('/me', 'GET');



echo '<a href="' . $loginUrl . '">Login with Facebook</a>';

$userId = $facebook->getUser();


// user_mstのインスタンス生成
*/
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