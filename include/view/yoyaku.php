<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>予約依頼</title>
  <link rel="stylesheet" href="../include/view/css/bootstrap.min.css">
</head>
<body>
  <div id="page">
    <div class="container">
      <h1>予約依頼フォーム</h1>
      <div class="row">
        <div class="col-sm-9">
          <form action="./yoyaku_confirm.php" class="form-horizontal" method="post">
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
              <label for="input-place" class="col-sm-2 control-label">場所</label>
              <div class="col-sm-10">
                <input type="text" name="place" class="form-control" id="input-place" placeholder="場所" required="required">
              </div>
            </div>
            <div class="form-group">
              <label for="input-mail" class="col-sm-2 control-label">メールアドレス</label>
              <div class="col-sm-10">
                <input type="email" name="mail" class="form-control" id="input-mail" placeholder="メールアドレス" required="required">
              </div>
            </div>
            <div class="form-group">
              <label for="input-year" class="col-sm-2 control-label">年</label>
              <div class="col-sm-10">
                <input type="text" name="year" class="form-control" id="input-year" placeholder="年" value="<?php echo $year ?>" required="required">
              </div>
            </div>
            <div class="form-group">
              <label for="input-month" class="col-sm-2 control-label">月</label>
              <div class="col-sm-10">
                <input type="text" name="month" class="form-control" id="input-month" placeholder="月" value="<?php echo $month ?>" required="required">
              </div>
            </div>
            <div class="form-group">
              <label for="input-date" class="col-sm-2 control-label">日</label>
              <div class="col-sm-10">
                <input type="text" name="date" class="form-control" id="input-date" placeholder="日" value="<?php echo $date ?>" required="required">
              </div>
            </div>
            <div class="form-group">
              <label for="input-start_time" class="col-sm-2 control-label">開始時間</label>
              <div class="col-sm-10">
                <input type="text" name="start_time" class="form-control" id="input-start_time" placeholder="開始時間" value="<?php echo $start_time ?>" required="required">
              </div>
            </div>
            <div class="form-group">
              <label for="input-end_time" class="col-sm-2 control-label">終了時間</label>
              <div class="col-sm-10"> 
                <input type="text" name="end_time" class="form-control" id="input-end_time" placeholder="終了時間" value="<?php echo $end_time ?>" required="required">
              </div>
            </div>
            <div class="form-group">
              <label for="input-hour" class="col-sm-2 control-label">所要時間</label>
              <div class="col-sm-10">
                <input type="text" name="hour" class="form-control" id="input-hour" placeholder="所要時間" value="<?php echo $hour ?>" required="required">
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

    </div><!-- /container -->
  </div><!-- /page -->
  <script src="../include/view/js/jquery-1.11.3.min.js"></script>
  <script src="../include/view/js/bootstrap.min.js"></script>
</body>
</html>