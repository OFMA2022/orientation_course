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

        $nom = $_POST["nom"];
        $conti = false;

        while ($vectorRegistres = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
            $nom_usuari = $vectorRegistres["nom_usuari"];  //nom del usuari
            $contrasenya = $vectorRegistres["contrasenya"];  //contrasenya del usuari
            $admin = $vectorRegistres["administrador"]; //Valor del admin

            //Miramos si existe el usuario introducido.
            if ($nom == $nom_usuari) {

                $conti = true;

                //Comprobacion de NO poder eliminar UN ADMINISTRADOR.
                if ($_SESSION["usuari"] != $nom && $admin == "TRUE") {

                    echo 'Un administrador no pot suprimir un administrador.<br>';
                    echo '<br>';

                    echo '<a href="aplicacion.php"><button>Torna a la aplicacio</button></a>';
                    exit();
                }
            }
        }


        if ($conti == false) {
            echo "Les dades existents introduïdes no són correctes. O no existeix l'usuari introduït.<br>";
            echo '<br>';

            echo '<a href="eliminarPerAdmin.php"><button>Intenta-ho de nou</button></a><br>';
            echo '<br>';

            echo '<a href="inici.php"><button>Torna a inici</button></a>';
            exit();
        }

        $sentenciaSql = "DELETE FROM crendenciales WHERE nom_usuari = '$nom'";

        //Fem la consulta a la base de dades per inserta el regsistro
        $consulta = mysqli_query($connexio, $sentenciaSql);

        if ($consulta == TRUE) {
            echo "S'ha eliminat el usuari correctament<br>";
            echo '<br>';

            echo '<a href="inici.php"><button>Torna a inici</button></a>';
        } else {
            echo "No s'ha eliminat el usuari correctament: " . mysqli_error($connexio);
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