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

$strquery = "UPDATE t_siswa 
            LEFT JOIN t_nilai_rata2 ON t_siswa.nis = t_nilai_rata2.nis
            LEFT JOIN t_hasil_psikotes_bid_jurusan ON t_siswa.nis = t_hasil_psikotes_bid_jurusan.nis 
            SET t_siswa.nama = '$nama', t_siswa.password='$password', t_nilai_rata2.ipa='$nilai_ipa',
                t_nilai_rata2.ips='$nilai_ips', t_hasil_psikotes_bid_jurusan.ipa='$psikotes_ipa', t_hasil_psikotes_bid_jurusan.ips='$psikotes_ips'
            WHERE t_siswa.nis='$nis'";
//die(var_dump($strquery));
if (mysql_query($strquery)){
    $_SESSION['error'] = false;
    $_SESSION['message'] = 'Data telah tersimpan';
    header("location:list_siswa.php");
} else{
    $_SESSION['error'] = true;
    $_SESSION['message'] = 'Data gagal disimpan';
    header("location:edit_siswa.php?nis=$nis");
}
mysql_close($conn);
?>