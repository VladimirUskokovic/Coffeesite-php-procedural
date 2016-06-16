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
						<div id="edituser">
						<?php
							include('function/konekcija.inc');
							if(isset($_GET['edit'])){
							$id=$_GET['edit'];
							$query="SELECT naziv, sastav, cena FROM katalog WHERE id_katalog=".$id;
							if($data=mysql_query($query,$konekcija)){
							while($row=mysql_fetch_row($data)){

$naziv=@$row[0];
$sastav=@$row[1];
$cena=@$row[2];


$site_page="menu_edit.php?edit=".$id;
}
}
else {die("Neuspešno dohvatanje podataka!");}
}
?>
<form action="<?php echo $site_page; ?>" id="edit-user" method="post">
<div class="user-backdrop"></div>
<div class="user-content">
<h3>Change Article <span style="color: #fbb700;"><b><?php echo @$naziv;
?></b></style></h3>
<table>
<tr>
<td>
<input type="text" placeholder="Name" name="name" value="<?php echo $naziv; ?>" />
</td>
</tr>
<tr>
<td>
<input type="text" placeholder="Content" name="content" value="<?php echo $sastav; ?>" />
</td>
</tr>
<tr>

<tr>
<td>
<input type="text" placeholder="Price" name="price" value="<?php echo
$cena; ?>" />
</td>
</tr>
<tr><td>Chocolate</td></tr>
<tr>
<td>
&nbsp <input type="radio" name="rbcho" value="Yes" /> Yes <br/>
<input type="radio" name="rbcho" value="No" /> No <br/>
</td>
</tr>

<tr>
<td colspan="2">
<input type="reset" class="change" value="Reset" />
<input type="submit" class="change" name="edituser_btn"
value="Change" />
</td>
</tr>
</table>
</form></div>
<?php
if(isset($_POST['edituser_btn'])){
$name=trim(@$_POST['name']);
$content=trim(@$_POST['content']);
$price=trim(@$_POST['price']);
$choco=trim(@$_POST['rbcho']);
$query1="UPDATE katalog
SET
naziv=\"$name\",
sastav=\"$content\",
cena=\"$price\",
cokolada=\"$choco\"

WHERE id_katalog=".$id;

if(mysql_query($query1,$konekcija)){
echo "<p style=\"text-align: center;\"><span
class=\"sucess_msg\">Uspešno ste izmenili podatke za proizvod!</span><br />";
echo "Bićete vraćeni na stranicu sa katalogom za 3 sekundi.</p>";
$refresh_time=3000; # msec
$refresh_to="changemenu.php"; # absolute link
echo "<script type=\"text/javascript\">setTimeout(function(){window.location.replace(\"$refresh_to\");},$refresh_time);</script>";
}
else{
echo "<p style=\"text-align: center;\"><span
class=\"sucess_msg\">Neuspešna izmena podataka za korisnika!</span><br />";
echo mysql_error($konekcija);
}
}
?>
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