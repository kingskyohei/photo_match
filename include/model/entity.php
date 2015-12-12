<?php

/**
 * ユーザーマスタクラス
 */
class User{
  //設定

  private $user_id;

  /**
   * コンストラクタ
   */
  function __construct(){
    $user_id=null;
  }


  public function show_profile($user_id,$kbn){

    return $profile;
  }
}
 

class Model extends User{

  private $user_id;
  private $user_kbn;

  function __construct(){
    $user_id = null;
    $user_kbn = null;
  }

  public function show_profile($user_id,$user_kbn){
    $profile = new Profile();
    $profile_set = $profile -> show_m_profile($user_id);

    return $profile_set;
  }
}


class Cameraman extends User{

  private $user_id;
  private $user_kbn;

  function __construct(){
    $user_id = null;
    $user_kbn = null;
  }

  public function show_profile($user_id,$user_kbn){
    $profile = new Profile();
    $profile_set = $profile -> show_c_profile($user_id);

    return $profile_set;
    
  }
}

class Profile{
  
  private $user_id;

  public function show_c_profile($user_id){

      $profile=null;
      /*ユーザーマスタにアクセス */
      $user = new User_Mst_Access();
      $profile = $user ->show_profile($user_id);
      /*ツールテーブルにアクセス */
      $tool = new Tool_Tbl_Access();
      $tool_profile = $tool -> show_tool($user_id);
      //var_dump($tool_profile);
      $profile_set = array_merge($profile,$tool_profile);
      /*profile情報を配列にセット*/
      //var_dump($profile_set);
      return $profile_set;

  }
  
  public function show_m_profile(){
      
      $profile = null;

      /*ユーザーマスタにアクセス */
      $user = new User_Mst_Access();
      $profile = $user ->show_profile($user_id);

      return $profile;
  }
}

  class Yoyaku{
    private $user_id;

    public function match_show($user_id){

      $match = new Match_Tbl_Access;

      $result = $match -> match_show($user_id);

      return $result;

    }


}