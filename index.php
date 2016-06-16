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
						<div class="bazingaThinColumnWidest">
								<h1>CAFE</h1>
								
								<br/>
										<script>
function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script> <form>
<input type="text"  name="article" onkeyup="showHint(this.value)" placeholder=" Search for an article :)" style="background-color:black; padding:5px; border:1px solid #000; border-radius:5px; font-weight:bold; color:white; margin-left:0px;" size="30"><br/>
<p class="pretraga"  style="color:#fff; font-weight:bold;">Suggestions: <span id="txtHint"></span></p>
</form>
								</div>
								
								
							<p class="textp">Bazinga specializes in sourcing and roasting seasonal, stand-out coffees.  What we've learned from our coffee travels we've brought back to Chicago to offer our customers some enriching coffee wisdom that will not only leave you with the one-up on coffee knowledge to impress your friends with, but also a consistently tasty cup every morning.</p>
							

				
						
							
							
												
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
