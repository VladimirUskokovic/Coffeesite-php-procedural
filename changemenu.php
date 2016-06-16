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
								<th>Context</th>
								<th>Price</th>
								<th>Chocolate</th>
								<th>Change</th>
								<th>Delete</th>
								</thead>
								
								<?php
								include("function/konekcija.inc");
								# menu listing
								$query="SELECT * FROM katalog";
								$data=mysql_query($query,$konekcija);
								if($data){
									while($row=mysql_fetch_array($data,MYSQLI_ASSOC)){
									if($row['cokolada']=='yes') $is_cho="<img src=\"img/yes.png\"	height='20px'  width='20px' alt=\"\" />";									else $is_cho="<img src=\"img/no.png\" height='20px'  width='20px' alt=\"\" />";
									$menu_edit="menu_edit.php?edit=".@$row['id_katalog'];
									$menu_del="changemenu.php?menu_del=".@$row['id_katalog'];
									echo "<tr>";
									echo "<td>".$row['id_katalog']."</td>";
									echo "<td>".$row['naziv']."</td>";
									echo "<td>".$row['sastav']."</td>";
									echo "<td>$".$row['cena']."</td>";
									echo "<td>$is_cho</td>";
									echo "<td><a href=\"$menu_edit\"><img height='20px'  width='20px' src=\"img/edit.png\"/></a></td>";
									echo "<td><a href=\"$menu_del\" onclick=\"return confirm_menu_del();\"><img height='20px'  width='20px' src=\"img/no.png\" /></a></td>";
									echo "</tr>";
									}
									}
									else die("Neuspešno dohvatanje podataka!");
									
									?>
									</table>
									
									<?php
									
									# menu delete
									if(isset($_GET['menu_del'])){
									$id=$_GET['menu_del'];
									$query="DELETE FROM katalog WHERE id_katalog=".$id;
									if(mysql_query($query,$konekcija)){
									echo "<p style=\"text-align: center;\"><span class=\"sucess_msg\">You are successfully deleted article!<span style=\"color: #fbb700;\"></span>!</span><br />";
									echo "Refresh page after 3 seconds.</p>";
									$refresh_time=3000; # msec
									$refresh_to="changemenu.php"; # absolute link
									echo "<script type=\"text/javascript\">setTimeout(function(){window.location.replace(\"$refresh_to\");},$refresh_time);</script>";
									}
									else{
									echo "<p style=\"text-align: center;\"><span class=\"sucess_msg\">Task isn't execute!</span><br />";
									}
									}
									?>
									<!--END CONTENT-->
									<script type="text/javascript">
									function confirm_menu_del(){
									if(confirm("Are you sure want to delete this article?")) return;
									else return false;
									}
									</script>
									<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="add-user" method="post">
									<div class="user-backdrop"></div>
									<div class="user-content">
									<h3>Create article</h3>
									<table>
									<tr>
									
									<td>
										<input type="text" name="name" placeholder="Name" />
									</td>
									</tr>
									
									<tr>
									
									<td>
										<input type="text" name="context" placeholder="Context" />
									</td>
									</tr>
									<tr>
									
									<td>
									<input type="text" name="price" placeholder="Price"/>
									</td>
									</tr>
									<tr><td>Chocolate</td></tr>
									<tr>
									<td>
									&nbsp<input type="radio" name="rbcho" value="Yes" /> Yes <br/>
									<input type="radio" name="rbcho" value="No" /> No <br/>
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
									$name=strtolower(trim(@$_POST['name']));
									$context=trim(@$_POST['context']);
									$price=trim(@$_POST['price']);
									$rbcho=trim(@$_POST['rbcho']);
									$regprice="/^[^A-Za-z]{1,}$/";
									if(!preg_match($regprice,$price))
									{
										echo " Price must be a number!";
									}
									else{
									$query="INSERT INTO katalog VALUES('','$name','$context','$price','$rbcho')";
									if(mysql_query($query,$konekcija)){
									echo "<p style=\"text-align: center;\"><span class=\"sucess_msg\">You are successfully create article!</span><br />";
									echo "Page refresh after 3 seconds.</p>";
									$refresh_time=3000; # msec
									$refresh_to="changemenu.php"; # absolute link
									echo "<script type=\"text/javascript\">setTimeout(function(){window.location.replace(\"$refresh_to\");},$refresh_time);</script>";
									}
									else{
									echo "<p style=\"text-align: center;\"><span class=\"sucess_msg\">Failed!</span><br />";
									}
									}}
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