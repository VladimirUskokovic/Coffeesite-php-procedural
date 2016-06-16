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
								<th>Surname</th>
								<th>User Name</th>
								<th>Email</th>
								<th>Administrator</th>
								<th>Change</th>
								<th>Delete</th>
								</thead>
								
								<?php
								include("function/konekcija.inc");
								# user listing
								$query="SELECT * FROM korisnici";
								$data=mysql_query($query,$konekcija);
								if($data){
									while($row=mysql_fetch_array($data,MYSQLI_ASSOC)){
									if($row['id_uloge']==1) $is_admin="<img src=\"img/yes.png\"	height='20px'  width='20px' alt=\"\" />";									else $is_admin="<img src=\"img/no.png\" height='20px'  width='20px' alt=\"\" />";
									$user_edit="user_edit.php?edit=".@$row['id_korisnici'];
									$user_del="changeusers.php?user_del=".@$row['id_korisnici'];
									echo "<tr>";
									echo "<td>".$row['id_korisnici']."</td>";
									echo "<td>".$row['ime']."</td>";
									echo "<td>".$row['prezime']."</td>";
									echo "<td>".$row['username']."</td>";
									echo "<td>".$row['email']."</td>";
									echo "<td>$is_admin</td>";
									echo "<td><a href=\"$user_edit\"><img height='20px'  width='20px' src=\"img/edit.png\"/></a></td>";
									echo "<td><a href=\"$user_del\" onclick=\"return confirm_user_del();\"><img height='20px'  width='20px' src=\"img/no.png\" /></a></td>";
									echo "</tr>";
									}
									}
									else die("Neuspešno dohvatanje podataka!");
									
									?>
									</table>
									
									<?php
									
									# user delete
									if(isset($_GET['user_del'])){
									$id=$_GET['user_del'];
									$query="DELETE FROM korisnici WHERE id_korisnici=".$id;
									if(mysql_query($query,$konekcija)){
									echo "<p style=\"text-align: center;\"><span class=\"sucess_msg\">Uspešno ste obrisali korisnika <span style=\"color: #fbb700;\"></span>!</span><br />";
									echo "Stranica će se osvežiti za 3 sekundi.</p>";
									$refresh_time=3000; # msec
									$refresh_to="changeusers.php"; # absolute link
									echo "<script type=\"text/javascript\">setTimeout(function(){window.location.replace(\"$refresh_to\");},$refresh_time);</script>";
									}
									else{
									echo "<p style=\"text-align: center;\"><span class=\"sucess_msg\">Niste obrisali korisnika!</span><br />";
									}
									}
									?>
									<!--END CONTENT-->
									<script type="text/javascript">
									function confirm_user_del(){
									if(confirm("Da li ste sigurni da želite da obrišete korisnika?")) return;
									else return false;
									}
									</script>
									<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="add-user" method="post">
									<div class="user-backdrop"></div>
									<div class="user-content">
									<h3>Create User</h3>
									<table>
									<tr>
									
									<td>
										<input type="text" name="user_name" placeholder="User Name" />
									</td>
									</tr>
									<tr>
								
									<td>
										<input type="password" name="password" placeholder="Password" />
									</td>
									</tr>
									<tr>
									
									<td>
										<input type="email" name="email" placeholder="Email" />
									</td>
									</tr>
									<tr>
									
									<td>
									<input type="text" name="name" placeholder="Name"/>
									</td>
									</tr>
									<tr>
									
									<td>
									<input type="text" name="surname" placeholder="Surname"/>
									</td>
									</tr>
									<tr>
									
									<td>
									<select name="admin">
									<option value="0">Acount type</option>
									<option value="1">Administrator</option>
									<option value="2">Regular</option>
									</select>
									</td>
									</tr>

									<tr>
									<td colspan="2">
									<input type="reset" class="change" value="Reset" />
									<input type="submit" class="change" name="adduser_btn" value="Add" />
									</td>
									</tr>
									</table>
									
									
									
									<?php
									# user add
									if(isset($_POST['adduser_btn'])){
									$user_name=strtolower(trim(@$_POST['user_name']));
									$password=trim(@$_POST['password']);
									$email=strtolower(trim(@$_POST['email']));
									$name=trim(@$_POST['name']);
									$surname=trim(@$_POST['surname']);
									$admin=trim(@$_POST['admin']);
									$password=md5($password);
									$query="INSERT INTO korisnici VALUES('','$name','$surname','$user_name','$email','$password','$admin')";
									if(mysql_query($query,$konekcija)){
									echo "<p style=\"text-align: center;\"><span class=\"sucess_msg\">Uspešno ste registrovali korisnika!</span><br />";
									echo "Stranica će se osvežiti za 3 sekundi.</p>";
									$refresh_time=3000; # msec
									$refresh_to="changeusers.php"; # absolute link
									echo "<script type=\"text/javascript\">setTimeout(function(){window.location.replace(\"$refresh_to\");},$refresh_time);</script>";
									}
									else{
									echo "<p style=\"text-align: center;\"><span class=\"sucess_msg\">Neuspešna registracija!</span><br />";
									}
									}
									?>
									</div>
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