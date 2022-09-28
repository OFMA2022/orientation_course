<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!-- head -->

<head>
    <title>Crear Cursa</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="shortcut icon" href="./Images/logo.ico">
</head>

<!-- body -->

<body>

    <h1>Creació de Fites</h1>

    <form method="POST" action="crearCursa2.php">
        <!-- Introducimos la cantidad que fitas que queremos. -->
        <h3>Quantitat de fites</h3>
        <label for="quantitatFites">Quantitat del fites: </label>
        <input type="number" id="quantitatFites" name="quantitatFites" required>
        <br>
        <br>

        <input type="submit" name="enviar" value="Crear" />
        <input class="button" type="button" onclick="window.location.replace('aplicacion.php')" value="Cancel" />

    </form>

</body>

</html>