<?php

//Iniciem sessió.
session_start();

//Declaro esta variable '$conti' para guardar un booleano. Iniciada en 'false'
//Por si existen cookies en el navegador que me guarde 'true'
$conti = false;

//Averiguamos si existe cookies "USER" y "CONTRA" en el navegador.
if (isset($_COOKIE["USER"]) && isset($_COOKIE["CONTRA"])) {

	$conti = true;

	//Guardamos el valor de la variable '$conti' en la sesion que es "true".
	$_SESSION["conti"] = $conti;

	//Al averigua que existen cookies, nos lleva a la pagina 'autenticacion.php'. 
	header("Location: autenticacion.php");
}

//Guardamos el valor de la variable en sesion que es "false".
$_SESSION["conti"] = $conti;
