<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>マイページ画面</title>

    <!-- Bootstrap Core CSS -->
    <link href="../include/view/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../include/view/css/shop-item.css" rel="stylesheet">

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
                <a class="navbar-brand" href="./index.php">MODEL SEARCH</a>
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
                        <a href=""><p>ようこそ<?php echo $user_name ?>さん</p></a>
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
                <p class="lead">メニュー</p>
                <div class="list-group">
                    <a href="#" class="list-group-item active">プロフィール</a>
                    <a href="#" class="list-group-item">予約確認</a>
                    <a href="../htdocs/upload.php" class="list-group-item">写真アップロード</a>
                    <a href="../htdocs/message.php" class="list-group-item">メッセージ</a>
                </div>
            </div>

            <div class="col-md-9">

                <?php foreach($yoyaku as $row){ ?>

                    <div class="thumbnail">
                        <div class="caption-full">
                            <h4><a href="#">通知内容</a>
                            </h4>
                            <p>予約番号：<?php echo $row['yoyaku_id']; ?></p>
                            <p>可否：<?php echo $row['syonin_flg']; ?></p>
                            <p>相手のページ：<a href="./profile.php?user_id=<?php echo $mt_user_id ?>"><?php echo $row['mt_user_id']; ?></a></p>
                       </div>
                    </div>
                <?php 
                }
                ?>
                
                <?php foreach($result_photo as $row){ ?>

                    <div class="thumbnail">
                        <div class="caption-full">
                            <h4><a href="#">写真一覧</a>
                            </h4>
                            <p>写真番号：<?php echo $row['photo_id']; ?></p>
                            <p>写真URL：<?php echo $row['photo_url']; ?></p>
                       </div>
                    </div>
                <?php 
                }
                ?>

<!--
                <div class="thumbnail">
                    <div class="caption-full">
                        <h4><a href="#">通知内容</a>
                        </h4>
                        <p>予約番号：<?php echo $yoyaku_id ?></p>
                        <p>可否：<?php echo $flg ?></p>
                        <p>相手のページ：<a href="./profile.php?user_id=<?php echo $mt_user_id ?>"><?php echo $mt_user_id ?></a></p>
                   </div>
                </div>
-->


                <div class="thumbnail">
                    <div class="caption-full">
                        <h4><a href="#">カメラマンのツール</a>
                        </h4>
                        <p>カメラメーカー：<?php echo $camera_syurui ?></p>
                        <p>カメラの個数：<?php echo $camera_syurui_suryo ?></p>
                        <p>レンズメーカー：<?php echo $lens_syurui ?></a></p>
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
    <script src="../include/view/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../include/view/js/bootstrap.min.js"></script>

</body>

</html>
