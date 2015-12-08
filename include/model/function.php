<?php

/**
 * ユーザーマスタクラス
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
      var_dump($user_name);

      $prepare = $dbh->prepare('SELECT * FROM user_mst WHERE user_name = :user_name');
      
      $prepare->bindValue(':user_name',$user_name,PDO::PARAM_STR);
      //foreach($dbh->query("SELECT * FROM pm_user WHERE user_login = '" . $user_id . "'") as $row) {
      $prepare->execute();

      /*  */
      while ($row = $prepare->fetch(PDO::FETCH_ASSOC)) {
        $db_hashed_pwd = $row['password'];
        $user_id = $row['user_id'];
      }

  	 $dbh = null;

     //var_dump($user_id);
      // ３．画面から入力されたパスワードとデータベースから取得したパスワードのハッシュを比較します。
      //if ($_POST["password"] == $pw) {
     $compare_password = $this->hash($password);

     
     if($compare_password == $db_hashed_pwd){

     // ４．認証成功なら、セッションIDを新規に発行する
     //var_dump($_POST["password"]);
        session_regenerate_id(true);

        return $user_id;
        exit;
      } else {
        // 認証失敗
        throw new Exception('パスワードが一致しません。');
        //$errorMessage = "ユーザIDあるいはパスワードに誤りがあります。";
      } 
    return false;
  }


 /**
   * 指定したユーザを新規登録します。
   *
   * @param int user_id ユーザID
   * 
   * @return $result(user_mstの登録情報)
   */
  public function show_profile($user_id){


    $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);

    $prepare = $dbh->prepare('SELECT * FROM user_mst WHERE user_id = :user_id');

    $prepare->bindValue(':user_id', $user_id, PDO::PARAM_INT); 

    $prepare->execute();

    $result = $prepare->fetchAll();
 

    if (!isset($result)) {
      throw new Exception('結果がありません');
    }else{
      return $result;
    }
    //$dbh = null;
  }

  /**
   * 現在ログイン中のユーザをログアウトします。
   */
  public function logout(){
    $_SESSION = array(); 
    session_destroy();
  }



}




/**
 * 予約テーブルクラス
 */
class Yoyaku_Tbl_Access{
  //設定
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
  }

  /**
   * 指定したユーザを新規登録します。
   *
   * @param string $username ユーザ名
   * @param string $password パスワード
   *
   * @return 成功したかどうか
   */
  public function yoyaku_insert($user_id, $mt_user_id,$yoyaku_info_list){
    $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);
    // ユーザーID
    $ins_user_id = $user_id;
    // 予約相手のユーザーID
    $ins_mt_user_id = $mt_user_id;  
    // タイトル
    $ins_title = $yoyaku_info_list['title'];
    // コンテント
    $ins_content = $yoyaku_info_list['content'];
    // 場所
    $ins_place = $yoyaku_info_list['place'];
    // 要求種別
    //$ins_request = $yoyaku_info_list['request'];
    // 年
    $ins_year = $yoyaku_info_list['year'];
    // 月
    $ins_month = $yoyaku_info_list['month'];
    // 日程
    $ins_date = $yoyaku_info_list['date'];
    // 開始時間
    $ins_start_time = $yoyaku_info_list['start_time'];
    // 終了時間
    $ins_end_time = $yoyaku_info_list['end_time'];
    // 所要時間
    $ins_hour = $yoyaku_info_list['hour'];
/*
    var_dump($ins_user_id);
    var_dump($ins_mt_user_id);
    var_dump($ins_title);
    var_dump($ins_content);
    var_dump($ins_place);
    var_dump($ins_year);
    var_dump($ins_month);
    var_dump($ins_date);
    var_dump($ins_start_time);
    var_dump($ins_end_time);
    var_dump($ins_hour);
*/


    $prepare = $dbh->prepare("INSERT INTO yoyaku_table(user_id,mt_user_id,title,content,place,year,month,date,start_time,end_time,hour,check_flg,syonin_flg,register_date) VALUES (:user_id, :mt_user_id, :title, :content,:place,:year,:month,:date,:start_time,:end_time,:hour,0,0,cast(now() as datetime))");
    var_dump( $dbh->prepare("INSERT INTO yoyaku_table(user_id,mt_user_id,title,content,place,year,month,date,start_time,end_time,hour,check_flg,syonin_flg,register_date) VALUES (:user_id, :mt_user_id, :title, :content,:place,:year,:month,:date,:start_time,:end_time,:hour,0,0,cast(now() as datetime))"));
    $prepare->bindValue(':user_id',$ins_user_id,PDO::PARAM_INT);
    $prepare->bindValue(':mt_user_id',$ins_mt_user_id,PDO::PARAM_INT);
    $prepare->bindValue(':title',$ins_title,PDO::PARAM_STR);
    $prepare->bindValue(':content',$ins_content,PDO::PARAM_STR);
    $prepare->bindValue(':place',$ins_place,PDO::PARAM_STR);
    $prepare->bindValue(':year',$ins_year,PDO::PARAM_STR);
    $prepare->bindValue(':month',$ins_month,PDO::PARAM_STR);
    $prepare->bindValue(':date',$ins_date,PDO::PARAM_STR);
    $prepare->bindValue(':start_time',$ins_start_time,PDO::PARAM_STR);
    $prepare->bindValue(':end_time',$ins_end_time,PDO::PARAM_STR);
    $prepare->bindValue(':hour',$ins_hour,PDO::PARAM_STR);

    //insertを実行
    return $prepare ->execute();

    //$result = $dbh->prepare("select * from yoyaku_talbe ");




    //成功したらtrue

  }

 /**
   * 指定したユーザを新規登録します。
   *
   * @param int user_id ユーザID
   * 
   * @return $result(user_mstの登録情報)
   */
  public function yoyaku_show($user_id){

    $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);

    $prepare = $dbh->prepare('SELECT * FROM yoyaku_table WHERE user_id = :user_id');

    $prepare->bindValue(':user_id', $user_id, PDO::PARAM_INT); 

    $prepare->execute();

    $result = $prepare->fetchAll();


    if (!isset($result)) {
      throw new Exception('結果がありません');
    }else{
      return $result;
    }
    
    //$dbh = null;

  }

}


/**
 * マッチングテーブルクラス
 */
class Match_Tbl_Access{
  //設定
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
  }

 /**
   * 指定したユーザを新規登録します。
   *
   * @param int user_id ユーザID
   * 
   * @return $result
   */
  public function match_show($user_id){

    $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);

    $prepare = $dbh->prepare('SELECT * FROM match_table WHERE user_id = :user_id');

    $prepare->bindValue(':user_id', $user_id, PDO::PARAM_INT); 

    $prepare->execute();

    $result = $prepare->fetchAll();

    if (!isset($result)) {
      throw new Exception('結果がありません');
    }else{
      return $result;
    }
    
    //$dbh = null;

  }


 /**
   * 指定したユーザを新規登録します。
   *
   * @param int user_id ユーザID
   * 
   * @return $result
   */
  public function schedule_show($user_id){
    $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);

    $prepare = $dbh->prepare('SELECT * FROM match_table WHERE mt_user_id = :user_id');

    $prepare->bindValue(':user_id', $user_id, PDO::PARAM_INT); 

    $prepare->execute();

    $result = $prepare->fetchAll();

    if (!isset($result)) {
      throw new Exception('結果がありません');
    }else{
      return $result;
    }
    
    //$dbh = null;

  }
}




?>