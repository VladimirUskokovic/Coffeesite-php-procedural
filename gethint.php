<?php
// Array with names
include "function/konekcija.inc";

$sql = "SELECT naziv FROM katalog"; 
$result = mysql_query($sql,$konekcija); 


while(($row =  mysql_fetch_assoc($result))) {
    $a[] = $row['naziv'];
}

// get the q parameter from URL
@$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $naziv) {
        if (stristr($q, substr($naziv, 0, $len))) {
            if ($hint === "") {
                $hint = $naziv;
            } else {
                $hint .= ", $naziv";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "no suggestion" : $hint;
?>







