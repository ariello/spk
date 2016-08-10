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
</style>	
</head>

<body topmargin="0" leftmargin="0">

<table cellspacing="0" cellpadding="0" border="0" align="center">
<tr>
	<td colspan="2"><img src="images/top2.jpg"></td>
</tr>

<tr height="50"> <td>&nbsp; </td></tr>
<tr height="50"> <td>&nbsp; </td></tr>

<tr>
  <td valign="top" rowspan="3">
  
<tr>
	<?
		if(isset($status) && $status=='salah')
		{
			echo "Password Salah";
		}
	?>
	<td><img src="images/caplogin.jpg"></td>
	</tr>
	<td valign="top" height="100%">
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<form action="login.php" method="post">
			<td width="404" height="142" background="images/form.jpg" align="center">
			<table cellpadding="0" cellspacing="0" border="0">
				<tr>
				  <td align="right" class="style1">nomor induk siswa:</td>
				  <td style="padding-left:5px;"><input type="text" name="username"></td></tr>
				<tr>
				  <td align="right" class="style1">password:</td>
				  <td style="padding-left:5px;"><input type="password" name="pass"></td></tr>
				<tr>
				  <td colspan="2" align="right">	
				  <input type="submit" name="Submit" value="Submit"></td>
				</tr>
				<tr><td colspan="2" class="txt"><div style="padding-left:10px;"><input type="checkbox" name="name1" value="">Remember my ID on this computer</div></td></tr>
			</table>
			</td>
			</form>
		</tr>
		<tr>
		  <td width="370" height="139" align="right" valign="middle" background="images/bg2.jpg" class="txt style2" style="padding-top:30px;"> <br><br><br><br>
	        <span class="style3">created by Fadel Muhammad</span> <span class="style2">&nbsp;</span> </td>
		</tr>
	</table>
	</td>
	
</tr>

</body>
</html>
