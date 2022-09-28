<?php
//iniciar la session
use function PHPSTORM_META\exitPoint;

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

        //Variable 'temps' declarada, para recoger tiempo introducido en la bases de datos.
        $temps;

        //La variable 'conti' declarada para una funcion que necesitamos mas adelante.
        $conti = false;

        while ($vectorRegistres = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {

            $temps = $vectorRegistres["temps"];  //temps
            $conti = true;
        }

        if (!$conti) {
            echo 'No sha pogut obtenir el temps de bases de dades.<br>';
            exit();
        }

        //Guardamos el 'tiempo' que hemos recogido de la base de datos en la session.
        $_SESSION["temps"] = $temps;
    } else {
        echo "No s'ha produit la consulta: " . mysqli_error($connexio);
    }

    mysqli_free_result($consulta);
    mysqli_close($connexio);
}
?>
<!DOCTYPE html>
<html lang="es-es">

<!-- head -->

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>Cursa</title>
    <link rel="shortcut icon" href="./Images/logo.ico">
</head>

<!-- style -->
<style>
    .cabezera {
        display: flex;
        flex-wrap: wrap;
        gap: 30%;
    }

    .time {
        font-weight: bold;
    }

    button {
        height: 50px;
        width: 100px;
        color: white;
        background-color: black;
    }
</style>

<!-- header -->
<header>
    <!-- Cursa -->
    <div class="cabezera">
        <div>
            <h1>
                Cursa
            </h1>
        </div>

        <!-- Horarios -->
        <div class="time">
            <p>
                Hora inici cursa: <?php
                                    if (isset($_SESSION["temps"])) {
                                        echo $_SESSION["temps"];
                                    }
                                    ?>
            </p>
            <p>

                Punts acumulats: <?php
                                    if (isset($_SESSION["valorTotal"])) {
                                        echo $_SESSION["valorEquip"] .
                                            '/' . $_SESSION["valorTotal"];
                                    }
                                    ?>
            </p>
        </div>

        <!-- Cerrar Session -->
        <div>
            <p>
                <a href="logout.php"><button>Tanca la sessió</button></a>
            </p>
        </div>
    </div>
    <hr>
</header>

<!-- BODY -->

<body>
    <?php
    include "cursa2.php";
    ?>
</body>

</html>