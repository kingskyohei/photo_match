<?php

/**
 * ユーザーマスタクラス
 * モデルクラス、カメラマンクラスのスーパークラス
 * ユーザーが使用できる機能を定義
 */
class User{
  //設定

  private $user_id;

  /**
   * コンストラクタ
   */
  function __construct(){
    $user_id = null;
  }

  /**
   * 指定したユーザのプロフィールを表示します。
   *
   * @param int $user_id ユーザーID
   * @param string $kbn 区分
   * @return プロフィール情報
   */
  public function show_profile($user_id,$kbn){

    return $profile;
  }

  /**
   * 指定したユーザを新規登録します。
   *
   * @param string $user_name ユーザー名
   * @param string $password パスワード
   * @param array $register_info_array 登録情報
   * @return 結果成否
   */
  public function register($user_name,$password,$register_info_array){
    // user_mstのインスタンス生成
    $user_mst_access = new User_Mst_Access();
    $result = $user_mst_access -> register($user_name, $password,$register_info_array);

    return $result;

  }
}
 
/**
 * モデルクラス
 * モデルが使用できる機能の詳細を定義
 */
class Model extends User{

  private $user_id;
  private $user_kbn;

  function __construct(){
    $user_id = null;
    $user_kbn = null;
  }

  /**
   * モデルのプロフィール表示処理
   *
   * @param string $user_id ユーザーID
   * @param string $user_kbn ユーザー区分
   * @return プロフィール情報
   */
  public function show_profile($user_id,$user_kbn){
    $profile = new Profile();
    $profile_set = $profile -> show_m_profile($user_id);
    //var_dump($profile_set);
    return $profile_set;
  }


}

/**
 * カメラマンクラス
 * カメラマンが使用できる機能の詳細を定義
 */
class Cameraman extends User{

  private $user_id;
  private $user_kbn;

  function __construct(){
    $user_id = null;
    $user_kbn = null;
  }

  /**
   * カメラマンのプロフィール表示処理
   *
   * @param string $user_id ユーザーID
   * @param string $user_kbn ユーザー区分
   * @return プロフィール情報
   */
  public function show_profile($user_id,$user_kbn){
    $profile = new Profile();
    $profile_set = $profile -> show_c_profile($user_id);

    return $profile_set;
    
  }

  /**
   * カメラマンの写真表示処理
   *
   * @param string $user_id ユーザーID
   * @return 写真情報
   */
  public function show_photos($user_id){
    $photo = new Photo();

    $result = $photo -> show_photos($user_id);

    return $result;
  }

}

/**
 * プロフィールクラス
 * プロフィール情報に関するユーザー種別ごとの処理を定義
 */
class Profile{
  
  private $user_id;

  /**
   * カメラマンの写真表示処理
   *
   * @param string $user_id ユーザーID
   * @return プロフィール情報
   */
  public function show_c_profile($user_id){

      $profile = null;

      /*ユーザーマスタにアクセス */
      $user = new User_Mst_Access();
      $profile = $user ->show_profile($user_id);
      //var_dump($profile);
      /*ツールテーブルにアクセス */
      //$tool = new Tool_Tbl_Access();
      //$tool_profile = $tool -> show_tool($user_id);
      //var_dump($tool_profile);
      /*フォトテーブルにアクセス*/
      //$photo = new Photo();
      //$photo_list = $photo -> show_photos($user_id);
      //var_dump($tool_profile);
      //$profile_set = array_merge($profile,$tool_profile);
      //$profile_photo_set = array_merge($profile_set,$photo_list); 
      //var_dump($profile_photo_set);
      /*profile情報を配列にセット*/
      //var_dump($profile_set);
      return $profile;

  }

   /**
   * モデルのプロフィール表示処理
   *
   * @param string $user_id ユーザーID
   * @return プロフィール情報
   */
  public function show_m_profile($user_id){
      
      $profile = null;

      /*ユーザーマスタにアクセス */
      $user = new User_Mst_Access();
      $profile = $user ->show_profile($user_id);

      return $profile;
  }
}

/**
 * 予約情報クラス
 * 予約情報に関する処理を定義
 */
  class Yoyaku{

   /**
   * モデルのプロフィール表示処理
   *
   * @param string $user_id ユーザーID
   * @return プロフィール情報
   */
    public function match_show($user_id){

      $match = new Yoyaku_Tbl_Access();

      $result = $match -> yoyaku_show($user_id);

      return $result;

    }

   /**
   * モデルのプロフィール表示処理
   *
   * @param string $user_id ユーザーID
   * @param string $mt_user_id 相手ユーザーID
   * @param array $yoyaku_info_list 予約情報
   * @return プロフィール情報
   */
    public function yoyaku_insert($user_id, $mt_user_id, $yoyaku_info_list){

      $yoyaku = new Yoyaku_Tbl_Access();

      $result = $yoyaku -> yoyaku_insert($user_id, $mt_user_id, $yoyaku_info_list);

      return $result;

    }

   /**
   * モデルのプロフィール表示処理
   *
   * @param string $status ユーザーID
   * @param string $yoyaku_id 予約ID
   * @return プロフィール情報
   */
    public function yoyaku_update($status,$yoyaku_id){

      $yoyaku = new Yoyaku_Tbl_Access();

      $result = $yoyaku -> yoyaku_update($status,$yoyaku_id);

    }


   /**
   * モデルのプロフィール表示処理
   *
   * @param string $yoyaku_id 予約ID
   * @return プロフィール情報
   */
    public function match_insert($yoyaku_id){

      $match = new Match_Tbl_Access();

      $match -> match_insert($yoyaku_id);
    }

}

