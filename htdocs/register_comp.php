<?php
// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';
// 関数ファイル読み込み
require_once '../include/model/entity.php';


session_start();

$name = $_SESSION["name"];
$furigana = $_SESSION["furigana"];
$mail = $_SESSION["mail"];
$user_name = $_SESSION["user_name"];
$password = $_SESSION["password"];

$register_info_array['name'] = $name;
$register_info_array['furigana'] = $furigana;
$register_info_array['mail'] = $mail;



// エラーメッセージの初期化
$errorMessage = "";
  // ２．ユーザIDとパスワードが入力されていたら認証する
if (!empty($user_name) && !empty($password)) {
    
  try {
        $user = new User();
        $result = $user -> register($user_name,$password,$register_info_array);
      }catch (PDOException $e) {
        print "エラー!: " . $e->getMessage() . "<br/>";
        die();
      }
  }else{
    $errorMessage = "ユーザー名もしくはパスワードが入力されていません";
  }


 // テンプレートファイル読み込み
include_once '../include/view/register_comp.php';
