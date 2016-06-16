<?php
			@session_start();
			
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
						<div class="bazingaThinColumnWider">
							<h1>Menu</h1>
							
							<br/>
							
						</div>
    			    			
						<br />
				
							<section class="menuSection">
							<h2>_COFFEE</h2>
							<?php
								include("function/konekcija.inc");
								
								$upitmeni = "SELECT * FROM katalog WHERE cokolada = 'no'";
								$obrada = mysql_query($upitmeni,$konekcija);
								if(!$obrada){
									echo "Trenutno nema podataka u bazi";
								}
								else{
									while($ro=mysql_fetch_array($obrada))
									{
									
									
									echo "<article class='menuItem'>";  				
									echo "<h3>".$ro['naziv']."</h3>";
									echo "<div class='menuItemDesc'>".$ro['sastav']."</div>";
									echo "<div class='menuItemPrice'>$".$ro['cena']."</div>";
									echo "<div class='bazingaClear'></div>";
									echo "</article>";
									}
								}
								
							?>
							</section>		
							
							<section class="menuSection">
							<h2>_CHOCOLATE</h2>
							<?php
								
								$upitmenii = "SELECT * FROM katalog WHERE cokolada = 'yes'";
								$obradaa = mysql_query($upitmenii,$konekcija);
								if(!$obradaa){
									echo "Trenutno nema podataka u bazi";
								}
								else{
									while($rol=mysql_fetch_array($obradaa))
									{
									
									
									echo "<article class='menuItem'>";  				
									echo "<h3>".$rol['naziv']."</h3>";
									echo "<div class='menuItemDesc'>".$rol['sastav']."</div>";
									echo "<div class='menuItemPrice'>$".$rol['cena']."</div>";
									echo "<div class='bazingaClear'></div>";
									echo "</article>";
									}
								}
								include("function/zatvori.inc");
							?>
							</section>		
							
							
							
												
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