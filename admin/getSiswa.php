<?php
include("../configure/database.php");

$nis=$_REQUEST["nis"];
$strquery = "SELECT nama FROM t_siswa WHERE nis='$nis'";
$query = mysql_query($strquery);
$result = mysql_fetch_assoc($query);
echo $result['nama'];
mysql_close($conn);
?>