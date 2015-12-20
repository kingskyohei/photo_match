<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>写真アップロード画面</title>

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
      <form enctype="multipart/form-data" method= "post" action = "../htdocs/upload.php">
        <fieldset>
          <legend>画像ファイルを選択(GIF, JPEG, PNGのみ対応)</legend>
          <input type="file" name="upfile" /><br />
          <input type="submit" value="送信" />
        </fieldset>
      </form>
    <?php if (!empty($msgs)): ?>
      <fieldset>
        <legend>メッセージ</legend>
    <?php foreach ($msgs as $msg): ?>
        <ul>
            <li style="color:<?=h($msg[0])?>;"><?=h($msg[1])?></li>
        </ul>
    <?php endforeach; ?>
      </fieldset>
    <?php endif; ?>
    <?php if (!empty($rows)): ?>
       <fieldset>
         <legend>サムネイル一覧(クリックすると原寸大表示)</legend>
    <?php foreach ($rows as $i => $row): ?>
    <?php if ($i): ?>
         <hr />
    <?php endif; ?>
         <p>
           <?=sprintf(
               '<a href="?id=%d"><img src="data:%s;base64,%s" alt="%s" /></a>',
               $row['id'],
               image_type_to_mime_type($row['type']),
               base64_encode($row['thumb_data']),
               h($row['name'])
           )?><br />
           ファイル名: <?=h($row['name'])?><br />
           日付: <?=h($row['date'])?><br clear="all" />
        </p>
    <?php endforeach; ?>
       </fieldset>
    <?php endif; ?>

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
