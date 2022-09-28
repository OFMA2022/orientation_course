<!DOCTYPE html>
<html>

<body>
    <h1>Modificacions d'usuari</h1>

    <form method="POST" action="modificarUsuari2.php" >

        <!--Formulario para recoger los nuevos datos y los datos existentes-->
        <label for="nomE">Introduïu el nom existent: </label>
        <input type="text" name="nomE" id="nomE" required/>
        <br>
        <br>

        <label for="contraE">Introduïu la contrasenya existent: </label>
        <input type="password" name="contraE" id="contraE" required/>
        <br>
        <br>

        <hr>

        <label for="nomN">Introduïu el nom nou: </label>
        <input type="text" name="nomN" id="nomN" required/>
        <br>
        <br>

        <label for="contraN">Introduïu la nova contra: </label>
        <input type="password" name="contraN" id="contraN" required/>
        <br>
        <br>

        <input type="submit" name="enviar" value="Accedir" />
        <input class="button" type="button" onclick="window.location.replace('aplicacion.php')" value="Cancel" />

    </form>
</body>

</html>