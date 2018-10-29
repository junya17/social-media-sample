<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<html>
<head>
    <title>Welcome to Swirlfeed!</title>
    <!--    css,jqueryの読み込み-->
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>
    
<!--    ボタンを押した後に画面が変わるのを防ぐ-->
    <?php
    
    if(isset($_POST['register_button'])){
        echo '
        <script>
        
        $(document).ready(function() {
            $("#first").hide();
            $("#second").show();
        });
        
        </script>
        
        ';
    }
    
    ?>
    
    <div class="wrapper">
        
        <div class="login_box">
            
        <div class="login_header">
            <h1>Swirlfeed!</h1>
            Login or sign up below!
        </div>
<!--    //ログインフォーム-->
        <div id="first">
            <form action="register.php" method="POST">
                <input type="email" name="log_email" placeholder="Email Adress" value=" <?php 
                if(isset($_SESSION['log_email'])) {
                    echo $_SESSION['log_email'];
                }                      
                ?>" required>
                <br>
                <input type="password" name="log_password" placeholder="Password">
                <br>
                <?php if(in_array("Eメールまたはパスワードが違います。<br>", $error_array)) echo "Eメールまたはパスワードが違います。<br>"; ?>
                <input type="submit" name="login_button" placeholder="Login">
                <br>
                <a href="#" id="signup" class="signup">アカウントの登録はこちら</a>
            </form>
        </div>
            
        <div id="second">
        <!--    登録フォーム-->
            <form action="register.php" method="POST">
                <input type="text" name="reg_fname" placeholder="First Name" value="<?php 
                if(isset($_SESSION['reg_fname'])) {
                    echo $_SESSION['reg_fname'];
                }                      
                ?>"  required>                                                            
                <br>
                <?php if(in_array("ファーストネームは２文字以上、２５文字以内です。<br>", $error_array)) echo "ファーストネームは２文字以上、２５文字以内です。<br>";?>

                <input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
                if(isset($_SESSION['reg_lname'])) {
                    echo $_SESSION['reg_lname'];
                }                      
                ?>"  required>                                            
                <br>
                 <?php if(in_array("ラストネームは２文字以上、２５文字以内です。<br>", $error_array)) echo "ラストネームは２文字以上、２５文字以内です。<br>";?>

                <input type="email" name="reg_email" placeholder="Email" value="<?php 
                if(isset($_SESSION['reg_email'])) {
                    echo $_SESSION['reg_email'];
                }                      
                ?>" required>
                <br>
                <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
                if(isset($_SESSION['reg_email2'])) {
                    echo $_SESSION['reg_email2'];
                }                      
                ?>" required>
                <br>
                <?php if(in_array("Emailはすでに使われています。<br>", $error_array)) echo "Emailはすでに使われています。<br>";
                else if(in_array("入力形式が違います。<br>", $error_array)) echo "入力形式が違います。<br>";
                else if(in_array("Emailが一致しません。<br>", $error_array)) echo "Emailが一致しません。<br>";?>
                <input type="password" name="reg_password" placeholder="Password" required>
                <br>
                <input type="password" name="reg_password2" placeholder="Confirm Password" required>
                <br>
                <?php if(in_array("パスワードが一致しません。<br>", $error_array)) echo "パスワードが一致しません。<br>";
                else if(in_array("パスワードには英数字のみ利用可能です。<br>", $error_array)) echo "パスワードには英数字のみ利用可能です。<br>";
                else if(in_array("パスワードは５文字以上、３０文字以内です。<br>", $error_array)) echo "パスワードは５文字以上、３０文字以内です。<br>";?>
                <input type="submit" name="register_button" value="Register">
                <br>
                <?php if(in_array("登録に成功しました！", $error_array)) echo "登録に成功しました！";?>
                <a href="#" id="signin" class="signin">ログインはこちら</a>
            </form>
        </div>
    </div>
</body>
</html>


<!--required: 入力必須を指定する。-->
