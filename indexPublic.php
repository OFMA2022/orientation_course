<?php
session_start();

//Connexio con bases de datos
//$connexio = mysqli_connect("localhost", "root", "", "orientation_course");
$connexio = mysqli_connect("localhost", "id19596923_root", "Mtr@ore2001good", "id19596923_goodhands");

if (mysqli_connect_errno()) {

    echo "Connexió fallida: " . mysqli_connect_error();
    exit();
} else {

    $sentenciaSQL = "SELECT * FROM equip";

    //Consulta en la bases de datos.
    $consulta = mysqli_query($connexio, $sentenciaSQL);

    if ($consulta) {

        $conti = false;

        while ($vectorRegistres = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {

            //Obtengo todos los datos de la tabla equip en los variables
            $id_equip = $vectorRegistres["id_equip"];
            $nom_equip = $vectorRegistres["nom_equip"];
            $participants_equip = $vectorRegistres["participants_equip"];
            $codi_equip = $vectorRegistres["codi_equip"];

            //Comprovo si el codigo del equipo esta en la base de datos.
            if ($_POST["codi"] == $codi_equip) {

                $conti = true;

                $_SESSION["ultimAcces"] = time();
                
                $_SESSION["id_equip"] = $id_equip;
                $_SESSION["nom_equip"] = $nom_equip;
                $_SESSION["codi_equip"] = $codi_equip;
                
                header("location: cursa.php");
            }
        }

        if ($conti == false) {

            echo 'El codi del equip no existeix.<br>';
            echo '<br>';

            echo '<a href="eliminarCookies.php"><button>Torna a inici</button></a>';
            session_destroy();
            exit();
        }
    } else {
        echo "No s'ha produit la consulta: " . mysqli_error($connexio);
    }
}
