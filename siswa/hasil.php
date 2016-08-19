<?php
session_start();
if(!isset($_SESSION['user'])){
	header("location:index.php");
}
$uri = explode('/',  $_SERVER['PHP_SELF']);
if (isset($_SESSION['have_minat'])) {
?>
<script>
    var httpHost = 'http://<?php echo $_SERVER['HTTP_HOST'];?>/';
    var uri = '<?php echo $uri[1].'/'.$uri[2].'/';?>';
    alert('Anda telah megikuti kuis peminatan');
    location.href = httpHost+uri+'home.php';
</script>
<?php
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>SPK Penentuan Jurusan SMA</title>
<style>
.cap{font-family:Tahoma; font-weight:bold; font-size:11px; color:#9F0D10;}
.txt{font-family:Tahoma; font-weight:regular; font-size:11px; color:#000000; padding-top:5px;padding-left:15px;padding-right:15px;}
.menu{font-family:Tahoma; font-weight:bold; font-size:10px; color:#9F0D10; text-decoration:none;}
.footer{font-family:Tahoma;font-size:10px; color:#595959;}
.style1 {font-family: Tahoma; font-weight: bold; font-size: 11px; color: #000066; }
.style2 {color: #666666}
.style3 {
	font-size: 10px;
	color: #666666;
}
.style4 {font-family: Tahoma; font-weight: bold; font-size: 13px; color: #000066; }
</style>	
</head>

<body topmargin="0" leftmargin="0">
    <a href='logout.php' style="text-decoration:none;color:black">
<button style="position:absolute;top:32%;left:72%;cursor:pointer">Logout</button>
</a>
<?php
	$status = (isset($_GET['status']) ? $_GET['status'] : '');
		$preIPA=$_GET['ipa'];
	$preIPS=$_GET['ips'];
?>
<table cellspacing="0" cellpadding="0" border="0" align="center">
<tr>
	<td colspan="2"><img src="images/top2.jpg"></td>
</tr>

<tr height="20"> <td>&nbsp; </td></tr>
<tr>
  <td valign="top" rowspan="3">
<tr>
	<td><img src="images/caphasil.jpg"></td>
	</tr>
	<td valign="top" height="100%" >
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td height="250" width="752px"  background="images/form.jpg" align="left" class="style4">
			<table>
			<tr>
				<td width="40px" align="right" >&nbsp;</td>
				<td class="style4">
				<?php
				function ahp()
				{
					$username=$_SESSION['user'];
					include("connect_sisfo_akademik.php");
					$strquery = "select ipa,ips from t_nilai_rata2 where nis='$username'";
					$query = mysql_query($strquery);
					$hsl   = mysql_fetch_assoc($query);
	
					$strquery = "select ipa,ips from t_minat where nis='$username'";
					$query = mysql_query($strquery);
				
					$hslminat = mysql_fetch_assoc($query);
					
					$strquery = "select ipa,ips from t_hasil_psikotes_bid_jurusan where nis='$username'";
					
					$query = mysql_query($strquery);
					$hslpt   = mysql_fetch_assoc($query);
					
					//echo'<pre>';die(var_dump($hsl, $hslpt,$hslminat));
					/*for($i=0;$i<3;$i++)
					{
						switch($hsl[$i])
						{
							case "Sangat Tinggi" : $nilai[$i] = 100; break;
							case "Tinggi" : $nilai[$i] =80; break;
							case "Cukup" : $nilai[$i] =60; break;
							case "Kurang" : $nilai[$i] =40; break;
							case "Sangat Kurang" : $nilai[$i] =20; break;
						}
					}*/
					$choose = $choosept = $chooseminat= '';
					$result = $resultpt = $resultminat= '';
					foreach($hslpt as $key => $value) {
						if ($value == "Sangat Tinggi") {
							$hslpt[$key] = 100;
						} else if ($value == "Tinggi") {
							$hslpt[$key] = 80;
						} else if ($value == "Sedang") {
							$hslpt[$key] = 60;
						} else if ($value == "Rendah") {
							$hslpt[$key] = 40;
						} else if ($value == "Sangat Rendah") {
							$hslpt[$key] = 20;
						}
						if (empty($choosept)) {
							$choosept = $hslpt[$key];
							$resultpt = $key;
						} else if ($choosept < $hslpt[$key]) {
							$choosept = $hslpt[$key];
							$resultpt = $key;
						}
						
						if (empty($choose)) {
							$choose = $hsl[$key];
							$result = $key;
						} else if ($choose < $hsl[$key]) {
							$choose = $hsl[$key];
							$result = $key;
						}
						
						if (empty($chooseminat)) {
							$chooseminat = $hslminat[$key];
							$resultminat = $key;
						} else if ($chooseminat < $hslminat[$key]) {
							$chooseminat = $hslminat[$key];
							$resultminat = $key;
						}
					}
					
					
					if ($resultminat == $resultpt) {
						$ahp = strtoupper($resultpt);
					} else {
						$ahp = strtoupper($result);
					}
					include("connect_sisfo_akademik.php");
					$strquery = "UPDATE t_siswa set rekomendasi = '$ahp' WHERE nis = '$username'";
					//echo'<pre>';die(var_dump($strquery));
					$query = mysql_query($strquery);
					return $ahp;
					
				}
				
				
				?>
				
				Menurut hasil penentuan keputusan menggunakan metode AHP,<br/><br/>
				maka Anda cocok untuk melanjutkan sekolah dengan jurusan<br/><br/>
				
				<font size=6> 
				<?php 
                                    $max = ahp();
                                    echo $max;
				?>
                                </font><br/><br/>
				
				Terima kasih sudah menggunakan SPK ini.<br/><br/>
				<p align="center">
				<form action="logout.php" method="post">
					<input type="hidden" name="username">
					<input type="submit" name="logout" value="logout">
				</form></p>
				</td>
			</tr>
			</table>
			</td>
			</tr>
		<tr>
		  <td  align="right" valign="middle" background="images/bg.jpg" class="txt style2"> <br><br>
	        <span class="style3">created by Fadel Muhammad&nbsp;&nbsp;</span><br> <span class="style2">&nbsp;</span> </td>
		</tr>
	</table>
	</td>
	
</tr>

</body>
</html>