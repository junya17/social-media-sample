<?php
ob_start(); //出力のバッファリングを有効にする
session_start();

$timezone = date_default_timezone_set("Asia/Tokyo");
//mysqli_connect("host", "username", "password", "dbname")
$con = mysqli_connect("localhost", "root", "", "social"); //Connection variable

//mysqli_connect_errno: 直近の接続コールに関するエラーコードを返す
if(mysqli_connect_errno()){
  echo "Failed to connect: " .mysqli_connect_errno();
}

?>