<?php
//require 'password.php';
// セッション開始
session_start();

$db['host'] = "localhost";  // DBサーバのurl
$db['user'] = "root";
$db['pass'] = "kings531";
$db['dbname'] = "photo_match";


$user_id = $_POST["userid"];

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["userid"])) {

  // １．ユーザIDの入力チェック
  if (empty($_POST["userid"])) {
    $errorMessage = "ユーザIDが未入力です。";
  } else if (empty($_POST["password"])) {
    $errorMessage = "パスワードが未入力です。";
  } 

  // ２．ユーザIDとパスワードが入力されていたら認証する
  if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
    // mysqlへの接続
    $mysqli = new mysqli($db['host'], $db['user'], $db['pass']);
    if ($mysqli->connect_errno) {
      print('<p>データベースへの接続に失敗しました。</p>' . $mysqli->connect_error);
      exit();
    }

    // データベースの選択
    $mysqli->select_db($db['dbname']);

    // 入力値のサニタイズ
    $userid = $mysqli->real_escape_string($_POST["userid"]);
  
    // クエリの実行
    $query = "SELECT * FROM pm_user WHERE user_login = '" . $userid . "'";

    $result = $mysqli->query($query);

    if (!$result) {
      print('クエリーが失敗しました。' . $mysqli->error);
      $mysqli->close();
      exit();
    }

    while ($row = $result->fetch_assoc()) {
      // パスワード(暗号化済み）の取り出し
      $db_hashed_pwd = $row['user_pass'];
      $user_id = $row['user_id'];
    }
    //var_dump($row['user_pass']);
    // データベースの切断
    /*
    $mysqli->close();
    $options = [
        'cost' => 12,
    ];

    $hash = password_hash ( $db_hashed_pwd , $options );
    
    */
    
    // ３．画面から入力されたパスワードとデータベースから取得したパスワードのハッシュを比較します。
    //if ($_POST["password"] == $pw) {
   if($_POST["password"] == $db_hashed_pwd){
   // if (password_verify($_POST["password"], $db_hashed_pwd)) {
      // ４．認証成功なら、セッションIDを新規に発行する
      //var_dump($_POST["password"]);
      session_regenerate_id(true);
      $_SESSION["userid"] = $user_id;
      header("Location: mypage.php");

      exit;
    } 
    else {
      // 認証失敗
      $errorMessage = "ユーザIDあるいはパスワードに誤りがあります。";
    } 
  } else {
    // 未入力なら何もしない
  } 
} 
 
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
  <title>シングルページレイアウト</title>
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:700,400">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/jquery-1.11.3.min.js"></script>
  <script src="lib/placeholders.min.js"></script>
  <script src="js/jquery.lightbox_me.js"></script>
  <script>
  $(function(){
    $('#login').click(function(e) {
      $('#sign_up').lightbox_me({
        centered: true, 
        onLoad: function() { 
            $('#login').find('input:first').focus()
        }
      });
      e.preventDefault();
	});
  });
  </script>

