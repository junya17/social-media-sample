<?php
require 'config/config.php';

//エラーを防ぐための変数の宣言
$fname = ""; //First name
$lname = ""; //Last name
$em = ""; //email
$em2 = ""; //email2
$password = ""; //password
$password2 = ""; //password2
$date = ""; //Sign up date
$error_array = array(); //Holds error messages

if(isset($_POST['register_button'])){
    
    //登録フォームの値
    
    //First name
    $fname = strip_tags($_POST['reg_fname']); //htmlタグの消去
    $fname = str_replace(' ', '', $fname); //スペースの消去
    $fname = ucfirst(strtolower($fname)); //はじめの１文字だけ大文字に変換する。
    $_SESSION['reg_fname'] = $fname; //セッションに追加する
    
    //Last name
    $lname = strip_tags($_POST['reg_lname']); //htmlタグの消去
    $lname = str_replace(' ', '', $lname); //スペースの消去
    $lname = ucfirst(strtolower($lname)); //はじめの１文字だけ大文字に変換する。
    $_SESSION['reg_lname'] = $lname; //セッションに追加する

    //email
    $em = strip_tags($_POST['reg_email']); //htmlタグの消去
    $em = str_replace(' ', '', $em); //スペースの消去
    $em = ucfirst(strtolower($em)); //はじめの１文字だけ大文字に変換する。
    $_SESSION['reg_email'] = $em; //セッションに追加する

    //email2
    $em2 = strip_tags($_POST['reg_email2']); //htmlタグの消去
    $em2 = str_replace(' ', '', $em2); //スペースの消去
    $em2 = ucfirst(strtolower($em2)); //はじめの１文字だけ大文字に変換する。
    $_SESSION['reg_em2'] = $em2; //セッションに追加する
    
    //Password
    $password = strip_tags($_POST['reg_password']); //htmlタグの消去
    $password2 = strip_tags($_POST['reg_password2']); //htmlタグの消去

    $date = date("Y-m-d"); //現在の日付け
    
    if($em == $em2) {
        //Emailが有効な形式がチェックする
        if(filter_var($em, FILTER_VALIDATE_EMAIL)){
            
            $em = filter_var($em, FILTER_VALIDATE_EMAIL);
            
            //Emailがすでに使われていないか
            $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");
            
            //返される行の数を数える。
            $num_rows = mysqli_num_rows($e_check);
            
            if($num_rows > 0) {
               array_push($error_array, "Emailはすでに使われています。<br>");
            }
            
        }else {
            array_push($error_array, "入力形式が違います。<br>");
        }
    }else {
        array_push($error_array, "Emailが一致しません。<br>");
    }
    
    
    if(strlen($fname) > 25 || strlen($fname) < 2) {
        array_push($error_array, "ファーストネームは２文字以上、２５文字以内です。<br>");
    }
    
    if(strlen($lname) > 25 || strlen($lname) < 2) {
        array_push($error_array, "ラストネームは２文字以上、２５文字以内です。<br>");
    }
    
    if($password != $password2) {
        array_push($error_array, "パスワードが一致しません。<br>");
    }else{
        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($error_array, "パスワードには英数字のみ利用可能です。<br>");
        }
    }
    
    if(strlen($password > 30 || strlen($password) < 5)) {
        array_push($error_array, "パスワードは５文字以上、３０文字以内です。<br>");
    }
    
    if(empty($error_array)) {
        $password = md5($password);//パスワードをデータベースに送信する前に暗号化する。
        $username = strtolower($fname . "_" . $lname);//名前を小文字にする
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        
        //データベースでusernameと同じ名前が見つかったらusernameに数字をプラスする：Tanaka_Tarou_1;
        $i = 0;
        while(mysqli_num_rows($check_username_query) != 0) {
            $i++;
            $username = $username . "_" . $i;
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        }
        
        $rand = rand(1,2); //1から2までの数字をランダムに返す。
        if($rand == 1)
            $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
        else if($rand == 2)
            $profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
        
        $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");
        
        array_push($error_array, "登録に成功しました！");
        
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
        
    }
       

}

?>

