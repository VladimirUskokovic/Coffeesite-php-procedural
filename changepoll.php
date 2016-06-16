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
						 
						 <div id="editpoll">
									<form name="ankete" method="post" action="changepoll.php" id="add-poll">
									<div class="poll-backdrop"></div>
									<div class="poll-content">
									<h2>Create new poll</h2><br>
									<input type="text"  name="pitanje" placeholder="Question?"><br>
									<textarea name="odgovori"  cols="18" placeholder="Answers"></textarea><br>
									<input type="submit" value="Add" name="unesi" class="add">
															<?php
															include('function/konekcija.inc');
									$dugme_upis=&$_POST['unesi'];
									$dugme_aktiviraj=&$_POST['aktiviraj'];
									$dugme_brisi=&$_POST['delete'];
									if(isset($dugme_upis)){
									$pitanje=&$_POST['pitanje'];
									$odgovori=&$_POST['odgovori'];
$niz_odgovori=explode('
', $odgovori);
									$broj=count($niz_odgovori);
									$upis_pitanje="INSERT INTO ankete VALUES('', '$pitanje', 0)";
									$izvrsi_upis_pitanje=mysql_query($upis_pitanje) or die(mysql_error());
									$izvuciID="SELECT id_ankete FROM ankete WHERE pitanje='$pitanje'";
									$izvrsi_izvuciID=mysql_query($izvuciID) or die(mysql_error());
									$red=mysql_fetch_array($izvrsi_izvuciID);
									$id_ankete=$red['id_ankete'];
									for($i = 0; $i < $broj; $i++){
									$upis_odgovora = "INSERT INTO odgovori VALUES('', '$id_ankete',
									'$niz_odgovori[$i]')";
									$upisi = mysql_query($upis_odgovora) or die("Upit 3 nije izvršen!".mysql_error());

									$id_odgovor = "SELECT id_odgovori FROM odgovori WHERE id_ankete = '$id_ankete' AND odgovori= '$niz_odgovori[$i]'";
									$uzmi_id_odgovor = mysql_query($id_odgovor) or die(mysql_error());
									$niz_id_odgovor = mysql_fetch_array($uzmi_id_odgovor);
									$id_odgovor= $niz_id_odgovor[0];
									$upis_rezultati = "INSERT INTO rezultat VALUES('', '$id_ankete', '$id_odgovor', '0')";
									$upis = mysql_query($upis_rezultati) or die(mysql_error());
									}
									if($upis )
									{echo 'Anketa je upisana!';
									$refresh_time=3000; 
									$refresh_to="changepoll.php"; 
									echo "<script type=\"text/javascript\">setTimeout(function(){window.location.replace(\"$refresh_to\");},$refresh_time);</script>";
									}
									}?>
									</form></div>
									<form name="aktivnost" method="post" action="changepoll.php" id="active-poll">
									<div class="poll-backdrop"></div>
									<div class="poll-content">
									<h2>Change active poll</h2><br>
									<select name="aktivnost_ankete">
									<option>Choose poll</option>
									<?php
									
									$upit="SELECT * FROM ankete";
									$rezultat=mysql_query($upit) or die("Upit 1 nije izvršen!".mysql_error());
									while($niz=mysql_fetch_array($rezultat))
									{ echo '<option value="'.$niz['id_ankete'].'">'.$niz['pitanje'].'</option>'; } ?>
									</select>
									<br/>
									<input type="submit" value="Activate" name="aktiviraj" class="active"> <br>
									<input type="submit" value="Delete" name="delete" class="erase"><br>
									<a href="author.php">Ankete</a><br/>
									
				<?php
									if(isset($dugme_aktiviraj)){	
									$aktivnost=$_POST['aktivnost_ankete'];
									$aktiviraj="UPDATE ankete SET aktivna=1 WHERE id_ankete=".$aktivnost;
									$deaktiviraj="UPDATE ankete SET aktivna=0 WHERE id_ankete <>".$aktivnost;
									$izvrsi_deaktiviraj=mysql_query($deaktiviraj) or die("Upit 6 nije izvršen!".mysql_error());
									$izvrsi_aktiviraj=mysql_query($aktiviraj) or die("Upit 7 nije izvršen!".mysql_error());
									if($izvrsi_aktiviraj)
									{echo 'Anketa je uspešno aktivirana!';}

									} 
									if(isset($dugme_brisi)){
										$pollerase=$_POST['aktivnost_ankete'];
										$delete_anketa="DELETE FROM ankete  WHERE id_ankete=".$pollerase;
										$delete_odgovori="DELETE FROM odgovori  WHERE id_ankete=".$pollerase;
										$delete_rezultat="DELETE FROM rezultat  WHERE id_ankete=".$pollerase;
										$del=mysql_query($delete_anketa) or die("Upit 7 nije izvršen!".mysql_error());
										if($del){
										$del_odg=mysql_query($delete_odgovori) or die("Upit 7 nije izvršen!".mysql_error());}
										if($del_odg){
										$del_rez=mysql_query($delete_rezultat) or die("Upit 7 nije izvršen!".mysql_error());}
										if($del_rez)
									{echo 'Anketa je uspešno obrisana!';
									$refresh_time=3000; 
									$refresh_to="changepoll.php"; 
									echo "<script type=\"text/javascript\">setTimeout(function(){window.location.replace(\"$refresh_to\");},$refresh_time);</script>";
									}

									} 
									
									mysql_close($konekcija); ?>
									</form></div></body></html>
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
