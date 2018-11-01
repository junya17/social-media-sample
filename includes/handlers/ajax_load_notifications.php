<?php  
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Notification.php");

$limit = 10; //Number of posts to be loaded per call

$norification= new Notification($con, $_REQUEST['userLoggedIn']);
echo $notification->getNotifications($_REQUEST, $limit);
?>