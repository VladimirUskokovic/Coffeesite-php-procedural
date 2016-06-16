<div class="bazingaMake990">
    		<div id="bazingaLogoContainer">
	    	<div id="bazingaLogo"><a href="index.php" title="Coffeesite"></a></div>
	    	</div>
	    	
	    	<?php
				include("function/konekcija.inc");
				
				$dinMeniupit = "SELECT * FROM din_meni";
				
				$rezmeni = mysql_query($dinMeniupit,$konekcija) or die("Greska prilikom iscitavanja galerija!");
				
				echo "<ul id='bazingaMenu'>";
				while($rm=mysql_fetch_array($rezmeni))
				{
					echo "<li class=".$rm['klasa']."><a href=".$rm['link']." title=".$rm['naziv']."></a></li>";
				}
				echo "</ul>";
				
				include("function/zatvori.inc");
			?>
	    	
			
			
			
			
			