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
		<script src="js/funkcije.js"></script>
		<script src="js/ajaxobj.js"></script>
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
							<h1>AUTHOR</h1>
							<br/>
							
						</div>
						
						<div id="author">
						<img src="img/author.jpg" width="200px" height="200px;"/>
						<p>My name is Vladimir Uskoković. I was born on 12/18/1994. I live in Mionica near Valjevo. I graduated High technical school in Valjevo, navigate Electro computer. Now I am a second year student, "High School of Professional Studies in Information and Communication Technologies" in Belgrade, Department of Internet Technology, Web programming module. The site was built as a pre-exam obligations of objects Web programming PHP 1.</p>
					</div>
					
					

					<div id="poll">
						
            
           <form style="padding-left:12px" name="forma" method="post" id="poll-view">
		   <div align='center' class="user-backdrop"></div>
			<div align='center' class="user-content">
<?php
include('function/konekcija.inc');
$pitanje=" SELECT id_ankete,pitanje FROM ankete WHERE aktivna=1";
$rez1=mysql_query($pitanje,$konekcija) or die("Upit 1 nije izvrsen!".mysql_error());
$niz1=mysql_fetch_array($rez1);echo"<table>";
echo'<tr><td>'.$niz1['pitanje'].'</td></tr>';
$upit=" SELECT odgovori,id_odgovori FROM odgovori o,ankete a WHERE a.aktivna=1 AND a.id_ankete=o.id_ankete";
$rez=mysql_query($upit,$konekcija) or die ("Upit 2 nije izvrsen!".mysql_error());
while($niz=mysql_fetch_array($rez))
{
echo"<tr><td align='center' ><input type='radio'  id='odgovori' name='odgovori' value=".$niz['id_odgovori'].">&nbsp".$niz['odgovori']."</td></tr>";
}
echo"</table>";
echo "<tr><tr align='center' ><input type='submit' class='change' name='glasaj' value='Vote'>&nbsp</td></tr>";
echo "<tr><tr align='center' ><input type='submit' class='change' name='rez' value='Count'></td></tr>";



$glasanje=&$_POST['glasaj'];
$rezultati=&$_POST['rez'];
if(isset($glasanje))
{
$odgovor=&$_POST['odgovori'];
$upisi_odgovor=' UPDATE rezultat SET rezultat=rezultat+1 WHERE id_odgovori='.$odgovor;
$izvrsi_upisi_odgovor=mysql_query($upisi_odgovor,$konekcija) or die ("Pick one!");
if($izvrsi_upisi_odgovor)
{
echo'<br/>You have voted!<br>';
}
else{
echo 'Pick one!';
}
}
if(isset($rezultati)){
$rezultati="SELECT * FROM ankete WHERE aktivna=1";
$izvrsi_rezultati=mysql_query($rezultati, $konekcija) or die("Upit 4 nije
izvršen!".mysql_error());
$red=mysql_fetch_array($izvrsi_rezultati);
$id=$red['id_ankete'];
echo '<table>';
echo '<tr><td>'.$red['pitanje'].'</td></tr>';
$odgovori = "SELECT o.odgovori, r.rezultat FROM odgovori o, rezultat r WHERE o.id_odgovori =
r.id_odgovori AND r.id_ankete =".$id;
$uzmi_odgovore = mysql_query($odgovori) or die(mysql_error());
while($red=mysql_fetch_array($uzmi_odgovore))
{echo '<tr><td>'.$red['odgovori'].'</td><td>'.$red['rezultat'].'</td></tr><br/>';}
echo '</table>';
}
mysql_close($konekcija);

?>
</div></form>
            <div id="rezultat"></div>
               
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