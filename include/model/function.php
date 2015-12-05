<?php

/**
 * ログインクラス
 */
class User_Mst_Access{
  //設定
  const SALT = "mwefCMEP28DjwdW3lwdS239vVS";
  const HOST_NAME = DB_HOST;
  const USER_NAME = DB_USER;
  const PASSWORD = DB_PASSWD;
  const DATABASE_NAME = DB_NAME;

  private $dbh = null;

  /**
   * コンストラクタ
   */
  function __construct(){
    $this->dbh = new PDO(
      DB_HOST, 
      DB_USER, 
      DB_PASSWD
    );
    session_start();
  }


  /**
   * 指定したユーザでログインします。
   *
   * @param string $username ユーザ名
   * @param string $password パスワード
   *
   * @return 成功したかどうか
   */
  public function login($userid, $password){
  	  $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);

      $prepare = $dbh->prepare('SELECT * FROM pm_user WHERE user_login = ?');
      $prepare->bindValue(1,(int)$user_id,PDO::PARAM_INT);
  //	  foreach($dbh->query("SELECT * FROM pm_user WHERE user_login = '" . $user_id . "'") as $row) {
      $prepare->execute();

      /*  */
      $result = $prepare->fetchAll();

      foreach($result as $row){
        $db_hashed_pwd = $row['user_pass'];
        $user_id = $row['user_id'];
      }

  	  $dbh = null;

      // ３．画面から入力されたパスワードとデータベースから取得したパスワードのハッシュを比較します。
      //if ($_POST["password"] == $pw) {
     if($_POST["password"] == $db_hashed_pwd){
     // if (password_verify($_POST["password"], $db_hashed_pwd)) {
        // ４．認証成功なら、セッションIDを新規に発行する
        //var_dump($_POST["password"]);
        session_regenerate_id(true);
        $_SESSION["userid"] = $user_id;
        return true;
        exit;
      } else {
        // 認証失敗
        $errorMessage = "ユーザIDあるいはパスワードに誤りがあります。";
      } 
    return false;
  }

}
?>