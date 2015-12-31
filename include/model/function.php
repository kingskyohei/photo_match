<?php

/**
 * ユーザーマスタクラス
 * モデル、カメラマンのプロフィール情報を格納するユーザーマスタへのCRUDを定義
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
   *　DB接続情報
   */
  function __construct(){
    $this->dbh = new PDO(
      DB_HOST, 
      DB_USER, 
      DB_PASSWD
    );
    session_start();
  }

  //パスワードのハッシュ化
  private function hash($password){
    return md5($password . self::SALT);
  }

  /**
   * 指定したユーザを新規登録します。
   *
   * @param string $username ユーザ名
   * @param string $password パスワード
   *　@param　array $register_info_array 登録情報
   *
   * @return 成功したかどうか
   */
  public function register($user_name, $password,$register_info_array){
    //DB接続情報
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

    //成功したらtrueを返す
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
      
      $prepare->bindValue(':user_name',$user_name,PDO::PARAM_STR);
      //foreach($dbh->query("SELECT * FROM pm_user WHERE user_login = '" . $user_id . "'") as $row) {
      $prepare->execute();
      $rtn = null;
      /*  */
      while ($row = $prepare->fetch(PDO::FETCH_ASSOC)) {
        $db_hashed_pwd = $row['password'];
        $rtn['user_id'] = $row['user_id'];
        $rtn['user_kbn'] = $row['user_kbn'];
      }
  	 $dbh = null;

      // ３．画面から入力されたパスワードとデータベースから取得したパスワードのハッシュを比較します。
     $compare_password = $this->hash($password);

     
     if($compare_password == $db_hashed_pwd){

     // ４．認証成功なら、セッションIDを新規に発行する
        session_regenerate_id(true);

        return $rtn;
        exit;
      } else {
        // 認証失敗
        throw new Exception('パスワードが一致しません。');
        //$errorMessage = "ユーザIDあるいはパスワードに誤りがあります。";
      } 
    return false;
  }


 /**
   * プロフィール情報の表示
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

    //var_dump($result);  
 

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
 *　ユーザー同士の予約情報を格納する予約テーブルへのCRUDを定義
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
   * 予約を登録する
   *
   * @param string $username ユーザ名
   * @param string $password パスワード
   * @param array $yoyaku_info_list 予約情報
   *
   * @return 成功したかどうか
   */
  public function yoyaku_insert($user_id, $mt_user_id, $yoyaku_info_list){
    // DB接続情報
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

    $prepare = $dbh->prepare("INSERT INTO yoyaku_table(user_id,mt_user_id,title,content,place,year,month,date,start_time,end_time,hour,check_flg,syonin_flg,register_time) VALUES (:user_id, :mt_user_id, :title, :content,:place,:year,:month,:date,:start_time,:end_time,:hour,0,0,cast(now() as datetime))");

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
    return $prepare -> execute();

  }

 /**
   * ユーザーに紐づく予約情報を表示する
   *
   * @param int user_id ユーザID
   * 
   * @return $result(user_mstの登録情報)
   */
  public function yoyaku_show($user_id){

    $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);

    $prepare = $dbh->prepare('SELECT * FROM yoyaku_table WHERE user_id = :user_id and syonin_flg = 0 ');

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
   * 承認された予約の承認フラグを更新する
   *
   * @param int status 承認フラグの値
   *　@param  int yoyaku_id 予約ID
   * @return $result(user_mstの登録情報)
   */
  public function yoyaku_update($status,$yoyaku_id){

    $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);
    
    //予約番号の承認フラグを1にする
    $prepare = $dbh->prepare('update yoyaku_table set syonin_flg = :syonin_flg WHERE yoyaku_id = :yoyaku_id');

    $prepare->bindValue(':yoyaku_id', $yoyaku_id, PDO::PARAM_STR); 
    $prepare->bindValue(':syonin_flg', $status, PDO::PARAM_INT); 

    $result = $prepare->execute();
    return $result;

  }

}

/**
 * カメラ道具テーブルクラス
 *　カメラマンの所有するカメラやレンズの情報を格納するカメラ道具テーブルへのCRUDを定義
 */
class Tool_Tbl_Access{
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
   * カメラマンの道具を表示する
   *
   *　@param  int user_id ユーザーID
   * @return $result(user_mstの登録情報)
   */
  public function show_tool($user_id){

    $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);

    $prepare = $dbh->prepare('SELECT * FROM tool_table WHERE user_id = :user_id');

    $prepare->bindValue(':user_id', intval($user_id), PDO::PARAM_INT); 

    $prepare->execute();

    $result = $prepare->fetchAll();

    if (!isset($result)) {
      throw new Exception('結果がありません');
    }else{
      return $result;
    }

  }
}

