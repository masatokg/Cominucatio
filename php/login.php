<?php
    require_once __DIR__ . "/DBConnect.php";
    require_once __DIR__ . "/TBL_User.php";
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
      $message = $_SESSION['message'];
      $_SESSION['message'] = null;
      $err_pasword = $_SESSION['err_pasword'];
      $_SESSION['err_pasword'] = null;
      $err_mail = $_SESSION['err_mail'];
      $_SESSION['err_mail'] = null;
    }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<!-- <link rel="stylesheet" href="./css/myStyle.css" type="text/css"> -->
<style>
.container {
    margin-top: 5%;
}
</style>

</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2>ユーザーログイン</h2>
        <form action="/Cominucatio/php/loginAction.php" method="post">
          <div class="form-group">
            <label for="username">Username:<?=$username?></label>
            <input type="text" class="form-control" id="username" name="username" placeholder="ユーザー名を入力">
          </div>
          <div class="form-group">
            <label for="password">Password:<?=$password?></label>
            <input type="password" class="form-control" id="password" name="password" placeholder="パスワードを入力">
          </div>
          <button id="btn_login" type="submit" class="btn btn-primary">ログイン</button>
        </form>
        <br>
        <h2>新規登録</h2>
        <form action="/Cominucatio/php/registAction.php" method="post">
          <div class="form-group">
            <label for="username">Username:<?=$message?></label>
            <input type="text" class="form-control" id="username" name="username" placeholder="ユーザー名を入力">
          </div>
          <div class="form-group">
            <label for="mail">Mail:<?=$err_mail?></label>
            <input type="text" class="form-control" id="mail" name="mail" placeholder="メールアドレスを入力">
          </div>
          <div class="form-group">
            <label for="password">Password:<?=$err_pasword?></label>
            <input type="password" class="form-control" id="password" name="password" placeholder="パスワードを入力">
          </div>
          <button id="btn_regist" type="submit" class="btn btn-primary">登録</button>
        </form>
      </div>
    </div>
  </div>


    <script type="text/javascript" src="./js/login.js"></script>
</body>
</html>