/**
 *　アルバムクラス
 * 
 * @param string $user_id ユーザーID
 * @return プロフィール情報
 */
  class Album{

    private $album_id;

    public function create_album($user_id){

    }

} 

/**
 *　写真クラス
 * 
 * @param string $user_id ユーザーID
 * @return プロフィール情報
 */
  class Photo{

    private $photo_id;

    public function insert_photo($user_id,$file){
    //var_dump($user_id);   

    /* HTML特殊文字をエスケープする関数 */
    /*
    function h($str) {

      return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
    */
    try {

      /* アップロードがあったとき */
      if (isset($file['error']) && is_int($file['error'])) {

          // バッファリングを開始
          ob_start();

          try {
              $files = new Photo_Tbl_Access();

              //var_dump($_FILES['upfile']['error']);
              // $_FILES['upfile']['error'] の値を確認
              switch ($file['upfile']['error']) {
                  case UPLOAD_ERR_OK: // OK
                      break;
                  case UPLOAD_ERR_NO_FILE:   // ファイル未選択
                      throw new RuntimeException('ファイルが選択されていません', 400);
                  case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
                  case UPLOAD_ERR_FORM_SIZE: // フォーム定義の最大サイズ超過
                      throw new RuntimeException('ファイルサイズが大きすぎます', 400);
                  default:
                      throw new RuntimeException('その他のエラーが発生しました', 500);
              }

              // $_FILES['upfile']['mime']の値はブラウザ側で偽装可能なので
              // MIMEタイプを自前でチェックする
              if (!$info = @getimagesize($file['tmp_name'])) {
                  throw new RuntimeException('有効な画像ファイルを指定してください', 400);
              }

              if (!in_array($info[2], [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
                  throw new RuntimeException('未対応の画像形式です', 400);
              }

              $obs = "return2";

              // サムネイルをバッファに出力
              $create = str_replace('/', 'createfrom', $info['mime']);
              $output = str_replace('/', '', $info['mime']);
              if ($info[0] >= $info[1]) {
                  $dst_w = 120;
                  $dst_h = ceil(120 * $info[1] / max($info[0], 1));
              } else {
                  $dst_w = ceil(120 * $info[0] / max($info[1], 1));
                  $dst_h = 120;
              }
              if (!$src = @$create($_FILES['upfile']['tmp_name'])) {
                  throw new RuntimeException('画像リソースの生成に失敗しました', 500);
              } 
              $dst = imagecreatetruecolor($dst_w, $dst_h);
              imagecopyresampled($dst, $src, 0, 0, 0, 0, $dst_w, $dst_h, $info[0], $info[1]);
              $output($dst);
              imagedestroy($src);
              imagedestroy($dst);

              var_dump($files); 
              $result = $files -> upload_photo($user_id,$file,$info);

              $msgs[] = ['green', 'ファイルは正常にアップロードされました'];

          } catch (RuntimeException $e) {

              while (ob_get_level()) {
                  ob_end_clean(); // バッファをクリア
              }
              http_response_code($e instanceof PDOException ? 500 : $e->getCode());
              $msgs[] = ['red', $e->getMessage()];

          }

      /* ID指定があったとき */
      } elseif (isset($_GET['id'])) {

          try {

              $stmt = $pdo->prepare('SELECT type, raw_data FROM image WHERE id = ? LIMIT 1');
              $stmt->bindValue(1, $_GET['id'], PDO::PARAM_INT);
              $stmt->execute();
              if (!$row = $stmt->fetch()) {
                  throw new RuntimeException('該当する画像は存在しません', 404);
              }
              header('X-Content-Type-Options: nosniff');
              header('Content-Type: ' . image_type_to_mime_type($row['type']));
              echo $row['raw_data'];
              exit;

          } catch (RuntimeException $e) {

              http_response_code($e instanceof PDOException ? 500 : $e->getCode());
              $msgs[] = ['red', $e->getMessage()];

          }

      }

    }catch(Exception $e){

    }
    return $obs;
  }

/**
 *　写真クラス
 * @param string $user_id ユーザーID
 * @return プロフィール情報
 */
  public function show_photo($user_id){

    $photo_list = new Photo_Tbl_Access();

    $result = $photo_list -> show_photo($user_id);
    
    return $result;

  }

/**
 *　写真クラス
 * @param string $user_id ユーザーID
 * @return プロフィール情報
 */
  public function show_photos($user_id){

    $photo_list = new Photo_Tbl_Access();

    $result = $photo_list -> show_photos($user_id);

    return $result;

  }

}

/**
 *　メッセージクラス
 * 
 * @return プロフィール情報
 */
  class Message{

    private $user_id;

  /**
   * @param string $user_id ユーザーID
   * @param string $mt_user_id 相手ユーザーID
   * @param string $msg_array
   * @return 
   */
    public function msg_send($user_id,$mt_user_id,$msg_array){

      $msg = new Msg_Tbl_Access();

      $result = $msg -> msg_send($user_id,$mt_user_id,$msg_array);

    return $result;

    }

  /**
   * @param string $user_id ユーザーID
   * @return $result
   * 
   */
    public function msg_receive($user_id){

      $msg = new Msg_Tbl_Access();

      $result = $msg -> msg_receive($user_id);

    return $result;

    }

}