<?php
session_start();
if(!isset($_SESSION['user'])){
	header("location:index.php");
}
$username = $_SESSION['user'];
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
<?php
	$soal1 = (isset($_POST['soal1']) ? $_POST['soal1'] : '');
	$soal2 = (isset($_POST['soal2']) ? $_POST['soal2'] : '');
	$soal3 = (isset($_POST['soal3']) ? $_POST['soal3'] : '');
	$soal4 = (isset($_POST['soal4']) ? $_POST['soal4'] : '');
	$soal5 = (isset($_POST['soal5']) ? $_POST['soal5'] : '');
	$soal6 = (isset($_POST['soal6']) ? $_POST['soal6'] : '');
	$soal7 = (isset($_POST['soal7']) ? $_POST['soal7'] : '');
	$soal8	= (isset($_POST['soal8']) ? $_POST['soal8'] : '');
	$soal9 = (isset($_POST['soal9']) ? $_POST['soal9'] : '');
	$soal10 = (isset($_POST['soal10']) ? $_POST['soal10'] : '');
?>
<table cellspacing="0" cellpadding="0" border="0" align="center">
<tr>
	<td colspan="2"><img src="images/top2.jpg"></td>
</tr>

<tr height="20"> <td>&nbsp; </td></tr>
<tr>
  <td valign="top" rowspan="3">
<tr>
	<td><img src="images/capminat.jpg"></td>
	</tr>
	<td valign="top" height="100%" >
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td height="250" width="752px"  background="images/form.jpg" align="left" class="style4">
			<table>
			<tr>
				<td width="40px" align="right" >&nbsp;</td>
				<td class="style4">Berdasarkan kuis peminatan yang telah Anda ikuti, hasil mengenai minat Anda adalah sebagai berikut : <br/>
				<br/>
				<?php
					$skorIPA = 0;
					$skorIPS = 0;
				
						switch($soal1)
						{
							case "a" : $skorIPA = $skorIPA + 3; break;
							case "b" : $skorIPS = $skorIPS + 1; break;
							case "c" : $skorIPA = $skorIPA + 2; break;
							case "d" : $skorIPA = $skorIPA + 1;
									   $skorIPS = $skorIPS + 1; break;
						}
						
						switch($soal2)
						{
							case "a" : $skorIPA = $skorIPA + 2; break;
							case "b" : $skorIPS = $skorIPS + 1; break;
							case "c" : $skorIPS = $skorIPS + 2; break;
							case "d" : $skorIPS = $skorIPS + 3; break;
						}
						
						switch($soal3)
						{
							case "a" : $skorIPA = $skorIPA + 1;
									   $skorIPS = $skorIPS + 1;	break;
							case "b" : $skorIPA = $skorIPA + 1;
									   $skorIPS = $skorIPS + 1; break;
							case "c" : $skorIPA = $skorIPA + 2;
									   $skorIPS = $skorIPS + 1; break;
							case "d" : $skorIPA = $skorIPA + 1;
									   $skorIPS = $skorIPS + 2; break;
						}
						
						switch($soal4)
						{
							case "a" : $skorIPS = $skorIPS + 3; break;
							case "b" : $skorIPA = $skorIPA + 1;
									   $skorIPS = $skorIPS + 1; break;
							case "c" : $skorIPA = $skorIPA + 3; break;
							case "d" : $skorIPA = $skorIPA + 2;
									   $skorIPS = $skorIPS + 3; break;
							
						}
						
						switch($soal5)
						{
							case "a" : $skorIPS = $skorIPS + 2; break;
							case "b" : $skorIPS = $skorIPS + 2; break;
							case "c" : $skorIPA = $skorIPA + 2; break;
							case "d" : $skorIPA = $skorIPA + 3; break;
						}
						
						switch($soal6)
						{
							case "a" : $skorIPS = $skorIPS + 3; break;
							case "b" : $skorIPA = $skorIPA + 3; break;
							case "c" : $skorIPA = $skorIPA + 3;
									   $skorIPS = $skorIPS + 3; break;
							case "d" : $skorIPA = $skorIPA + 3;
									   $skorIPS = $skorIPS + 4; break;
						}
						
						switch($soal7)
						{
							case "a" : $skorIPA = $skorIPA + 3;
									   $skorIPS = $skorIPS + 3; break;
							case "b" : $skorIPA = $skorIPA + 2; break;
							case "c" : $skorIPS = $skorIPS + 2; break;
							case "d" : $skorIPA = $skorIPA + 3;
									   $skorIPS = $skorIPS + 4; break;
						}
						
						switch($soal8)
						{
							case "a" : $skorIPA = $skorIPA + 4; break;
							case "b" : $skorIPA = $skorIPA + 1; 
									   $skorIPS = $skorIPS + 2; break;
							case "c" : $skorIPS = $skorIPS + 4; break;
							case "d" : $skorIPA = $skorIPA + 4;
									   $skorIPS = $skorIPS + 1; break;
						}
						
						switch($soal9)
						{
							case "a" : $skorIPA = $skorIPA + 2; break;
							case "b" : $skorIPS = $skorIPS + 3; break;
							case "c" : $skorIPA = $skorIPA + 1;
									   $skorIPS = $skorIPS + 2; break;
							case "d" : $skorIPA = $skorIPA + 1;
									   $skorIPS = $skorIPS + 1; break;
						}
						
						switch($soal10)
						{
							case "a" : $skorIPS = $skorIPS + 2; break;
							case "b" : $skorIPA = $skorIPA + 1; break;
							case "c" : $skorIPA = $skorIPA + 2; 
									   $skorIPS = $skorIPS + 2; break;
							case "d" : $skorIPA = $skorIPA + 1; break;
						}
				
					$total = $skorIPA + $skorIPS;
					$preIPA = round(($skorIPA/$total)*100);
					$preIPS = round(($skorIPS/$total)*100);
					include("connect_sisfo_akademik.php");
					$strquery = "INSERT INTO t_minat (id,nis,ipa,ips) VALUES ('',$username,$preIPA,$preIPS)";
					
					$query = mysql_query($strquery);
				?>
				Presentase minat bidang :
				<ul><table>
					<tr><td class="style4"><li>IPA</li></td><td>:</td><td class="style4"><?echo $preIPA;?>&#37;</td></tr>
					<tr><td class="style4"><li>IPS</li></td><td>:</td><td class="style4"><?echo $preIPS;?>&#37;</td></tr>
					</table>
				</ul>
						<?php
							$_SESSION['preIPA']=$preIPA;
							$_SESSION['preIPS']=$preIPS;
						?>
				<br/>
				Klik next untuk melanjutkan ke hasil.<br/><br/>
				<p align="center">
				<form action="hasil.php?ipa=<?=$preIPA?>&ips=<?=$preIPS?>" method="post">
					
					<input type="submit" name="next" value="next">
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
