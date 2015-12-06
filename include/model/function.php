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

  //ハッシュ化
  private function hash($password){
    return md5($password . self::SALT);
  }

  /**
   * 指定したユーザを新規登録します。
   *
   * @param string $username ユーザ名
   * @param string $password パスワード
   *
   * @return 成功したかどうか
   */
  public function register($user_name, $password,$register_info_array){
    $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);
    //ユーザーネーム
    $ins_user_name = $user_name;
    //パスワード （ハッシュ化）
    $ins_password = $this->hash($password);
    //名前
    $ins_name = $register_info_array['name'];
    //ふりがな
    $ins_furigana = $register_info_array['furigana'];
    //メール
    $ins_mail = $register_info_array['mail'];
    
    $prepare = $dbh->prepare("INSERT INTO user_mst(name,furigana,mail,user_name,password) VALUES (:name, :furigana, :mail, :user_name,:password)");
    $prepare->bindValue(':name',$ins_name,PDO::PARAM_STR);
    $prepare->bindValue(':furigana',$ins_furigana,PDO::PARAM_STR);
    $prepare->bindValue(':mail',$ins_mail,PDO::PARAM_STR);
    $prepare->bindValue(':user_name',$ins_user_name,PDO::PARAM_STR);
    $prepare->bindValue(':password',$ins_password,PDO::PARAM_STR);
    //成功したらtrue
    return $prepare->execute();
  }


  /**
   * 指定したユーザでログインします。
   *
   * @param string $user_name ユーザ名
   * @param string $password パスワード
   *
   * @return 成功したかどうか
   */
  public function login($user_name, $password){

  	  $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);

      $prepare = $dbh->prepare('SELECT * FROM user_mst WHERE user_name = :user_name');
      $prepare->bindValue(':user_name',(int)$user_name,PDO::PARAM_INT);
      //foreach($dbh->query("SELECT * FROM pm_user WHERE user_login = '" . $user_id . "'") as $row) {
      $prepare->execute();

      /*  */
      $result = $prepare->fetchAll();

      foreach($result as $row){
        $db_hashed_pwd = $row['password'];
        $user_name = $row['user_name'];
      }

  	  $dbh = null;

      // ３．画面から入力されたパスワードとデータベースから取得したパスワードのハッシュを比較します。
      //if ($_POST["password"] == $pw) {
     $compare_password = $this->hash($password);
     if($compare_password == $db_hashed_pwd){
     // if (password_verify($_POST["password"], $db_hashed_pwd)) {
        // ４．認証成功なら、セッションIDを新規に発行する
        //var_dump($_POST["password"]);
        session_regenerate_id(true);
          $_SESSION["user_name"] = $user_id;
        return true;
        exit;
      } else {
        // 認証失敗
        throw new Exception('パスワードが一致しません。');
        //$errorMessage = "ユーザIDあるいはパスワードに誤りがあります。";
      } 
    return false;
  }


  /**
   * 現在ログイン中のユーザをログアウトします。
   */
  public function logout(){
    $_SESSION = array(); 
    session_destroy();
  }



}
?>