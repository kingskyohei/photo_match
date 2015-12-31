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
      <h1>新規会員登録フォーム</h1>
      <div class="row">
        <div class="col-sm-9">
          <form action="./register_confirm.php" class="form-horizontal" method="post">
            <div class="form-group">
              <label for="input-name" class="col-sm-2 control-label">お名前</label>
              <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="input-name" placeholder="お名前" required="required" value="">
              </div>
            </div>
            <div class="form-group">        
              <label for="input-name" class="col-sm-2 control-label">フリガナ</label>
              <div class="col-sm-10">
                <input type="text" name="furigana" class="form-control" id="furigana" placeholder="フリガナ" required="required">
              </div>
            </div>
            <div class="form-group">   
            <label for="input-name" class="col-sm-2 control-label">性別</label>
              <div class="col-sm-10">
                <input type="text" name="gender" class="form-control" id="gender" placeholder="性別" required="required" value="<?php echo $gender ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="input-mail" class="col-sm-2 control-label">メールアドレス</label>
              <div class="col-sm-10">
                <input type="email" name="mail" class="form-control"  id="input-mail" placeholder="メールアドレス" required="required" value="<?php echo $email ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="input-mail" class="col-sm-2 control-label">ユーザー区分</label>
              <div class="col-sm-10">
                <input type="text" name="user_kbn" class="form-control" id="user_kbn" placeholder="ユーザー区分" required="required" value="">
              </div>
            </div>
            <div class="form-group">
              <label for="input-mail" class="col-sm-2 control-label">ユーザーネーム</label>
              <div class="col-sm-10">
                <input type="text" name="user_name" class="form-control" id="user_name" placeholder="ユーザーネーム" required="required" value="<?php echo $user_name ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="input-mail" class="col-sm-2 control-label">パスワード</label>
              <div class="col-sm-10">
                <input type="text" name="password" class="form-control" id="password" placeholder="パスワード" required="required">
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