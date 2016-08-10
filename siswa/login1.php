		<? include("connect_sisfo_akademik.php");
		$username=$_POST["username"];
		$pass=$_POST["pass"];
		$strquery = "select * from t_siswa where nis='$username'";
		$query = mysql_query($strquery);
		//$hsl	=	mysql_fetch_array($query);
		$jum	= 	mysql_num_rows($query);
		if ($jum!=0)
		{	$strquery2 = "select * from t_siswa where nis='$username' and password='$pass'";
			$query2 = mysql_query($strquery2);
			$jum2	= 	mysql_num_rows($query2);
			if ($jum2!=0)
			{
				//header("Location:home.php?user='$username'");
				include("home.php");
				//session_start();
				//$_SESSION['suser']=$username;
				//header("location:home.php");
				//echo "BERHASIL";
				//echo "<script>message_login(var user)</script>";
			}
			else
			{	include("index.php");
				//ob_start();
				//header("location:index.php?status=salah");
				//ob_flush();
				//echo "password salah";
				//echo "<script>message_pass()</script>";
			}
		}
		else
		{
			include("index.php");
			//echo "<script>message_login(var user)</script>";
			//header("location:index.php?");
			//echo"gagal";
		}
		mysql_close($conn);
	?>