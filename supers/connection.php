<?php

// newPDO: connectem amb la BD
$usuari="root";
$password="";    
$database ="bd_supers";
$host = "localhost";

try {
			
	$bd = new PDO('mysql:host='.$host.';dbname='.$database, 
                     $usuari, $password); 
        
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
	echo "No s'ha pogut connectar amb la Base de dades";
        echo $e->getMessage();
	exit;
}

?>
