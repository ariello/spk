<?php
session_start();
if(!isset($_SESSION['user'])){
	header("location:index.php");
}
$username=$_SESSION['user'];
include("connect_sisfo_akademik.php");
$strquery = "select ipa,ips from t_minat where nis='$username'";
$query = mysql_query($strquery);
$hslminat = mysql_fetch_assoc($query);

if (!empty($hslminat)) {
    $_SESSION['have_minat'] = true;
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
<a href='logout.php' style="text-decoration:none;color:black">
<button style="position:absolute;top:32%;left:72%;cursor:pointer">Logout</button>
</a>
<body topmargin="0" leftmargin="0">
<table cellspacing="0" cellpadding="0" border="0" align="center">
<tr>
    <td colspan="2"><img src="images/top2.jpg"></td>
</tr>

<tr height="20"> <td></td></tr>
<tr>
  <td valign="top" rowspan="3">
<tr>
	<td><img src="images/caphome.jpg"></td>
	</tr>
	<td valign="top" height="100%" >
	<table cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td height="250" width="752px"  background="images/form.jpg" align="center" style="image:no-repeat" class="style4">
			<table>
                            <tr>
                                <td width="10px" align="right" >&nbsp;</td>
                                <td class="style4" align="left">
                                        Selamat datang di website Sistem Pendukung Keputusan Pemilihan Jurusan SMA (IPA/IPS/Bahasa)<br/>
                                        <br/>
                                        Ada tiga tahapan yang akan dilakukan dalam pemilihan jurusan dengan SPK ini, antara lain :<br/>
                                        <ol>
                                                <li>Mengambil dan Menghitung rata-rata nilai per-bidang jurusan</li>
                                                <li>Mengambil data Hasil Psikotes</li>
                                                <li>Mengikuti kuis peminatan jurusan</li>
                                        </ol>
                                        
                                        <p align="center">
                                            <?php
                                                if (!isset($_SESSION['have_minat'])) {
                                                
                                            ?>
                                                Silahkan klik tombol start untuk mulai menggunakan SPK ini.<br/><br/>
                                                <form action="getnilai.php" method="post">
                                                        <input type="hidden" name="username">
                                                        <input type="submit" name="start" value="start">
                                                </form>
                                        <?php
                                            } else {
                                        ?>
                                            <?php echo $_SESSION['nama'];?> telah mengikuti kuis peminatan ini hasilnya sebagai berikut:<br/>
                                            <ul>
                                                <table>
                                                    <tr><td class="style4"><li>IPA</li></td><td>:</td><td class="style4"><?php echo $hslminat['ipa'];?>%</td></tr>
                                                    <tr><td class="style4"><li>IPS</li></td><td>:</td><td class="style4"><?php echo $hslminat['ips'];?>%</td></tr>
                                                </table>
                                            </ul>
                                        <?php
                                            }
                                        ?>
                                        </p>
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
<script>
        
</script>
</body>
</html>
