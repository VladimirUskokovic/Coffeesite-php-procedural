<?php
	$greske = array();
	
	$konekcija = mysql_connect("localhost", "root", "");
	
	$izbor_baze = mysql_select_db("coffeebase", $konekcija);
	
	if(!$konekcija)
	{
		$greske[] = "Konekcija sa serverom baze podataka nije uspela!";
	}
	else
	{
		if(!$izbor_baze)
		{
			$greske[] = "Greska prilikom izbora baze!";
		}	
	}
	
	
	
	
	
	
	
	
	
?>