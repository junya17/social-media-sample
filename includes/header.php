<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");


//セッションにusernameがある場合にログインする。それ以外はログインページにリダイレクト
if(isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    //ログインユーザーを取得後、配列にする。：データベースから値を取得して表示することができる。
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn' ");
    $user = mysqli_fetch_array($user_details_query);
    
}else{
    header("Location: register.php");
}

?>

<html>
<head>
    <title>Welcome to Swirlfeed</title>

    <!--Javascript-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/demo.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
    <script src="assets/js/jquery.Jcrop.js"></script>
    <script src="assets/js/jcrop_bits.js"></script>

    

    <!--CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
    
</head>
<body>
    
    <div class="top_bar">
       
        <div class="logo">
            <a href="index.php">Swirlfeed!</a>
        </div>
        
        <nav>
            <a href="<?php echo $user['first_name'] ?>">
                <?php echo $user['first_name']; ?><!-- database username -->
            </a>
            <a href="index.php">
                <i class="fa fa-home fa-lg"></i>
            </a>
            <a href="index.php">
                <i class="fa fa-envelope fa-lg"></i>
            </a>
            <a href="index.php">
                <i class="fa fa-bell-o fa-lg"></i>
            </a>
            <a href="requests.php">
                <i class="fa fa-users fa-lg"></i>
            </a>
            <a href="index.php">
                <i class="fa fa-cog fa-lg"></i>
            </a>
            <a href="includes/handlers/logout.php">
                <i class="fa fa-sign-out-alt fa-lg"></i>
            </a>
        </nav>
    </div>
    
<div class="wrapper">
        
   

