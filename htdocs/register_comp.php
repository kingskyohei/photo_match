<?php
// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';

session_start();

$name = $_SESSION["name"];
$furigana = $_SESSION["furigana"];
$mail = $_SESSION["mail"];
$user_name = $_SESSION["user_name"];
$password = $_SESSION["password"];

$register_info_array['name'] = $name;
$register_info_array['furigana'] = $furigana;
$register_info_array['mail'] = $mail;

// user_mstのインスタンス生成
$user_mst_access = new User_Mst_Access();

// エラーメッセージの初期化
$errorMessage = "";
  // ２．ユーザIDとパスワードが入力されていたら認証する
if (!empty($user_name) && !empty($password)) {
    // mysqlへの接続
    try {

        if($user_mst_access->register($user_name,$password,$register_info_array)){
          print 'DB挿入成功';
        }else{
           throw new Exception('DBエラー');
        }
    } catch (PDOException $e) {
        print "エラー!: " . $e->getMessage() . "<br/>";
        die();
    }
  }


 // テンプレートファイル読み込み
include_once '../include/view/register_comp.php';