/**
 * カメラ道具テーブルクラス
 *　会員同士で成立した予約情報を格納するマッチングテーブルへのCRUDを定義
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
   * ユーザーに紐づくマッチング情報（予定一覧）を表示する
   *
   * @param int user_id ユーザID
   * 
   * @return $result　予約情報一覧
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
   * プロフィール画面でユーザーの確定予約情報をスケジュール表示する
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

   /**
   * マッチングテーブルに確定した（承認された）予約を登録する。
   *
   * @param int yoyaku_id 予約ID
   * 
   * @return $result
   */
  public function match_insert($yoyaku_id){

    $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);

    $prepare = $dbh->prepare('SELECT * FROM yoyaku_table WHERE yoyaku_id = :yoyaku_id');

    $prepare->bindValue(':yoyaku_id', $yoyaku_id, PDO::PARAM_INT); 

    $prepare->execute();

    $result = $prepare->fetchAll();

    foreach($result as $row){
      //予定依頼者
      $user_id = $row['user_id'];
      //予定依頼者区分値
      $user_kbn = $row['user_kbn'];
      //予定承諾者
      $mt_user_id = $row['mt_user_id'];
      //予定承諾者区分
      $mt_user_kbn = $row['mt_user_kbn'];
      //予定のタイトル
      $title = $row['title'];
      //予定の内容
      $content = $row['content'];
      //予定の場所
      $place = $row['place'];
      //年
      $year = $row['year'];
      //月
      $month = $row['month'];
      //日
      $date = $row['date'];
      //開始時間
      $start_time = $row['start_time'];
      //終了時間
      $end_time = $row['end_time'];
      //所要時間
      $hour = $row['hour'];
      //チェックフラグ
      $check_flg = $row['check_flg'];      
      //承認フラグ
      $syonin_flg = $row['syonin_flg'];
      //登録日時
      $register_time = $row['register_date'];

    }

    $prepare = $dbh->prepare("INSERT INTO `match_table`(`yoyaku_id`, `user_id`, `user_kbn`, `mt_user_id`, `mt_user_kbn`, `title`, `year`, `month`, `date`, `start_time`, `end_time`, `hour`, `price`, `register_date`) VALUES (:yoyaku_id,:user_id,:user_kbn,:mt_user_id,:mt_user_kbn,:title,:year,:month,:date,:start_time,:end_time,:hour,:price,cast(now() as datetime))");

    $prepare->bindValue(':yoyaku_id',$yoyaku_id,PDO::PARAM_INT);
    $prepare->bindValue(':user_id',$user_id,PDO::PARAM_INT);
    $prepare->bindValue(':user_kbn',$user_kbn,PDO::PARAM_INT);
    $prepare->bindValue(':mt_user_id',$mt_user_id,PDO::PARAM_INT);
    $prepare->bindValue(':mt_user_kbn',$mt_user_kbn,PDO::PARAM_INT);
    $prepare->bindValue(':title',$title,PDO::PARAM_STR);
    $prepare->bindValue(':year',$year,PDO::PARAM_STR);
    $prepare->bindValue(':month',$month,PDO::PARAM_STR);
    $prepare->bindValue(':date',$date,PDO::PARAM_STR);
    $prepare->bindValue(':start_time',$start_time,PDO::PARAM_STR);
    $prepare->bindValue(':end_time',$end_time,PDO::PARAM_STR);
    $prepare->bindValue(':hour',$hour,PDO::PARAM_INT);
    $prepare->bindValue(':price',2000,PDO::PARAM_INT);

    //insertを実行
    return $prepare -> execute();
    exit;
  }
}

/**
 * フォトテーブルクラス
 *　写真情報を格納するフォトテーブルへのCRUDを定義
 */
class Photo_Tbl_Access{
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
   * ユーザーに紐づく写真を一覧表示する。
   *
   * @param int user_id ユーザID
   * 
   * @return $result
   */
  public function photo_list($user_id){

    $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);

    $prepare = $dbh->prepare('SELECT * FROM photo_table WHERE user_id = :user_id');

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
   * プロフィール用の写真の表示(photo_listと処理内容同じのため不要？)
   *
   * @param int user_id ユーザID
   * 
   * @return $result
   */
  public function profile_show($user_id){

    $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);

    $prepare = $dbh->prepare('SELECT * FROM photo_table WHERE user_id = :user_id');

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
   * 写真のアップロード処理（DBに写真を登録）
   *
   * @param int user_id ユーザID
   * @param file file ファイル
   * @param array info 写真の基本情報    
   * @return $result
   */
  public function upload_photo($user_id,$file,$info){

    $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);

