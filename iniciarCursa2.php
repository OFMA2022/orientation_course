<?php
//iniciem sessió
session_start();

//Connexio con bases de datos
//$connexio = mysqli_connect("localhost", "root", "", "orientation_course");
$connexio = mysqli_connect("localhost", "id19596923_root", "Mtr@ore2001good", "id19596923_goodhands");

if (mysqli_connect_errno()) {

    echo "Connexió fallida: " . mysqli_connect_error();
    exit();
} else {

    $sentenciaSQL = "SELECT * FROM temps";

    //Consulta en la bases de datos.
    $consulta = mysqli_query($connexio, $sentenciaSQL);

    if ($consulta) {

        if ($_POST["iniCursa"]) {

            $temps = $_POST["iniCursa"];

            //Hacemos la sentencial (insert into a la tabla del equip)
            $sentenciaSql = "INSERT INTO temps(temps)
                VALUES ('$temps')";

            $consulta = mysqli_query($connexio, $sentenciaSql);

            if (!$consulta) {
                echo "No sha afegir el temps correctament a la bases de dades" . mysqli_error($connexio);
            }

            echo "Se ha registrat correctament la hora.<br>";

            echo '<br>';
            echo '<a href="aplicacion.php"><button>Torna a la aplicacio</button></a>';
            exit();
        } else {
            echo "NO se ha registrat correctament la hora.<br>";

            echo '<br>';
            echo '<a href="aplicacion.php"><button>Torna a la aplicacio</button></a>';
            exit();
        }
    } else {

        echo "No s'ha produit la consulta: " . mysqli_error($connexio);
    }

    //mysqli_free_result($consulta);
    mysqli_close($connexio);
}
?>
<!DOCTYPE html>
<html lang="es-es">
<!-- body -->

<head>
    <title>Iniciar Cursa</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="shortcut icon" href="./Images/logo.ico">
</head>

</html>