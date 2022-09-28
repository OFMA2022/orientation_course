<!DOCTYPE html>
<html>

<body>
    <!--Formulario para recoger nuevos datos-->
    <form method="POST" action="existenUsuari.php">

        <label for="usuari">Usuari: </label>
        <input type="text" name="usuari" id="usuari" required/>
        <br>
        <br>

        <label for="contrasenya">Contrasenya: </label>
        <input type="password" name="contrasenya" id="contrasenya" required/>
        <br>
        <br>

        <input type="submit" name="enviar" value="Accedir" />
        <input class="button" type="button" onclick="window.location.replace('inici.php')" value="Cancel" />

    </form>

</body>

</html>