    // INSERT処理
    $stmt = $dbh->prepare('INSERT INTO image(name,type,raw_data,thumb_data,date) VALUES(?,?,?,?,?)');
    $stmt->execute([
        $file['name'],
        $info[2],
        file_get_contents($file['tmp_name']),
        ob_get_clean(), // バッファからデータを取得してクリア
        (new DateTime('now', new DateTimeZone('Asia/Tokyo')))->format('Y-m-d H:i:s'),
    ]);

    if (!isset($result)) {
      throw new Exception('結果がありません');
    }else{
      return $result;
    }
    
  }

 /**
   * 写真表示処理
   *
   * @param int user_id ユーザID  
   * @return $result
   */
  public function show_photo($user_id){

    $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);
    // サムネイル一覧取得
    $rows = $dbh->query('SELECT id,name,type,thumb_data,date FROM image ORDER BY date DESC') -> fetchAll();

    return $rows;

  }

 /**
   * 写真表示処理
   *
   * @param int user_id ユーザID  
   * @return $result
   */
  public function show_photos($user_id){

    $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);

    $prepare = $dbh->prepare('SELECT * FROM photo_table where user_id = :user_id');

    $prepare->bindValue(':user_id', intval($user_id), PDO::PARAM_INT); 

    $prepare->execute();

    $result = $prepare->fetchAll();
    
    return $result;

  }

}


/**
 * メッセージテーブルクラス
 *　メッセージ情報を格納するメッセージテーブルへのCRUDを定義
 */
class Msg_Tbl_Access{
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
   * メッセージ送信処理
   *
   * @param int user_id ユーザID
   * @param int mt_user_id 相手ユーザID 
   * @param array mst_array メッセージ情報 
   * @return $result
   */
  public function msg_send($user_id,$mt_user_id,$msg_array){
    //var_dump($user_id);
    //var_dump($mt_user_id);
    //var_dump($message);

    $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);
    
    $prepare = $dbh->prepare("INSERT INTO message_table(user_id,mt_user_id,title,message,sent_time,receive_time,kidoku_flg) VALUES(:user_id,:mt_user_id,:title,:message,:sent_time,:receive_time,:kidoku_flg)");
    //$prepare = $dbh->prepare("INSERT INTO yoyaku_table(user_id,mt_user_id,title,content,place,year,month,date,start_time,end_time,hour,check_flg,syonin_flg,register_time) VALUES (:user_id, :mt_user_id, :title, :content,:place,:year,:month,:date,:start_time,:end_time,:hour,0,0,cast(now() as datetime))");

    /*送信時間*/
    $sent_time_date = date('c');
    $sent_time = (string) $sent_time_date;

    /*受信時間*/
    

    $prepare->bindValue(':user_id',$user_id,PDO::PARAM_INT);
    $prepare->bindValue(':mt_user_id',$mt_user_id,PDO::PARAM_INT);
    $prepare->bindValue(':title',$msg_array['title'],PDO::PARAM_STR);
    $prepare->bindValue(':message',$msg_array['message'],PDO::PARAM_STR);
    $prepare->bindValue(':sent_time',$sent_time,PDO::PARAM_STR);
    $prepare->bindValue(':receive_time',"",PDO::PARAM_STR);
    $prepare->bindValue(':kidoku_flg',0,PDO::PARAM_INT);

    // INSERT処理
    /*
    $stmt = $dbh->prepare('INSERT INTO message_table(user_id,mt_user_id,message,sent_time,receive_time,kidoku_flg) VALUES(:user_id,:mt_user_id,:message,:sent_time,:receive_time,:kidoku_flg)');
    $stmt->execute([
      $prepare->bindValue(':user_id', $user_id, PDO::PARAM_INT); 
      $prepare->bindValue(':mt_user_id', $mt_user_id, PDO::PARAM_INT); 
      $prepare->bindValue(':message', $message, PDO::PARAM_STR);
      $prepare->bindValue(':sent_time', $sent_time, PDO::PARAM_STR);
      $prepare->bindValue(':receive_time', $receive_time, PDO::PARAM_STR);  
      $prepare->bindValue(':kidoku_flg', $kidoku_flg, PDO::PARAM_INT);  
    ]);
*/
    //var_dump($prepare -> execute());
    return $prepare -> execute();
  }

 /**
   * メッセージ受信処理
   *
   * @param int user_id ユーザID
   * 
   * @return $result
   */
  public function msg_receive($user_id){

    $dbh = new PDO(DB_HOST, DB_USER, DB_PASSWD);
    // 取得処理
    // メッセージ取得
    $prepare = $dbh->prepare('SELECT * FROM message_table WHERE user_id = :user_id');

    $prepare->bindValue(':user_id', $user_id, PDO::PARAM_INT); 
   
    $prepare->execute();

    $result = $prepare->fetchAll();

    if (!isset($result)) {
      throw new Exception('結果がありません');
    }else{
      return $result;
    }
    
  }

}

?>