<?php

// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';
require_once '../include/model/entity.php';

session_start();

//sessionで保持するログインユーザー情報
// ユーザーID
$user_id = $_SESSION["user_id"];
// 相手ユーザーID
$mt_user_id = $_SESSION["mt_user_id"];
// ユーザーネーム
$user_name = $_SESSION["user_name"];
// ユーザー区分
$user_kbn = $_SESSION["user_kbn"];

// ログアウト時にログアウト画面に遷移する。
if (!isset($_SESSION["user_id"])) {
  header("Location: logout.php");
  exit;
}


$msg = new Message();
$result = $msg -> msg_receive($user_id);

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["title"])) {
  /* 送信相手 */
  $mt_user_id = $_POST['mt_user_id'];
  /* タイトル */
  $title = $_POST["title"];
  /* 内容 */
  $message = $_POST["content"];

  $msg_array = array(
    "title"=> $title,
    "message" => $message
  );

  $result = $msg -> msg_send($user_id,$mt_user_id,$msg_array);
}

// 次画面に自分と予約相手のログインIDを渡す
// ログイン状態を維持する
$_SESSION["user_id"] = $user_id;
// 予約相手のプロフィールを表示する
$_SESSION["mt_user_id"] = $mt_user_id;
// 予約相手のユーザー区分
$_SESSION["mt_user_kbn"] = $mt_user_kbn;


include_once '../include/view/message.php';



