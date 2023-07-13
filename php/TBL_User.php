<?php
require_once __DIR__ . "/User.php";
class TBL_User{
    public static function InsertUser($pdo, $name, $mail, $pass_word){
        // return配列
        $info = array();
        // userテーブルをnameで検索
        $user = TBL_User::selectUserByName($pdo, $name);
        if($user!=null){
            // レコードが存在する場合
            $info['result'] = false;
            $info['message'] = 'ユーザー名が重複しています。ユーザー名：'.$user->name;
            return $info;
        }
        //実行したいSQLを準備する
        $sql = 'INSERT INTO user (name, pass_word) values (:name, :mail, :pass_word)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':mail', $mail);
        $stmt->bindValue(':pass_word', $pass_word);
        //SQLを実行
        $rt = $stmt->execute();
        if($rt){
            $info['result'] = true;
            $info['message'] = 'ユーザー登録に成功しました。';
            return $info;
        }
        $info['result'] = false;
        $info['message'] = 'ユーザー登録に失敗しました。'.  $name . "&" .$pass_word. "の結果";
        return $info;
    }
    public static function selectUserByID($pdo, $id){
        //実行したいSQLを準備する
        $sql = 'SELECT * FROM user where id=?';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        //SQLを実行
        $stmt->execute();
        //データベースの値を取得
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // $result = $stmt->fetchall();
        if($result){
            return null;
        }
        $user = new User();
        $user->id = $result['id'];
        $user->name = $result['name'];
        $user->email = $result['email'];
        $user->icon_img = $result['icon_img'];
        return $user;
    }
    public static function selectUserByNamePassWord($pdo, $name, $pass_word){
        //実行したいSQLを準備する
        $sql = 'SELECT * FROM user where name=:name AND pass_word=:pass_word';  
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':pass_word', $pass_word);
        //SQLを実行
        $stmt->execute();
        //データベースの値を取得
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$result){
            // レコードが存在しない場合、nullを返す
            return null;
        }
        $user = new User();
        $user->id = $result['id'];
        $user->name = $result['name'];
        $user->email = $result['email'];
        $user->icon_img = $result['icon_img'];
        return $user;
    }
    public static function selectUserByName($pdo, $name){
        //実行したいSQLを準備する
        $sql = 'SELECT * FROM user where name=:name';  
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        //SQLを実行
        $stmt->execute();
        //データベースの値を取得
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$result){
            // レコードが存在しない場合、nullを返す
            return null;
        }
        $user = new User();
        $user->id = $result['id'];
        // $user->name = $result['name'];
        $user->name = $result['name'];
        $user->email = $result['email'];
        $user->icon_img = $result['icon_img'];
        return $user;
    }
    public static function selectUsers($pdo){
        //実行したいSQLを準備する
        $sql = 'SELECT * FROM user';
        $stmt = $pdo->prepare($sql);
        //SQLを実行
        $stmt->execute();
        //データベースの値を取得
        $results = $stmt->fetchall();
        $users = array();
        foreach($results as $result){
            $user = new User();
            $user->id = $result['id'];
            $user->name = $result['name'];
            $user->email = $result['email'];
            $user->icon_img = $result['icon_img'];
            $users[] = $user; // リストに追加
        }
        return $users;
    }
}
?>