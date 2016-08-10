<?php
session_start();
include("../configure/database.php");

$nis =$_REQUEST["nis"];
$nama =$_REQUEST["nama"];
$password =$_REQUEST["password"];
$nilai_ipa = $_REQUEST["nilai_ipa"];
$nilai_ips = $_REQUEST["nilai_ips"];
$psikotes_ipa = $_REQUEST["psikotes_ipa"];
$psikotes_ips = $_REQUEST["psikotes_ips"];

$strquery = "DELETE t_siswa.*, t_nilai_rata2.*, t_minat.*, t_hasil_psikotes_bid_jurusan.* FROM t_siswa 
            LEFT JOIN t_nilai_rata2 ON t_siswa.nis = t_nilai_rata2.nis
            LEFT JOIN t_hasil_psikotes_bid_jurusan ON t_siswa.nis = t_hasil_psikotes_bid_jurusan.nis 
            LEFT JOIN t_minat ON t_siswa.nis = t_minat.nis 
            WHERE t_siswa.nis='$nis'";
//die(var_dump($strquery));
if (mysql_query($strquery)){
    $_SESSION['error'] = false;
    $_SESSION['message'] = 'Data telah dihapus';
    header("location:list_siswa.php");
} else{
    $_SESSION['error'] = true;
    $_SESSION['message'] = 'Data gagal disimpan';
    header("location:list_siswa.php");
}
mysql_close($conn);
?>