<!DOCTYPE html>
<html lang="es-es">
<!--head -->

<head>
    <title>Iniciar Cursa</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="shortcut icon" href="./Images/logo.ico">
</head>
<!-- body -->

<body>

    <form method="POST" action="iniciarCursa2.php">

        <h1>INICIAR LA CURSA</h1>
        <label for="iniCursa">Temps d'inici: </label>
        <input type="time" id="iniCursa" name="iniCursa" required>
        <br>
        <br>

        <input type="submit" name="enviar" value="Iniciar" />
        <input class="button" type="button" onclick="window.location.replace('aplicacion.php')" value="Cancel" />

    </form>
</body>

</html>