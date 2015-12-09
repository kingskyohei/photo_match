<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>予約依頼入力確認</title>
  <link rel="stylesheet" href="../include/view/css/bootstrap.min.css">
  <link rel="stylesheet" href="../include/view/css/yoyaku_confirm.css">
</head>
<body>
  <div id="page">
    <div class="container">
      <h1>予約依頼入力確認</h1>
      
      <div class="row">
        <div class="col-sm-9">
          <form action="#" class="form-horizontal">
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">タイトル</label>
              <div class="col-sm-10"><p><?php echo $title ?></p>
              </div>
            </div>
            <div class="form-group">        
              <label for="input-content" class="col-sm-2 control-label">内容</label>
              <div class="col-sm-10"><p><?php echo $content ?></p>
              </div>
            </div>
            <div class="form-group">        
              <label for="input-place" class="col-sm-2 control-label">場所</label>
              <div class="col-sm-10"><p><?php echo $place ?></p>
              </div>
            </div>
            <div class="form-group">
              <label for="input-mail" class="col-sm-2 control-label">メールアドレス</label>
              <div class="col-sm-10"><p><?php echo $mail ?></p>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">年</label>
              <div class="col-sm-10"><p><?php echo $year ?></p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">月</label>
              <div class="col-sm-10"><p><?php echo $month ?></p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">日</label>
              <div class="col-sm-10"><p><?php echo $date ?></p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">開始時間</label>
              <div class="col-sm-10"><p><?php echo $start_time ?></p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">終了時間</label>
              <div class="col-sm-10"><p><?php echo $end_time ?></p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">所要時間</label>
              <div class="col-sm-10"><p><?php echo $hour ?></p>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <a href="./yoyaku_comp.php" class="btn btn-default">送る</a>
                <a href="./yoyaku.php" class="btn btn-default">戻る</a>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div><!-- /container -->
  </div><!-- /page -->
  <script src="../include/view/js/jquery-1.11.3.min.js"></script>
  <script src="../include/view/js/bootstrap.min.js"></script>
</body>
</html>