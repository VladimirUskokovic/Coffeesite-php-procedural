<?php
	@session_start();
	
	if(isset($_SESSION['kor_ime'])){
		header("Location: index.php");
	}
	
	if(isset($_REQUEST['btnLogovanje']))
	{
		$korIme = trim($_REQUEST['UserName']);
		
		$lozinka = md5(trim($_REQUEST['Password']));
		
		
		$upit = "SELECT * FROM korisnici k
				JOIN uloge u
				ON k.id_uloge=u.id_uloge
				WHERE k.username='$korIme'
				AND k.lozinka='$lozinka'";
				
		include('function/konekcija.inc');
		
		$rez = mysql_query($upit, $konekcija);
		
		$greske = array();
		
		if(mysql_num_rows($rez) == 0)
		{
			$greske[] = "Doslo je greske prilikom logovanja!";
			
		}
		else
		{
			$r = mysql_fetch_array($rez);
			
			$_SESSION['kor_ime'] = $r['username'];
			
		//	$x = $_SESSION['kor_ime'];
			
			
			$_SESSION['nu'] = $r['naziv_uloge'];
			
			$_SESSION['idU'] = $r['id_uloge'];
			
			
			switch($_SESSION['nu'])
			{
				case 'admin':
					header('Location: index.php');
					break;
				case 'korisnik':
					header('Location: index.php');
					break;
			}
			include('function/zatvori.inc');
			
			
		}
		
		
		
		
		
		
		
		
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
		<script src="js/libs/jquery.min.js"></script>
		
		<script type="text/javascript">
				$(document).ready(function($){
					$("#login").hover(function(){
						$(this).css("background-color","#c74c00");
					},
					function(){
						$(this).css("background-color","#ff6000");
					});
					
				});
				
				$(document).ready(function($){
					$("a.reg").hover(function(){
						$(this).css("background-color","#c74c00");
					},
					function(){
						$(this).css("background-color","#ff6000");
					});
					
				});
		</script>
		
	</head>
	<body>
		
		<div id="container">
			<form id="loginForm" class="" role="form" method="post"  >

			<div class="form-backdrop"></div>
			<div class="form-content">
				<a href="index.php"><img src="img/log.png" ></img></a>
				<input id="UserName" class="form-control" type="text" placeholder="User Name" name="UserName" autofocus=""></input>
				<br/>
				<input id="Password" class="form-control" type="password" placeholder="Password" name="Password"></input>
				<br/>
				<br/>
				<input id="login"  type="submit" value="Log in" name="btnLogovanje"></input>
				<br/>
				<br/>
				<div class="link">
					
					<a class="reg" href="register.php">

						Sign up!

					</a>
		
					
				</div>
				
			</div>

			</form>
		</div>
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