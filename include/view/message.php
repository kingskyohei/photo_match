<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>メッセージ</title>

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
     <h1>メッセージフォーム</h1>
          <div class="row">
            <div class="col-sm-9">
              <form action="./message.php" class="form-horizontal" method="post">
                <div class="form-group">
                  <label for="input-title" class="col-sm-2 control-label">送信相手</label>
                  <div class="col-sm-10">
                    <input type="text" name="mt_user_id" class="form-control" id="input-title" placeholder="送信相手" required="required">
                  </div>
                </div>
                <div class="form-group">
                  <label for="input-title" class="col-sm-2 control-label">タイトル</label>
                  <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" id="input-title" placeholder="タイトル" required="required">
                  </div>
                </div>
                <div class="form-group">        
                  <label for="input-content" class="col-sm-2 control-label">内容</label>
                  <div class="col-sm-10">
                    <input type="text" name="content" class="form-control" id="jyuaku-content" placeholder="内容" required="required">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" value="送信">
                  </div>
                </div>
              </form>
            </div>
          </div>
    <!-- /.container -->
    </div>

    <div class="container">
     <h1>メッセージフォーム</h1>
        <?php foreach($result as $row){ ?>

            <div class="thumbnail">
                <div class="caption-full">
                    <h4><a href="#">通知内容</a>
                    </h4>
                    <p>相手ID：<?php echo $row['mt_user_id']; ?></p>
                    <p>可否：<?php echo $row['title']; ?></p>
                    <p>相手のページ：<?php echo $row['message']; ?></a></p>
               </div>
            </div>
        <?php 
        }
        ?>

    </div>
    <!-- jQuery -->
    <script src="../include/view/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../include/view/js/bootstrap.min.js"></script>

</body>

</html>
