
var xmlHttp = null;

function prikaziRezultat(value) {
    xmlHttp = GetXmlHttpObject(); // kreira request i vraća objekat

    if (xmlHttp == null) {
        alert("Browser ne podrzava HTTP request");
        return;
    }
    
    var url = "prikazirezultat.php";
    url=url+"value="+value;
    xmlHttp.onreadystatechange = izvucirezultat;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
    
    function izvucirezultat() {
	    if (xmlHttp.readyState == 4) { 
	    	
	    	
	    	
	        document.getElementById("rezultat").innerHTML = xmlHttp.responseText;
	    }
    }
}
