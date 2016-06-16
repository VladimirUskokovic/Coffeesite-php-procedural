<?php
			@session_start();
			
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" href="css/stil.css">
  <link rel="stylesheet" href="css/supersized.css" media="screen" />  
  <link rel="stylesheet" href="css/jquery.jscrollpane.css" media="screen" />
  <link rel="stylesheet" href="js/mylibs/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
  <!-- end CSS-->

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
				
				<div class="bazingaThinColumnWidestPlus">
	    			<h1>GALLERY</h1>
	    			    		
	    		</div>
	    		<br />
				
				<section id="bazingaGallery">
					<ul>
							<?php
							include("function/konekcija.inc");
							$koliko_po_strani = 4;
							if(@$_GET['skriveno']) {$skriveno = $_GET['skriveno'];}
							else {$skriveno = 0;}
							
							$upitstrana = mysql_query("SELECT count(id_galerija) from galerija");
							$niz = mysql_fetch_array($upitstrana);
							$ukupno_zapisa = $niz[0];
							$levo = $skriveno - $koliko_po_strani;
							$desno = $skriveno + $koliko_po_strani;
							$rezultat = mysql_query("SELECT * FROM galerija LIMIT $koliko_po_strani OFFSET
								$skriveno ",$konekcija);
							while($niz1 = mysql_fetch_array($rezultat))
								{
									echo "<li><a class='fancybox' rel='galeria' href=".$niz1['putanja_velika']."><img src=".$niz1['putanja_mala']."></a></li>";
								}
							echo "</ul>";
							if($levo<0)
								{								
									echo ("<a href=\"gallery.php?skriveno=$desno\"><img src='gallery/arrow-right.png' width='50px' height='50px'/></a>");
								}
							elseif($desno > $ukupno_zapisa)
								{
									echo (" <a href=\"gallery.php?skriveno=$levo\"><img src='gallery/arrow-left.png' width='50px' height='50px'/></a>");
								}
							else 
								{
									echo "<a href=\"gallery.php?skriveno=$levo\"><img src='gallery/arrow-left.png' width='50px' height='50px'/></a>";
									echo "<a href=\"gallery.php?skriveno=$desno\"> <img src='gallery/arrow-right.png' width='50px' height='50px'/> </a>";
								}
								
								
									include("function/zatvori.inc");
							?>
					
				</section>
	    		
    			

    		</div><!--bazingaContentInner-->  			  			    	    
		</div>
    </div>
        
  </div> <!--! end of #container -->

    <nav id="bazingaMenuContainer">    
	    	
	    				<?php
				include("menu.php");
			?>
			<div class="bazingaClear"></div>
			<?php
				include("footer.php");
			?>
    </nav>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>

  <script type="text/javascript" src="js/mylibs/supersized.3.1.3.min.js"></script>
  <script type="text/javascript" src="js/mylibs/jquery.mousewheel.js"></script>
  <script type="text/javascript" src="js/mylibs/mwheelIntent.js"></script>
  <script type="text/javascript" src="js/mylibs/jquery.jscrollpane3.min.js"></script>
  <script type="text/javascript" src="js/mylibs/fancybox/jquery.easing-1.3.pack.js"></script>
  <script type="text/javascript" src="js/mylibs/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

  <!-- scripts concatenated and minified via ant build script-->
  <script defer src="js/plugins.js"></script>
  <script defer src="js/script.js"></script>
  <script src="js/background.js"></script>
  <script type="text/javascript">
  	
  	$(window).load(function() {
		$("a.fancybox").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false
	});
	
	});
	
  </script>
  <!-- end scripts-->




  
</body>
</html>
