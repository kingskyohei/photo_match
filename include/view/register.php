<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="../include/view/css/bootstrap.min.css">
</head>
<body>
  <div id="page">
    <div class="container">
      <h1>予約依頼フォーム</h1>
      <div class="row">
        <div class="col-sm-9">
          <form action="./register_confirm.php" class="form-horizontal" method="post">
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">お名前</label>
              <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="input-name" placeholder="お名前" required="required">
              </div>
            </div>
            <div class="form-group">        
              <label for="input-name" class="col-sm-2 control-label">依頼先</label>
              <div class="col-sm-10">
                <input type="text" name="jyutaku_name" class="form-control" id="jyuaku-name" placeholder="モデル" required="required">
              </div>
            </div>
            <div class="form-group">
              <label for="input-mail" class="col-sm-2 control-label">メールアドレス</label>
              <div class="col-sm-10">
                <input type="email" name="mail" class="form-control" id="input-mail" placeholder="メールアドレス" required="required">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">ご用件</label>
              <div class="col-sm-10">
                <select name="request" class="form-control">
                  <option value="">選択してください</option>
                  <option value="ご質問・お問い合わせ">ご質問・お問い合わせ</option>
                  <option value="ご意見・ご感想">ご意見・ご感想</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">日程</label>
              <div class="col-sm-10">
                <input type="text" name="date" class="form-control" id="input-name" placeholder="10月14日" required="required">
              </div>
            </div>  
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">開始時間</label>
              <div class="col-sm-10">
                <input type="text" name="start_time" class="form-control" id="input-name" placeholder="10:00" required="required">
              </div>
            </div>  
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">終了時間</label>
              <div class="col-sm-10">
                <input type="text" name="end_time" class="form-control" id="input-name" placeholder="12:00" required="required">
              </div>
            </div>
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">場所</label>
              <div class="col-sm-10">
                <input type="text" name="place" class="form-control" id="input-name" placeholder="新宿" required="required">
              </div>
            </div>      
            <div class="form-group">
              <label class="col-sm-2 control-label">コメント</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="comment" rows="5" required="required"></textarea>
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
  <script src="./js/jquery-1.11.3.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
</body>
</html>