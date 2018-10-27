<?php

if(isset($_POST['login_button'])) { //変数がセットされていること、そして NULL でないことを検査する
    
    $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //log_emailをフィルタリング
    
    $_SESSION['log_email'] = $email; //セッションに追加
    $password = md5($_POST['log_password']); //パスワードを暗号化
    $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    $check_login_query = mysqli_num_rows($check_database_query); //データベースの行の数を取得
    
    if($check_login_query == 1) { //対象のデータがひとつ場合
        $row = mysqli_fetch_array($check_database_query);  //結果の行を取得する
        $username = $row['username'];
        
        // 再ログイン
        $user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND user_closed='yes' ");
        if(mysqli_num_rows($user_closed_query) ==1) {
            $reopen_account = mysqli_query($con, "UPDATE users SET user_closed = 'no' WHERE email = '$email' ");
        }
        
        //セッションに追加する //index.phpにリダイレクトする。
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        array_push($error_array, "Eメールまたはパスワードが違います。<br>");
    }
}

?>