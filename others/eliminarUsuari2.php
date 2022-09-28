<?php

//Iniciem sessió.
session_start();

//iniciem la connexio
$connexio = mysqli_connect("localhost", "root", "", "usuari");

$usuari = $_SESSION["usuari"];

if (mysqli_connect_errno()) {

    echo "Connexió fallida: " . mysqli_connect_error();
    exit();
} else {

    $sentenciaSQL = "DELETE FROM crendenciales WHERE nom_usuari = '$usuari'";

    $consulta = mysqli_query($connexio, $sentenciaSQL);

    if ($consulta === TRUE) {
        echo "El usuari s'ha borrat correctament.<br>";
        echo '<br>';

        echo '<a href="inici.php"><button>Torna a inici</button></a>';
        exit();
    } else {
        echo "El usuari No s'ha borrat: " . mysqli_error($connexio);
    }
    mysqli_close($connexio);
}
