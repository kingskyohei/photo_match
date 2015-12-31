<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>新規会員登録確認画面</title>
  <link rel="stylesheet" href="../include/view/css/bootstrap.min.css">
  <link rel="stylesheet" href="../include/view/css/yoyaku_confirm.css">
</head>
<body>
  <div id="page">
    <div class="container">
      <h1>新規会員登録確認画面</h1>
      
      <div class="row">
        <div class="col-sm-9">
          <form action="#" class="form-horizontal">
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">お名前</label>
              <div class="col-sm-10"><p><?php echo $name ?></p>
              </div>
            </div>
            <div class="form-group">        
              <label for="input-name" class="col-sm-2 control-label">フリガナ</label>
              <div class="col-sm-10"><p><?php echo $furigana ?></p>
              </div>
            </div>
            <div class="form-group">        
              <label for="input-name" class="col-sm-2 control-label">性別</label>
              <div class="col-sm-10"><p><?php echo $gender ?></p>
              </div>
            </div>
            <div class="form-group">
              <label for="input-mail" class="col-sm-2 control-label">メールアドレス</label>
              <div class="col-sm-10"><p><?php echo $mail ?></p>
            </div>
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">ユーザー区分</label>
              <div class="col-sm-10"><p><?php echo $user_kbn ?></p>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">ユーザーネーム</label>
              <div class="col-sm-10"><p><?php echo $user_name ?></p>
              </div>
            </div>
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">パスワード</label>
              <div class="col-sm-10"><p><?php echo $password ?></p>
              </div>
            </div>  
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <a href="./register_comp.php" class="btn btn-default">送る</a>
                <a href="./register.php" class="btn btn-default">戻る</a>
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