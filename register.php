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
				
				function provera(){
					
					
					var name=document.getElementById("tbName").value;
					var surname=document.getElementById("tbSurname").value;
					var email = document.getElementById("tbEmail").value;
					var username=document.getElementById("tbUserName").value;
					var password=document.getElementById("tbPassword").value;
					var repeatpassword=document.getElementById("tbRepeatPassword").value;
					
					
					var reg_name=/^[A-Z][a-z]{1,14}$/;
					var reg_email=/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/;
					var reg_username=/^[a-z0-9\_]+$/;
					var reg_password=/[^\/.,<>:;*?A-Z]$/;

					var provera=true;
					
					if(!reg_ime.test(name)){
document.getElementById('greska_ime').innerHTML="<br/>Niste lepo napisali ime !!";
provera=false;
}
if(!reg_ime.test(surname)){
document.getElementById('greska_prezime').innerHTML="<br/>Niste lepo napisali prezime !!";
provera=false;
}
if(!reg_mail.test(email)){
document.getElementById('greska_mail').innerHTML=" <br/>Email adresa nije napisana u ispravnom formatu !!";
provera=false;
}
if(!reg_username.test(username)){
document.getElementById('greska_username').innerHTML="<br/>Za username se mogu koristiti samo mala slova, brojevi i _ !!!";
provera=false;
}
if(!reg_password.test(password)){
document.getElementById('greska_password').innerHTML="<br/> Za lozinku se mogu koristiti samo mala slova i brojevi !!";
provera=false;
}
return provera;
}
</script>
		<script src="js/libs/jquery.min.js"></script>
		
		<script type="text/javascript">
				$(document).ready(function($){
					$("#registar").hover(function(){
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
			<form id="loginForm"  role="form" method="post"  onSubmit="return provera();">

			<div class="form-backdrop"></div>
			<div class="form-content">
					<a href="index.php"><img src="img/log.png" ></img></a>
					<input id="tbName" class="form-control" type="text" placeholder="Name" name="tbName" autofocus=""></input>
					<span id="greska_ime"></span>
					<br/>
					<input id="tbSurname" class="form-control" type="text" placeholder="Surname" name="tbSurname"></input>
					<span id="greska_prezime"></span>
					<br/>
					<input id="tbUserName" class="form-control" type="text" placeholder="User Name" name="tbUserName" ></input>
					<span id="greska_mail"></span>
					<br/>
					<input id="tbEmail" class="form-control" type="text" placeholder="Email" name="tbEmail"></input>
					<span id="greska_username"></span>
					<br/>
					<input id="tbPassword" class="form-control" type="password" placeholder="Password" name="tbPassword" ></input>
					<span id="greska_password"></span>
					<br/>
					<input id="tbRepeatPassword" class="form-control" type="password" placeholder="Repeat Password" name="tbRepeatPassword"></input>
					<span id="greska_password"></span>
					<br/>
					<br/>
					<input id="registar" type="submit" value="Register" name="register"onClick="provera();"></input>
					</br>
					<?php
$dugme=@$_POST['register'];
if(isset($dugme)){
$ime=$_POST['tbName'];
$prezime=$_POST['tbSurname'];
$mail=$_POST['tbEmail'];
$username=$_POST['tbUserName'];
$password=md5($_POST['tbPassword']);
$reg_ime="/^[A-Z][a-z]{1,14}$/";
$reg_mail="/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/";
$reg_username="/^[a-z0-9\_]+$/";
$reg_password="/[^\/.,<>:;*?A-Z]$/";
$greske=array();
if(!preg_match($reg_ime,$ime)){
$greske[]="Niste lepo napisali ime !!";
}
if(!preg_match($reg_ime,$prezime)){
$greske[]="Niste lepo napisali prezime!!";
}
if(!preg_match($reg_mail,$mail)){
$greske[]="E-mail adresa nije napisana u ispravnom formatu !!";
}
if(!preg_match($reg_username,$username)){
$greske[]="Za username se mogu koristiti samo mala slova, brojevi i _ !!!";

}
if(!preg_match($reg_password,$password)){
$greske[]="Za lozinku se mogu koristiti samo mala slova i brojevi !!";
}
if(count($greske)>0){
print "<br/><ul style='color:white;'>";
foreach($greske as $greska){
print "<li>".$greska."</li>";
}
print "</ul>";
}
else{
include_once('function/konekcija.inc');
$upit="insert into korisnici values('','$ime','$prezime','$username','$mail','$password',2)";
$rezultat=mysql_query($upit,$konekcija);
}
if(@$rezultat){echo "Uspesno ste se registrovali!";}

}
?> 
				
					
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