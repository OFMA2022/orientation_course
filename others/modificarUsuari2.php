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

        $conti = false;

        while ($vectorRegistres = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
            $nom_usuari = $vectorRegistres["nom_usuari"];  //nom del usuari
            $contrasenya = $vectorRegistres["contrasenya"];  //contrasenya del usuari
            $admin = $vectorRegistres["administrador"]; //Valor del admin

            //Comprobación del nombre de usuario "existente" 
            if ($_POST["nomE"] == $nom_usuari) {

                $conti = true;

                //Para la comprobacion de los USUARIOS NORMALES y USUARIOS ADMINS
                /** Los usuarios normales tienen restricciones de modificar otros usuarios tanto normales y administraciones */
                /** Los usuarios administraciones tienen privilegios de modificar solo los usuraios normales  */

                if ($_SESSION["usuari"] != $_POST["nomE"] && ($_SESSION["admin"] == "FALSE" || $admin == "TRUE")) {

                    echo 'No podeu modificar altres usuaris. O les dades existents introduïdes no són correctes.<br>';
                    echo '<br>';

                    echo '<a href="modificarUsuari.php"><button>Intenta-ho de nou</button></a><br>';
                    echo '<br>';

                    echo '<a href="aplicacion.php"><button>Torna a la aplicacio</button></a>';
                    exit();
                }
            }


            //Comparacion de los NUEVOS DATOS introducido
            if ($_POST["nomN"] == $nom_usuari && $_POST["contraN"] == $contrasenya) {

                echo "Avís de seguretat: No es poden modificar
                dades d'usuaris amb les mateixes dades,
                 o ja existeix a les bases de dades.<br>";

                echo '<br>';

                echo '<a href="modificarUsuari.php"><button>Intenta-ho de nou</button></a><br>';
                echo '<br>';


                echo '<a href="inici.php"><button>Torna a inici</button></a>';
                exit();
            }
        }

        if ($conti == false) {

            echo 'Les dades existents introduïdes no són correctes.<br>';
            echo '<br>';

            echo '<a href="modificarUsuari.php"><button>Intenta-ho de nou</button></a><br>';
            echo '<br>';

            echo '<a href="aplicacion.php"><button>Torna a la aplicacio</button></a>';
            exit();
        }


        $usuariNou = $_POST["nomN"];
        $contraNou = $_POST["contraN"];
        $adminNou = "FALSE";

        $usuariExistent = $_POST["nomE"];
        $contraExistent = $_POST["contraE"];
        $adminExistent = "FALSE";

        $sentenciaSql = "UPDATE crendenciales SET nom_usuari = '$usuariNou', contrasenya = '$contraNou'
        WHERE nom_usuari = '$usuariExistent'";

        //Fem la consulta a la base de dades per inserta el regsistro
        $consulta = mysqli_query($connexio, $sentenciaSql);

        if ($consulta == TRUE) {

            echo "Els dades s'ha modificat correctament!!<br>";

            //Guardem els nous dades en sessio
            $_SESSION["usuari"] = $_POST["nomN"];
            $_SESSION["contrasenya"] = $_POST["contraN"];
            $_SESSION["admin"] = $adminNou;

            echo '<a href="inici.php"><button>Torna a inici</button></a>';
        } else {
            echo "Els dades no s'ha modificat correctament: " . mysqli_error($connexio);
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