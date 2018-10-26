<?php
//mysqli_connect("host", "username", "password", "dbname")
$con = mysqli_connect("localhost", "root", "", "social"); //Connection variable

//mysqli_connect_errno: 直近の接続コールに関するエラーコードを返す
if(mysqli_connect_errno()){
  echo "Failed to connect: " .mysqli_connect_errno();
}
//mysqli_query: データベース上でクエリを実行する
//dbにデータを保管する。
$query = mysqli_query($con, "INSERT INTO test VALUES ('2', 'Optimus Prime')");

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to Swirlfeed</title>
  </head>
  <body>
    Hello Reece!!!!!!!
  </body>
</html>
