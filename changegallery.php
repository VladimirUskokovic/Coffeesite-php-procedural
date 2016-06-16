<?php
	@session_start();
	if(!isset($_SESSION['idU']) || $_SESSION['nu'] != 'admin')
	{
		header('Location:index.php');
	}
?>
<!doctype html>
<html>
	<head>
		<title>Cafe Bazinga</title>
		
		<link rel="stylesheet" href="css/supersized.css" media="screen" />  
		<link rel="stylesheet" href="css/jquery.jscrollpane.css" media="screen" />
		<link rel="stylesheet" href="css/stil.css" type="text/css">
        
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <meta name="description" content="Welcome to Bazinga Cafe !">
		<meta name="keywords" content="Bazinga Cafe">
		<meta name="author" content="Vladimir Uskokovic">
		<link rel="shortcut icon" href="img/bazingaLogoTransparent.png">
		
		<script src="js/libs/modernizr-2.0.6.min.js"></script>

		
	</head>
	<body>
		
		<div id="container">
		<?php
			
			switch(@$_SESSION['nu'])
			{
				case 'admin':
					echo "<p>Welcome: <b>".$_SESSION['kor_ime']." </b><a href='logout.php'>Logout</a> <a href='panel.php'>Admin Panel</a></p>";
					break;
				case 'korisnik':
					echo "<p>Welcome: <b>".$_SESSION['kor_ime']." </b><a href='logout.php'>Logout</a> </p>";
					break;
			}
				
		?>
			 <div id="main" role="main">
				<div id="bazingaContent">
					<div id="bazingaContentInner">
						<div class="bazingaThinColumnWidest">
					
						<?php
							include('adminmeni.php');
						?>
						<br/>
						<br/>
						<br/>
						<br/>
						<div id="editadmin">
									
								<table id="users_table">
								
								<thead>
								<th>ID</th>
								<th>Name</th>
								<th>picture</th>								
								<th>DELETE</th>
								
								</thead>
								
								<?php
								include("function/konekcija.inc");
								# user listing
								$query="SELECT * FROM galerija";
								$data=mysql_query($query,$konekcija);
								if($data){
									while($row=mysql_fetch_array($data,MYSQLI_ASSOC)){
									
									
									$gallery_del="changegallery.php?gallery_del=".@$row['id_galerija'];
									echo "<tr>";
									echo "<td>".$row['id_galerija']."</td>";
									echo "<td>".$row['naziv']."</td>";
									echo "<td><img src='".$row['putanja_mala']."'/></td>";
								
								
								
									
									echo "<td><a href=\"$gallery_del\" onclick=\"return confirm_gallery_del();\"><img height='20px'  width='20px' src=\"img/no.png\" /></a></td>";
									echo "</tr>";
									}
									}
									else die("Neuspešno dohvatanje podataka!");
									
									?>
									</table>
									
									<?php
									
									# gallery delete
									if(isset($_GET['gallery_del'])){
									$id=@$_GET['gallery_del'];
									$query="DELETE FROM galerija WHERE id_galerija=".$id;
									if(mysql_query($query,$konekcija)){
									echo "<p style=\"text-align: center;\"><span class=\"sucess_msg\">Uspešno ste obrisali sliku <span style=\"color: #fbb700;\"></span>!</span><br />";
									echo "Stranica će se osvežiti za 3 sekundi.</p>";
									$refresh_time=3000; # msec
									$refresh_to="changegallery.php"; # absolute link
									echo "<script type=\"text/javascript\">setTimeout(function(){window.location.replace(\"$refresh_to\");},$refresh_time);</script>";
									}
									else{
									echo "<p style=\"text-align: center;\"><span class=\"sucess_msg\">Niste obrisali sliku!</span><br />";
									}
									}
									?>
									<!--END CONTENT-->
									<script type="text/javascript">
									function confirm_gallery_del(){
									if(confirm("Da li ste sigurni da želite da obrišete korisnika?")) return;
									else return false;
									}
									</script>
									<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="add-user" method="post" enctype="multipart/form-data" >
									<div class="user-backdrop"></div>
									<div class="user-content">
									<h3>Upload Picture</h3>
									<table>
									 <tr>
									
									<td>
									<input type="text" class="styled" id="tbImeSlike" placeholder="Name"name="tbImeSlike" />
									
									</td>
									</tr>
									
									<tr>
									
				<td>
				   <input type="file"  id="tbSlika"  name="tbSlika" />
				</td>
			 </tr>
                      
			 <tr>
			    <td colspan="2" align="center">
				    <br/><input type="submit" value="Upload" class="change" name="btnPostavi" />
				</td>
			 </tr>
		 </table>
	  
	 
<?php
include('function/funkcije.inc');
if(isset($_REQUEST['btnPostavi']))
	{
		$dir_velike = "gallery/";
		$dir_male = "gallery/malaslika/";
		$ime_slike = @$_REQUEST['tbImeSlike'];
	
		
		$ime_fajla = $_FILES['tbSlika']['name'];
		$tmp_fajla = $_FILES['tbSlika']['tmp_name'];
		$tip_fajla = $_FILES['tbSlika']['type'];
		
		
		$putanja_slike = $dir_velike.$ime_fajla;
		$putanja_male = $dir_male.$ime_fajla;
		
		if($tip_fajla == "image/jpg" || $tip_fajla == "image/jpeg")
		{
			if(move_uploaded_file($tmp_fajla, $putanja_slike))
			{
				malaslika($putanja_slike, $putanja_male, 181, 181);
				
				
				$upit_upis = "INSERT INTO galerija VALUES('', '$ime_slike', '$putanja_slike','$putanja_male')";
				
				$rez_upis = mysql_query($upit_upis, $konekcija);
				
				if(!$rez_upis)
				{
					$greske[] = "Greska prilikom upisa".mysql_error();
				}
				else{echo "You are successfully uploaded photo! Page refreshed after 3 seconds!";
				$refresh_time=3000; # msec
									$refresh_to="changegallery.php"; # absolute link
									echo "<script type=\"text/javascript\">setTimeout(function(){window.location.replace(\"$refresh_to\");},$refresh_time);</script>";
									};
				include("function/zatvori.inc");
			}
		}
		else
		{
			$greske[] = "Nije dozvoljen nijedan tip fajla sem jpg/jpeg!";
		}
		ispis_gresaka($greske);
		
	}
?>
									</form>
									</div>

				
									
							
							
							
												
					</div>
				</div>
			 </div>
		</div>
		
		</div>
		
		 <nav id="bazingaMenuContainer">
			<?php
				include("menu.php");
			?>
			<div class="bazingaClear"></div>
			<?php
				include("footer.php");
			?>
		 </nav>    	
		 
		 <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>

		<script type="text/javascript" src="js/mylibs/supersized.3.1.3.min.js"></script>
		<script type="text/javascript" src="js/mylibs/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="js/mylibs/mwheelIntent.js"></script>
		<script type="text/javascript" src="js/mylibs/jquery.jscrollpane3.min.js"></script>		 
		
		 <script  src="js/background.js"></script>
		 <script defer src="js/plugins.js"></script>
		 <script defer src="js/script.js"></script> 
		
	</body>
</html>