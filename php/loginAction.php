<?php
    require_once __DIR__ . "/DBconnect.php";
    require_once __DIR__ . "/TBL_User.php";

    $username = $_POST['username'];
    $password = $_POST['password'];
    // DBに接続処理を読み込み
    $pdo = DBconnect::connect_db();
    // userテーブルをidで検索
    $user = TBL_User::selectUserByNamePassWord($pdo, $username, $password);
    // セッションにユーザー情報を保存
    if (session_status() == PHP_SESSION_NONE) {
        // セッションは有効で、開始していないとき
        session_start();
    }
    
    // ユーザーチェック
    if($user!=null){
        // オブジェクトの変数はシリアライズテキストの形でセッション（及びCoockie）に保存する 
        $_SESSION['login_user'] = serialize($user);
        header('Location: /Cominucatio/php/profile.php', true, 307);
    }else{
        header('Location: /Cominucatio/php/login.php', true, 307);
    }

?>