<?php
session_start();
if(!isset($_SESSION['user'])){
	header("location:index.php");
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
<?php
	$status = (isset($_GET['status']) ? $_GET['status'] : '');
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
			<td height="250" width="752px"  background="images/form3.jpg" align="left" class="style4">
			<table>
			<tr>
				<td width="40px" align="right" >&nbsp;</td>
				<td class="style4">Silahkan mengisi kuis peminatan berikut : <br/>
				
				<!--
				
				isi form minatnya.. ToT
				
				-->
				<form name="formMinat" method="post" action="getminat.php">
	<table>
		<tr>
			<td class="style4"> 1. </td>
			<td class="style4"> Pekerjaan mana yang menurut anda lebih menarik dan menyenangkan? </td> 
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="RADIO" name="soal1" value="a" /> Dokter 
				&nbsp; &nbsp;
				<input type="radio" name="soal1" value="b" />Pengusaha
				&nbsp; &nbsp;
				<input type="radio" name="soal1" value="c" /> Insinyur
				&nbsp; &nbsp;
				<input type="radio" name="soal1" value="d" /> Seniman
			</td>
		</tr>
		<tr>
			<td class="style4">&nbsp;   </td>
			<td class="style4">&nbsp;  </td>
		</tr>
		<tr>
			<td class="style4"> 2. </td>
			<td class="style4"> Seberapa sering anda mengikuti perkembangan politik dan ekonomi? </td>
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="radio" name="soal2" value="a" /> Tidak pernah 
				&nbsp; &nbsp;
				<input type="radio" name="soal2" value="b" /> Tidak Sering
				&nbsp; &nbsp;
				<input type="radio" name="soal2" value="c" /> Sering
				&nbsp; &nbsp;
				<input type="radio" name="soal2" value="d" /> Sangat Sering
				
			</td>
		</tr>
		<tr>
			<td>&nbsp;   </td>
			<td>&nbsp;  </td>
		</tr>
		<tr>
			<td class="style4"> 3. </td>
			<td class="style4"> Berapa banyak jenis bahasa yang anda kuasai? </td>
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="radio" name="soal3" value="a"  /> 1
				&nbsp; &nbsp; &nbsp; &nbsp;
				<input type="radio" name="soal3" value="b" /> 2
				&nbsp; &nbsp; &nbsp; &nbsp;
				<input type="radio" name="soal3" value="c" /> 3
				&nbsp; &nbsp; &nbsp; &nbsp;
				<input type="radio" name="soal3" value="d" /> Lebih dari 3
			</td>
		</tr>
		<tr>
			<td>&nbsp;   </td>
			<td>&nbsp;  </td>
		</tr>
		<tr>
		  <td class="style4">4. </td>
			<td class="style4"> Bergerak dibidang apakah kebanyakan keluarga anda?? </td>
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="radio" name="soal4" value="a"  /> Bisnis / pengusaha
				<br />
				<input type="radio" name="soal4" value="b" /> Entertaiment
				<br />
				<input type="radio" name="soal4" value="c" /> Kesehatan (Dokter, perawat, analis gizi, dsb)
				<br />
				<input type="radio" name="soal4" value="d" /> Relegius

			</td>
		</tr>
		<tr>
			<td>&nbsp;   </td>
			<td>&nbsp;  </td>
		</tr>
		<tr>
			<td class="style4"> 5. </td>
			<td class="style4"> Berapa banyak anda menghabiskan waktu untuk merawat tubuh?? (baik untuk kecantikan maupun kesehatan)? </td> 
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="RADIO" name="soal5" value="a" /> Tidak pernah 
				&nbsp; &nbsp;
				<input type="radio" name="soal5" value="b" />sedikit
				&nbsp; &nbsp;
				<input type="radio" name="soal5" value="c" /> Banyak
				&nbsp; &nbsp;
				<input type="radio" name="soal5" value="d" />  Sangat banyak
			</td>
		</tr>
		<tr>
			<td>&nbsp;   </td>
			<td>&nbsp;  </td>
		</tr>
		<tr>
		  <td class="style4">6. </td>
			<td class="style4"> Manakah sifat dibawah ini yang sesuai dengan karakter anda?? </td>
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="radio" name="soal6" value="a"  /> keras, tegas, selalu mengikuti perkembangan (update)
				<br />
				<input type="radio" name="soal6" value="b" /> pendiam, suka mencari tahu sesuatu, teliti
				<br />
				<input type="radio" name="soal6" value="c" />  Suka mencoba hal baru, kreatif, pemberani
				<br />
				<input type="radio" name="soal6" value="d" />  tertutup, malu-malu
			</td>
		</tr>
		<tr>
			<td>&nbsp;   </td>
			<td>&nbsp;  </td>
		</tr>
		<tr>
		  <td class="style4">7. </td>
			<td class="style4">  Apa yang sering anda lakukan untuk mengisi waktu luang?? </td>
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="RADIO" name="soal7" value="a" /> tidur 
				&nbsp; &nbsp;
				<input type="radio" name="soal7" value="b" />Belajar
				&nbsp; &nbsp;
				<input type="radio" name="soal7" value="c" /> Game
				&nbsp; &nbsp;
				<input type="radio" name="soal7" value="d" /> Internet-an mencari informasi baru
			</td>
		</tr>
		<tr>
			<td>&nbsp;   </td>
			<td>&nbsp;  </td>
		</tr>
		<tr>
		  <td class="style4">8. </td>
			<td class="style4"> Tugas apa yang paling anda benci?? </td>
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="radio" name="soal8" value="a"  /> berhitung, serba menggunakan rumus
				<br />
				<input type="radio" name="soal8" value="b" /> mengarang
				<br />
				<input type="radio" name="soal8" value="c" />  menghafal 
				<br />
				<input type="radio" name="soal8" value="d" />  menciptakan sesuatu yang baru
			</td>
		</tr>
		<tr>
			<td>&nbsp;   </td>
			<td>&nbsp;  </td>
		</tr>
		<tr>
		  <td class="style4">9. </td>
			<td class="style4"> Apakah anda takut atau merasa kesulitan untuk berbicara di depan umum?? </td>
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="radio" name="soal9" value="a"  /> sangat takut
				<br />
				<input type="radio" name="soal9" value="b" /> tidak takut
				<br />
				<input type="radio" name="soal9" value="c" />  kadang-kadang
				<br />
				<input type="radio" name="soal9" value="d" />  awalnya saja, seterusnya tidak
			</td>
		</tr>
		<tr>
			<td>&nbsp;   </td>
			<td>&nbsp;  </td>
		</tr>
		<tr>
		  <td class="style4">10. </td>
			<td class="style4"> Manakah yang lebih menakutkan? </td>
		</tr>
		<tr>
			<td>&nbsp;  </td>
			<td class="style4"> 
				<input type="radio" name="soal10" value="a"  /> melihat ceceran darah
				<br />
				<input type="radio" name="soal10" value="b" /> berdebat dan mempertahankan pendapat
				<br />
				<input type="radio" name="soal10" value="c" />  ber-acting  
				<br />
				<input type="radio" name="soal10" value="d" />  presentasi didepan orang banyakwalnya saja, seterusnya tidak
			</td>
		</tr>
		<tr>
			<td colspan="2">
			</td>
		</tr>
	</table>
				
				<!-- -->
				
				Klik next untuk melihat hasil kuis peminatan.<br/><br/>
				<p align="center">
					<input type="hidden" name="username">
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
