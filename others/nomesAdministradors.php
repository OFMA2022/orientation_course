<?php
//iniciem sessió
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

        //Solo para los administradores 
        if ($_SESSION["admin"] == "TRUE") {

            echo '<a href="crearUsuari.php"><button>Crear nou usuari</button></a><br>';
            echo '<br>';

            echo '<a href="modificarUsuari.php"><button>Modificar usuari</button></a><br>';
            echo '<br>';

            echo '<a href="eliminarPerAdmin.php"><button>Eliminar usuari</button></a><br>';
            echo '<br>';

            echo '<a href="afegirPermis.php"><button>Promoure usuari</button></a><br>';
            echo '<br>';

            echo '<hr>';
            echo '<a href="aplicacion.php"><button>Torna a la aplicació</button></a>';
        } else {
            echo 'Només els administradors.<br>';
            echo '<br>';

            echo '<a href="aplicacion.php"><button>Torna a la aplicació</button></a>';
            exit();
        }
    } else {
        echo "No s'ha produit la consulta: " . mysqli_error($connexio);
    }
    mysqli_close($connexio);
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>sin título</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>

<body>

</body>

</html>