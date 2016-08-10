<?php
session_start();
include("../configure/database.php");

$nis =$_REQUEST["nis"];
$ipa = $_REQUEST["ipa"];
$ips = $_REQUEST["ips"];
$strquery = "INSERT INTO t_hasil_psikotes_bid_jurusan (nis,ipa,ips) VALUES ('$nis','$ipa','$ips')";
//die(var_dump($strquery));
if (mysql_query($strquery)){
    header("location:home.php");
    $_SESSION['error'] = false;
    $_SESSION['message'] = 'Data telah tersimpan';
} else{
    $_SESSION['error'] = true;
    $_SESSION['message'] = 'Data gagal disimpan';
    header("location:nilai.php");
}
mysql_close($conn);
?>