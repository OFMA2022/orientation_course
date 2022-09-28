<?php

//Iniciem sessió.
session_start();

//iniciem la connexio
$connexio = mysqli_connect("localhost", "root", "", "usuari");

if (mysqli_connect_errno()) {

    echo "Connexió fallida: " . mysqli_connect_error();
    exit();
} else {

    $sentenciaSQL = "SELECT * FROM crendenciales";

    $consulta = mysqli_query($connexio, $sentenciaSQL);

    if ($consulta) {

        while ($vectorRegistres = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
            $nom_usuari = $vectorRegistres["nom_usuari"];  //nom del usuari
            $contrasenya = $vectorRegistres["contrasenya"];  //contrasenya del usuari
            $admin = $vectorRegistres["administrador"]; //Valor del admin

            //Comprarcion los datos existente
            if ($_SESSION["usuari"] == $nom_usuari && $_SESSION["contrasenya"] == $contrasenya) {

                echo "Estàs segur que vols eliminar el teu usuari.<br>";
                echo '<br>';

                echo '<a href="eliminarUsuari2.php"><button>SI</button></a><br>';
                echo '<br>';

                echo '<a href="aplicacion.php"><button>NO</button></a><br>';
                exit();

            }
        }
    }
}

?>

<!DOCTYPE html>
<html>

<body>

</body>

</html>