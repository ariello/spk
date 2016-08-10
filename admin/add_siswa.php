<?php
session_start();
include("../configure/database.php");

$nama =$_REQUEST["nama"];
$nomor_tes= $_REQUEST["nomor_tes"];
$pass = $_REQUEST["password_siswa"];
$strquery = "INSERT INTO t_siswa (nis,nama,password) VALUES ('$nomor_tes','$nama','$pass')";
//die(var_dump($strquery));
if (mysql_query($strquery)){
    header("location:home.php");
    $_SESSION['error'] = false;
    $_SESSION['message'] = 'Data telah tersimpan';
} else{
    $_SESSION['error'] = true;
    $_SESSION['message'] = 'Data gagal disimpan';
    header("location:siswa.php");
}
mysql_close($conn);
?>