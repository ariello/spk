<?php
include("../configure/database.php");

$username=$_REQUEST["username"];
$pass= sha1($_REQUEST["password"].'sjd878makj10mksla09');
$strquery = "SELECT * FROM user WHERE username='$username' AND password='$pass'";
$query = mysql_query($strquery);
$jum = mysql_num_rows($query);
if($jum!=0){
    session_start();
    $_SESSION['user']=$username;
    $_SESSION['pass']=$pass;
    header("location:home.php");
} else{
    header("location:index.php");
}
mysql_close($conn);
?>