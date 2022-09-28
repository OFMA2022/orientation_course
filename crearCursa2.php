<?php
session_start();

//Connexio con bases de datos
//$connexio = mysqli_connect("localhost", "root", "", "orientation_course");
$connexio = mysqli_connect("localhost", "id19596923_root", "Mtr@ore2001good", "id19596923_goodhands");

if (mysqli_connect_errno()) {

    echo "Connexió fallida: " . mysqli_connect_error();
    exit();
} else {

    $sentenciaSQL = "SELECT * FROM fites";

    //Consulta en la bases de datos.
    $consulta = mysqli_query($connexio, $sentenciaSQL);

    //Consulto las filas de la tabla fites.
    $filas = mysqli_num_rows($consulta);

    if ($consulta) {

        //Guadamos la cantidad que fitas que introducio el usuario
        $quantitatFites = $_POST["quantitatFites"];

        //Estructura for --> Para generar las fites segun la cantidad que introducio el usurio.
        for ($i = 0; $i < $quantitatFites; $i++) {

            //generar valor del fita aleatori
            $valorAleatori = '123456789';
            $valorFita = substr(str_shuffle($valorAleatori), 0, 1);

            //generar codigo del fita aleatoriamente
            $codiAleatori = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $codiFita = substr(str_shuffle($codiAleatori), 0, 6);

            //Comprovo que la tabla 'fites' esta vacia.
            //Si esta vacia, primero genero una fita de punt(0), valor(0) y codi aleatori.
            if ($filas == 00) {

                //Hacemos la sentencial (insert into)
                $sentenciaSql = "INSERT INTO fites (id_fita,punt_fita,valor_fita,codi_fita)
                                 VALUE ('','0','0','$codiFita')";
                $filas++;
            } else {

                //Hacemos la sentencial (insert into)
                $sentenciaSql = "INSERT INTO fites (id_fita,punt_fita,valor_fita,codi_fita)
                                 VALUE ('',(SELECT MAX(punt_fita)
                                            FROM fites fs) + 1,'$valorFita','$codiFita')";
            }

            //Fem la consulta a la base de dades per inserta el regsistro
            $consulta = mysqli_query($connexio, $sentenciaSql);
        }

        //En el caso de que las fitas han sido generada correctamente.
        if ($consulta == TRUE) {

            echo "La cursa s'ha creat correctament!!<br>";

            echo '<br>';
            echo '<a href="aplicacion.php"><button>Torna a la aplicacio</button></a>';
            exit();
        } else {

            echo "La cursa no s'ha creat correctament: " . mysqli_error($connexio);
        }
    } else {
        echo "No s'ha produit la consulta: " . mysqli_error($connexio);
    }

    //mysqli_free_result($consulta);
    mysqli_close($connexio);
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Crear Cursa</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="shortcut icon" href="./Images/logo.ico">
</head>

</html>