</head>
<body>
  <header class="header">
    <p class="site-title-sub">PHOTOGRAPHER × MODEL</p>
    <h1 class="site-title">MODEL SEARCH</h1>
    <p class="site-description">Check out our Service!</p>
    <div class="buttons">
      <a class="button" href="#about">新規登録</a>
      <div class="button button-showy"><input type="submit" id="login" name="login" value="ログイン"></div>
    </div>
  </header>
  <section class="about" id="about">
    <h2 class="heading">CONCEPT</h2>
    <p class="about-text">
      フォトグラファーとモデルをマッチングさせるサイトです<br>
      自分の好きな時間に、好きな場所で最高の一枚を撮れるサービス
    </p>
    <p class="about-text">
      このサービスはモデルとカメラマンが自分のプロフェッショナルスキルを使って、自由に作品を作る機会を提供します。<br>
      マッチングサイト上では、自分の写真を他人に共有したり公開することで、仲間や仕事を見つけることができます。
    </p>
  </section>
  <section class="works">
    <h2 class="heading">USERS</h2>
    <div class="works-wrapper">
      <div class="work-box tree">
        <img class="work-image" src="images/photo1.jpg" alt="制作事例1_">
        <div class="work-description">
          <div class="work-description-inner">
            <p class="work-text">
              写真家　名前　入力<br>
              カメラ歴 15年<br>
              使用ツール：Canon 5D<br>
              <a href="#" class="button button-ghost">READ MORE</a>
            </p>
          </div>
        </div>
      </div>
      <div class="work-box building">
        <img class="work-image" src="images/photo2.jpg" alt="制作事例2">
        <div class="work-description">
          <div class="work-description-inner">
            <p class="work-text">
              写真家　名前　入力<br>
              カメラ歴 15年<br>
              使用ツール：Canon 5D<br>
              <a href="#" class="button button-ghost">READ MORE</a>
            </p>
          </div>
        </div>
      </div>
      <div class="work-box lake">
        <img class="work-image" src="images/photo3.jpg" alt="制作事例3">
        <div class="work-description">
          <div class="work-description-inner">
            <p class="work-text">
              写真家　名前　入力<br>
              カメラ歴 15年<br>
              使用ツール：Canon 5D<br>
              <a href="./main.php?user_id=2" class="button button-ghost">READ MORE</a>
            </p>
          </div>
        </div>
      </div>
      <div class="work-box sky">
        <img class="work-image" src="images/photo4.jpg" alt="制作事例4">
        <div class="work-description">
          <div class="work-description-inner">
            <p class="work-text">
              写真家　名前　入力<br>
              カメラ歴 15年<br>
              使用ツール：Canon 5D<br>
              <a href="#" class="button button-ghost">READ MORE</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="skills">
    <h2 class="heading">SERVICE</h2>
    <div class="skills-wrapper">
      <div class="skill-box">
        <i class="skill-icon fa fa-lightbulb-o"></i>
        <div class="skill-title">TOOL</div>
        <p class="skill-text">
          写真を撮った際の構図を記録するアプリ<br>
          撮った写真と構図はその場でマイページへ<br>
          思い出の一枚をその技法ごと記録できます。
        </p>
      </div>
      <div class="skill-box">
        <i class="skill-icon fa fa-paint-brush"></i>
        <div class="skill-title">MATCHING</div>
        <p class="skill-text">
          カメラマンとモデルのマッチング<br>
          スキルや作品を軸に、仕事相手を探せます。<br>
          時間は1時間から気軽に予約可能です。
        </p>
      </div>
      <div class="skill-box">
        <i class="skill-icon fa fa-code"></i>
        <div class="skill-title">JOB SEARCH</div>
        <p class="skill-text">
          撮った写真を公開して、仕事をGET!<br>
          自分の写真を公開して仕事を探しましょう<br>
          空き時間に合わせて、仕事の依頼が入ります。
        </p>
      </div>
    </div>
  </section>
  <section class="contact" id="contact">
    <h2 class="heading">CONTACT</h2>
    <form class="contact-form">
      <input type="text" name="name" placeholder="NAME">
      <textarea name="message" placeholder="MESSAGE"></textarea>
      <input type="submit" value="SEND">
    </form>
  </section>
  <footer class="footer">
      © sample site
  </footer>
<div id="sign_up">
  <h3 class="log_in" >ログイン</h3>
  <!-- $_SERVER['PHP_SELF']はXSSの危険性があるので、actionは空にしておく -->
  <!--<form id="loginForm" name="loginForm" action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">-->
  <?php echo $row['user_pass'];?>
  <div><?php echo $errorMessage ?></div>
  <form id="loginForm" name="loginForm" action="http://localhost/photo_match/login.php" method="POST">
    <div class="form-item">
	  <label for="userid"></label>
	  <input type="text" class="user_id" name="userid" required="required" placeholder="User ID" value="<?php echo htmlspecialchars($_POST["userid"], ENT_QUOTES); ?>"></input>
	</div>
	<div class="form-item">
	  <label for="password"></label>
	  <input type="password" name="password" required="required" placeholder="Password" value=""></input>
	</div>
	<div class="button-panel">
      <input type="submit" id="login" class="login" title="ログイン" value="ログイン"></input>
    </div>
    <!--<a class="close" id="cancel" href="#">キャンセル</a> -->
  </form>
</div>
</body>
</html>
