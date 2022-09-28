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

            //Comprueba si el nombre introducido esta en base de datos.
            if ($nom == $nom_usuari) {

                $conti = true;

                if ($admin == "TRUE") {

                    echo 'Aquest usuari és administrador.<br>';
                    echo '<br>';

                    echo '<a href="aplicacion.php"><button>Torna a la aplicacio</button></a>';
                    exit();
                }
            }
        }

        //En caso que el nombre introducido no esta en la base de datos.
        if ($conti == false) {

            echo 'El nom introduït no és correcte. O no existeix.';

            echo '<a href="afegirPermis.php"><button>Intenta-ho de nou</button></a><br>';
            echo '<br>';

            echo '<a href="inici.php"><button>Torna a inici</button></a>';
            exit();
        }

        //setencia (update set)
        $sentenciaSql = "UPDATE crendenciales SET administrador = 'TRUE'
        WHERE nom_usuari = '$nom'";

        //Fem la consulta a la base de dades per inserta el regsistro
        $consulta = mysqli_query($connexio, $sentenciaSql);

        if ($consulta == TRUE) {
            echo "L'usuari ha esdevingut administrador.<br>";
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
