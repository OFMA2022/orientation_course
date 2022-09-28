<?php

session_start();

if (isset($_COOKIE["USER"]) && isset($_COOKIE["CONTRA"])) {

    //Eliminamos los datos del usuario 
    setcookie("USER", $_SESSION["usuari"], time() - 3600);
    setcookie("CONTRA", $_SESSION["contrasenya"], time() - 3600);
}

header("Location: index.php");
