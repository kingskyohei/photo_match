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


  public show_profile(){

  }
}
 

class Model extends User{

  private $user_id;

  function __construct(){
    $user_id=null;
  }

  public show_profile(){

  }


}


class Cameraman extends User{

  private $user_id;

  function __construct(){
    $user_id=null;
  }

  public show_profile(){
    
  }


}