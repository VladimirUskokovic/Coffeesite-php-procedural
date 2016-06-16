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
							$query="SELECT ime, prezime, username, email, lozinka, id_uloge FROM korisnici WHERE id_korisnici=".$id;
							if($data=mysql_query($query,$konekcija)){
							while($row=mysql_fetch_row($data)){

$name=@$row[0];
$surname=@$row[1];
$user_name=@$row[2];
$user_email=@$row[3];
$password=@$row[4];
$admin=@$row[5];

$site_page="user_edit.php?edit=".$id;
}
}
else {die("Neuspešno dohvatanje podataka!");}
}
?>
<form action="<?php echo $site_page; ?>" id="edit-user" method="post">
<div class="user-backdrop"></div>
<div class="user-content">
<h3>Change User <span style="color: #fbb700;"><b><?php echo @$user_name;
?></b></style></h3>
<table>
<tr>
<td>
<input type="text" placeholder="User Name" name="user_name" value="<?php echo $user_name; ?>" />
</td>
</tr>
<tr>
<td>
<input type="password" placeholder="Password" name="password" value="<?php echo $password; ?>" />
</td>
</tr>
<tr>
<td>
<input type="email" name="email" placeholder="Email" value="<?php echo
$user_email; ?>" />
</td>
</tr>
<tr>
<td>
<input type="text" placeholder="Name" name="name" value="<?php echo
$name; ?>" />
</td>
</tr>
<tr>
<td>
<input type="text"  placeholder="Surname" name="surname" value="<?php echo
$surname; ?>" />
</td>
</tr>
<tr>
<td>
<select name="admin">
<?php
echo "<option
value=\"0\">Acount type</option>";
echo "<option
value=\"1\">Administrator</option>";
echo "<option
value=\"2\">Regular</option>";

?>
</select>
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
$user_name=strtolower(trim(@$_POST['user_name']));

$email=strtolower(trim(@$_POST['email']));
$name=trim(@$_POST['name']);
$surname=trim(@$_POST['surname']);
$admin=trim(@$_POST['admin']);
if(strlen(@$_POST['password'])>0){
$password1=md5($_POST['password']);
$query1="UPDATE korisnici
SET
ime=\"$name\",
prezime=\"$surname\",
username=\"$user_name\",
email=\"$email\",
lozinka=\"$password1\",
id_uloge=$admin
WHERE id_korisnici=".$id;
}
else{
$query1="UPDATE korisnici
SET
ime=\"$name\",
prezime=\"$surname\",
username=\"$user_name\",
email=\"$email\",
id_uloge=$admin
WHERE id_korisnici=".$id;
}
if(mysql_query($query1,$konekcija)){
echo "<p style=\"text-align: center;\"><span
class=\"sucess_msg\">Uspešno ste izmenili podatke za korisnika!</span><br />";
echo "Bićete vraćeni na stranicu sa korisnicima za 3 sekundi.</p>";
$refresh_time=3000; # msec
$refresh_to="changeusers.php"; # absolute link
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