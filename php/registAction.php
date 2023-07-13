<?php
    require_once __DIR__ . "/DBconnect.php";
    require_once __DIR__ . "/TBL_User.php";

    $username = $_POST['username'];
    $password = $_POST['password'];
    $mail = $_POST['mail'];
    if (session_status() == PHP_SESSION_NONE) {
        // セッションは有効で、開始していないとき
        session_start();
    }

    if(!$mail = filter_input(INPUT_POST, 'email')){
        $_SESSION['err_mail'] = 'メールの形式が間違っています。';
        header('Location: /Cominucatio/php/login.php', true, 307);
        exit;
    }

    // パスワードの正規表現チェック
    if(!preg_match('/\A[a-z\d]{6,16}+\z/i', $password)){
        // パスワードエラーでのリダイレクト処理
        $_SESSION['err_pasword'] = 'パスワードは６文字から１６文字以下の形式です。';
        header('Location: /Cominucatio/php/login.php', true, 307);
        exit;
    }

    // DBに接続処理を読み込み
    $pdo = DBconnect::connect_db();
    // userテーブルをidで検索
    $info = TBL_User::InsertUser($pdo, $username, $mail, $password);
    // 登録後、セッションにユーザー情報を保存
    if($info['result']){
        $user = TBL_User::selectUserByNamePassWord($pdo, $username, $password);
        $_SESSION['login_user'] = serialize($user);
        $_SESSION['message'] = $info['message'];
        session_write_close();
        header('Location: /Cominucatio/php/profile.php', true, 307);
        exit;
    }else{
        $_SESSION['message'] = $info['message'];
        session_write_close();
        header("Location: /Cominucatio/php/login.php"."?message=".$_SESSION['message'], true, 307);
        exit;
    }

?>