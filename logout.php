<?php
//Tanquem sessió
session_start();
session_destroy();
$_SESSION = array();
?>
<!DOCTYPE html>
<html>
<!-- head -->

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>Tancar Sessió</title>
    <link rel="shortcut icon" href="./Images/logo.ico">
</head>

<!-- style -->
<style>
    body {
        text-align: center;
    }

    div {
        display: flex;
        flex-wrap: wrap;
        gap: 10%;
        justify-content: center;
    }

    button {
        background-color: black;
        color: white;
        height: 50px;
        width: 100px;
    }
</style>

<!-- body -->

<body>
    <h3>Sessió finalitzada</h3>
    <div>
        <a href="index.php"><button>Tornar a l'inici</button></a><br>
        <a href="eliminarCookies.php"><button>Eliminar cookies</button></a>
    </div>
</body>

</html>