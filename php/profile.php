<?php
  require_once __DIR__ . "/DBconnect.php";

  $dbc=new DBConnect();
  session_start();
  $message = $_SESSION['message'];
  $login_user = $_SESSION['login_user'];
   // シリアライズテキストをオブジェクトの形に戻す 
   $login_user = unserialize($login_user);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>プロフィール</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="css/profile.css"> -->
</head>
<body>
  <div class="container">
    <label for="username">ようこそ:<?= $login_user->name ?>さん</label>
    <a class="back-button" href="#"><span></span></a>
    <div>
      <img class="profile-image rounded-circle" src="icon.png" alt="プロフィール画像">
      <div>
        <span class="edit-button" onclick="editImage()">画像を変更</span>
        <input type="file" id="image-input" class="edit-input">
      </div>
    </div>
    <div class="profile-info">
      <div class="name-container">
        <h2 id="name" name="username"><?php echo $_POST['username']?></h2>
        <span class="edit-button edit-name-button" onclick="editName()"><img src="pen.png"></span>
      </div>
      <div>
        <input type="text" id="name-input" class="edit-input">
      </div>
    </div>
  </div>
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>

    function editImage() {
      var imageInput = document.getElementById('image-input');
      imageInput.click();
    }
    function editName() {
      var nameElement = document.getElementById('name');
      var nameInput = document.getElementById('name-input');

      if (nameElement.style.display === 'none') {
        // 名前の編集モードを終了
        nameElement.style.display = 'block';
        nameInput.style.display = 'none';
        nameElement.textContent = nameInput.value;
      } else {
        // 名前の編集モードを開始
        nameElement.style.display = 'none';
        nameInput.style.display = 'block';
        nameInput.value = nameElement.textContent.trim();
        nameInput.focus();
      }
    }
  </script>
</body>
</html>