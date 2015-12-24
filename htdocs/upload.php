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
// ユーザーネーム
$user_name = $_SESSION["user_name"];
// ユーザー区分
$user_kbn = $_SESSION["user_kbn"];

// ログアウト時にログアウト画面に遷移する。
if (!isset($_SESSION["user_id"])) {
  header("Location: logout.php");
  exit;
}

// エラーメッセージの初期化
$errorMessage = "";

$photo = new Photo();
//var_dump($_FILES["upfile"]);

// ログインボタンが押された場合

if (isset($_FILES["upfile"])) {

  $file = $_FILES["upfile"];
  //写真アップロード
  $photo -> insert_photo($user_id,$file);

}

$photo = new Photo();

$rows = $photo -> show_photo($user_id);


/* HTML特殊文字をエスケープする関数 */

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// 次画面に自分と予約相手のログインIDを渡す
// ログイン状態を維持する
$_SESSION["user_id"] = $user_id;
// 予約相手のプロフィールを表示する
$_SESSION["mt_user_id"] = $mt_user_id;
// 予約相手のユーザー区分
$_SESSION["mt_user_kbn"] = $mt_user_kbn;


include_once '../include/view/upload.php';



