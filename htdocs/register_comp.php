<?php
// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';
// 関数ファイル読み込み
require_once '../include/model/entity.php';


session_start();
/*
var_dump($_SESSION["name"]);
var_dump($_SESSION["fb_id"]);
var_dump($_SESSION["furigana"]);
var_dump($_SESSION["mail"]);
var_dump($_SESSION["gender"]);
var_dump($_SESSION["user_kbn"]);
var_dump($_SESSION["user_name"]);
var_dump($_SESSION["password"]);
*/

$name = $_SESSION["name"];
$furigana = $_SESSION["furigana"];
$mail = $_SESSION["mail"];
$fb_id = $_SESSION["fb_id"];
$gender = $_SESSION["gender"];
$user_name = $_SESSION["user_name"];
$user_kbn =$_SESSION["user_kbn"];
$password = $_SESSION["password"];

$register_info_array['name'] = $name;
$register_info_array['furigana'] = $furigana;
$register_info_array['mail'] = $mail;
$register_info_array['gender'] = $gender;
$register_info_array['fb_id'] = $fb_id;
$register_info_array['user_kbn'] = $user_kbn;

// エラーメッセージの初期化
$errorMessage = "";
  // ２．ユーザIDとパスワードが入力されていたら認証する
if (!empty($user_name) && !empty($password)) {
    
  try {
        $user = new User();
        $result = $user -> register($user_name,$password,$register_info_array);
        var_dump($result);
      }catch (PDOException $e) {
        print "エラー!: " . $e->getMessage() . "<br/>";
        die();
      }
  }else{
    $errorMessage = "ユーザー名もしくはパスワードが入力されていません";
  }


 // テンプレートファイル読み込み
include_once '../include/view/register_comp.php';
