<!DOCTYPE html>
<html>

<body>
    <h1>Eliminació de l'usuari</h1>

    <form method="POST" action="eliminarPerAdmin2.php">

        <label for="nom">Introduïu el nom del usuari que vols eliminar</label>
        <input type="text" name="nom" id="nom" required />
        <br>
        <br>

        <input type="submit" name="enviar" value="Accedir" />
        <input class="button" type="button" onclick="window.location.replace('aplicacion.php')" value="Cancel" />

    </form>

</body>

</html>