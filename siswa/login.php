<?php
include("connect_sisfo_akademik.php");
$username=$_POST["username"];
$pass=$_POST["pass"];
$strquery = "select * from t_siswa where nis='$username' && password='$pass'";
$query = mysql_query($strquery);
$jum	= mysql_num_rows($query);
if($jum!=0){
    session_start();
	$_SESSION['user']=$username;
	$_SESSION['pass']=$pass;
	header("location:home.php");
}
else{
	header("location:index.php");
}
mysql_close($conn);
?>