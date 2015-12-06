<?php

// 設定ファイル読み込み
require_once '../include/conf/const.php';
// 関数ファイル読み込み
require_once '../include/model/function.php';
// user_mstのインスタンス生成
$user_mst_access = new User_Mst_Access();

//ログアウト処理
$user_mst_access->logout();



 // テンプレートファイル読み込み
include_once '../include/view/logout.php';