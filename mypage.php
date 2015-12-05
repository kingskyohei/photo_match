
<?php
session_start();

$db['host'] = "localhost";  // DBサーバのurl
$db['user'] = "root";
$db['pass'] = "kings531";
$db['dbname'] = "photo_match";

//ログインユーザー
$userid = $_SESSION["userid"];


//　閲覧ユーザーのid
//$mt_user_id = $_GET["user_id"];

// ログイン状態のチェック
if (!isset($_SESSION["userid"])) {
  header("Location: logout.php");
  exit;
}


// エラーメッセージの初期化
$errorMessage = "";


// mysqlへの接続
$mysqli = new mysqli($db['host'], $db['user'], $db['pass']);
if ($mysqli->connect_errno) {
  print('<p>データベースへの接続に失敗しました。</p>' . $mysqli->connect_error);
  exit();
}

// データベースの選択
$mysqli->select_db($db['dbname']);

// userテーブルへクエリの実行
$query = "SELECT * FROM pm_user WHERE user_id = $userid ";
//$query = "SELECT * FROM biyo_news where news_id = 1";


$result = $mysqli->query($query);

if (!$result) {
  print('クエリーが失敗しました。' . $mysqli->error);
  $mysqli->close();
  exit();
}

while ($row = $result->fetch_assoc()) {
  // パスワード(暗号化済み）の取り出し 
  $user_name = $row['user_name'];
}

// 予約テーブルへクエリの実行
$yoyaku_query = "SELECT * FROM yoyaku_table WHERE mt_user_id = '" . $userid . "'";
//$query = "SELECT * FROM biyo_news where news_id = 1";

$yoyaku_result = $mysqli->query($yoyaku_query);

if (!$yoyaku_result) {
  print('クエリーが失敗しました。' . $mysqli->error);
  $mysqli->close();
  exit();
}

while ($yoyaku_row = $yoyaku_result->fetch_assoc()) {
  // パスワード(暗号化済み）の取り出し 
  $yoyaku_id = $yoyaku_row['yoyaku_id'];
  $flg = $yoyaku_row['syonin_flg'];
  $mt_user_id = $yoyaku_row['user_id'];
}

//　閲覧ユーザーのid
//$mt_user_id = $_GET["user_id"];

$_SESSION["userid"] = $userid;
$_SESSION["mt_user_id"] = $mt_user_id;

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Item - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-item.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./index.html">MODEL SEARCH</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <li>
                        <a href="logout.php">ログアウト</a>
                    </li>
                    <li>
                        <a href=""><p>ようこそ<?=htmlspecialchars($user_name, ENT_QUOTES); ?>さん</p></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">予約通知</p>
                <div class="list-group">
                    <a href="#" class="list-group-item active">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
                </div>
            </div>

            <div class="col-md-9">

                <div class="thumbnail">
                    <div class="caption-full">
                        <h4><a href="#">通知内容</a>
                        </h4>
                        <p>予約番号：<?php echo $yoyaku_id ?></p>
                        <p>可否：<?php echo $flg ?></p>
                        <p>相手のページ：<a href="./main.php"><?php echo $mt_user_id ?></a></p>
                   </div>
                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
