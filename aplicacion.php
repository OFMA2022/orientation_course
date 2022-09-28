<?php
//iniciem sessió
session_start();

define("TEMPSINACTIU", 10); //Segons màxims que pot estar l'aplicació inactiva

//Si el cookies es "on" guardamos los cookies.
if ($_SESSION["cookies"] == "on") {

    //Creamos los cookies.
    setcookie("USER", $_SESSION["usuari"], time() + 7200);
    setcookie("CONTRA", $_SESSION["contrasenya"], time() + 7200);
}

//Temps transcorregut des de l'últim accés a la pàgina i la data actual.
$tempsTranscorregut = time() - $_SESSION["ultimAcces"];

if ($tempsTranscorregut >= TEMPSINACTIU) { //Si la sessió ha caducat, han passat 30 segons o més des de l'últim accés...
    session_destroy(); //Destruim sessió
    header("Location: caducitat.php"); //Mostrem la pàgina de caducitat
} else { //Si no ha caducat...
    $_SESSION["ultimAcces"] = time(); //Actualitzem la data per tornar a començar
}

?>
<!DOCTYPE html>
<html lang="es-es">

<!-- head -->

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>Aplicació</title>
    <link rel="shortcut icon" href="./Images/logo.ico">
</head>

<!-- style -->
<style>
    .cabecera {
        display: flex;
        flex-wrap: wrap;
        gap: 50%;
    }

    .contenido {
        width: 100%;
        /*width de la imagen en general*/
        display: flex;
        gap: 1%;
    }

    img {
        width: 100%;
        /*width de estructura de la imagen */
    }

    button {
        height: 50px;
        width: 100px;
        color: white;
        background-color: black;
    }
</style>

<!-- body -->

<body>

    <div class="cabecera">

        <div style="font-size: xx-large;">
            Cursa
        </div>

        <div>
            <a href="logout.php"><button>Tanca la sessió</button></a>
        </div>
    </div>
    <hr>

    <div class="contenido">

        <div>
            <a href="crearCursa.php">
                <img src="./Images/CrearCursa.jpg" alt="crear">
            </a>
        </div>

        <div>
            <a href="inscribirEquipo.php">
                <img src="./Images/inscribirCursa.jpg" alt="inscribir">
            </a>
        </div>

        <div>
            <a href="iniciarCursa.php">
                <img src="./Images/iniciarCursa.jpg" alt="iniciar">
            </a>
        </div>

        <div>
            <a href="">
                <img src="./Images/visualizar.jpg" alt="visualizar">
            </a>
        </div>
    </div>
</body>

</html>