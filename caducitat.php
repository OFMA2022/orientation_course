<?php
        //iniciem sessió per comprovar el contingut de $_SESSIO. 
        session_start();
        
        //Mostrem $_SESSION. La variable $_SESSION no té contingut, ja que hem 
        //destruit la sessió en l'script què crida a aquest.
        print_r($_SESSION); 
        
        //Destruim de nou la sessió
        session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<title>Tancar Sessió</title>
</head>
    <body>
        <h3>La sessió ha caducat!!!</h3>
        <a href="index.php"><button>Torna a l'inici</button></a>
    </body>
</html>