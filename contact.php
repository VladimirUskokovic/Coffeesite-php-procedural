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

		<script type="text/javascript">

			function poruka(){
					
					var ime=document.getElementById("tbName").value;
					var mail = document.getElementById("tbEmail2").value;
					var sadrzaj=document.getElementById("taMessage").value;
					
					var reg_ime=/^[A-Z][a-z]{1,14}$/;
					var reg_mail=/^[_a-z0-9]+(.[_a-z0-9]+)*@[a-z0-9]+(.[a-z0-9]+)*(.[a-z]{2,3})$/;
					var poruka=true;

					if(!reg_ime.test(ime)){
					document.getElementById('greska_ime').innerHTML="<br/>Niste lepo napisali ime !!";
					poruka=false;
					}
					if(!reg_mail.test(mail)){
					document.getElementById('greska_mail').innerHTML=" <br/>Email adresa nije napisana u ispravnom formatu !!";
					poruka=false;
					}
					if(sadrzaj=="")
					{
					document.getElementById('greska_poruka').innerHTML="<br/>Niste napisali poruku!!";
					poruka=false;
					}
					return poruka;
					}
					</script>
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
							<h1>Contact</h1>
							<br/>
							
						</div>
						
							<form id="contactForm" class="" role="form" method="post" onSubmit="return poruka();" >

									<div class="form-backdrop"></div>
									<div class="form-content">
									
									<input id="tbName" class="form-control" type="text" placeholder="Name" name="tbName" autofocus=""></input>
									
									<span id="greska_ime"></span>
									<br/>
									
									<input id="tbEmail2" class="form-control" type="text" placeholder="Email" name="tbEmail2"></input>
									
									<span id="greska_mail"></span>
									<br/>
									<textarea id="taMessage" class="form-control" name="taMessage" cols="18" rows="10" placeholder="Message"></textarea>
									
									<span id="greska_poruka"></span>
									<br/>
									
									<input id="send"  type="submit" value="Send" name="btnSend" onClick="poruka();"></input>
									<br/>
									
									
									
				
								

									</form>
							<?php
									
									$dugme=@$_REQUEST['btnSend'];
									
									if(isset($dugme)){
									
									$ime=$_POST['tbName'];
									$mail=$_POST['tbEmail2'];
									$sadrzaj=$_POST['taMessage'];
										
									$posiljalac="From: ".$mail;
									$reg_ime="/^[A-Z][a-z]{1,14}$/";
									$reg_mail="/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/";
									$greske=array();
									
									if(!preg_match($reg_ime,$ime)){
									$greske[]="Niste lepo napisali ime !!";
									}
									
									if(!preg_match($reg_mail,$mail)){
									$greske[]="E-mail adresa nije napisana u ispravnom formatu !!";
									}
									if($sadrzaj==""){
									$greske[]="Niste uneli poruku!!";
									}
									if(count($greske)>0){
									print "<ul style='color:red;'>";
									foreach($greske as $greska){
									print "<li>".$greska."</li>";
									}
									print "</ul>";
									}
									else{
									$kome="vladimir.uskokovic.324.13@ict.edu.rs.";
									$naslov="Pitanje";
									$headers = 'From: '.$mail.'.com' . "\r\n" .
    'Reply-To: '.$mail.'' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
									mail($kome,$naslov,$sadrzaj,$headers);
									echo "Your message was sent successfully, thanks!";
									}
									
									

									}
								?>
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