<?php
session_start();
if(!isset($_SESSION['user'])){
	header("location:index.php");
}
$username = $_SESSION['user'];
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
        ?>
        <table cellspacing="0" cellpadding="0" border="0" align="center">
            <tr>
                <td colspan="2"><img src="images/top2.jpg"></td>
            </tr>
            <tr height="20"><td>&nbsp;</td></tr>
            <tr>
                <td valign="top" rowspan="3">
            <tr>
                <td><img src="images/cappsikotes.jpg"></td>
            </tr>
            <tr>
                <td valign="top" height="100%" >
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td height="250" width="752px"  background="images/form.jpg" align="left" class="style4">
                                <table>
                                    <tr>
                                        <td width="40px" align="right" >&nbsp;</td>
                                        <td class="style4">Menurut hasil psikotes yang telah Anda ikuti, <br/>
                                        <?php
                                                include("connect_sisfo_akademik.php");
                                                $strquery = "select ipa,ips from t_hasil_psikotes_bid_jurusan where nis='$username'";
                                                $query = mysql_query($strquery);
                                                $hsl   = mysql_fetch_assoc($query);
                                                mysql_close($conn);
                                        ?>
                                        <br/>
                                        Anda termasuk kedalam kategori berikut untuk bidang jurusan :
                                    <ul>
                                        <table>
                                            <tr><td class="style4"><li>IPA</li></td><td>:</td><td class="style4"><?php echo $hsl['ipa'];?></td></tr>
                                            <tr><td class="style4"><li>IPS</li></td><td>:</td><td class="style4"><?php echo $hsl['ips'];?></td></tr>
                                        </table>
                                    </ul>
                                    <br/>
                                    Klik next untuk melanjutkan.<br/><br/>
                                    <p align="center">
                                    <form action="minat.php" method="post">
                                            <input type="hidden" name="username">
                                            <input type="submit" name="next" value="next">
                                    </form></p>
                                    </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td  align="right" valign="middle" background="images/bg.jpg" class="txt style2"> 
                                <br><br>
                                <span class="style3">created by Fadel Muhammad&nbsp;&nbsp;</span><br> <span class="style2">&nbsp;</span> 
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
    </body>
</html>
