<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<!-- head -->

<head>
    <title>Inscribir Equipo</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="shortcut icon" href="./Images/logo.ico">
</head>

<!-- body -->

<body>
    <p><span style="font-size: xx-large; font-weight: bold;">Inscripció de l'equip</span> (Minim 3 participants)</p>

    <!--Formulario -->
    <form method="POST" action="inscribirEquipo2.php">

        <?php
        /* SOLO PARA COMENTARIO.
        Lo que hago en esta formulario es... 
        - Recoger el nombre del equipo
        - Recoger el numero total del participantes (Minimo 3 opponentes)
        - Recoger los nombres y edades de cada participantes.
        */
        ?>

        <h3>Introduir el nom del equip</h3>
        <label for="nomEquip">Nom del equip: </label>
        <input type="text" id="nomEquip" name="nomEquip" placeholder="ej: The Hot Eagle" required>
        <br>
        <br>

        <h3>Introduir número total de l'equip</h3>
        <label for="numeroComponent">Número de components: </label>
        <input type="number" id="numeroComponent" name="numeroComponent" required>
        <br>
        <br>

        <h3>Introduir nom i edat dels participants</h3>
        <label for="primerPaticipantNom">Nom del primer participant: </label>
        <input type="text" id="primerPaticipantNom" name="primerPaticipantNom" required>
        <br>
        <br>

        <label for="primerPaticipantEdat">Edat del primer participant: </label>
        <input type="number" id="primerPaticipantEdat" name="primerPaticipantEdat" required>
        <br>
        <br>
        <br>

        <label for="segonPaticipantNom">Nom del segon participant: </label>
        <input type="text" id="segonPaticipantNom" name="segonPaticipantNom">
        <br>
        <br>

        <label for="segonPaticipantEdat">Edat del segon participant: </label>
        <input type="number" id="segonPaticipantEdat" name="segonPaticipantEdat">
        <br>
        <br>
        <br>

        <label for="tercerPaticipantNom">Nom del tercer participant: </label>
        <input type="text" id="tercerPaticipantNom" name="tercerPaticipantNom">
        <br>
        <br>

        <label for="tercerPaticipantEdat">Edat del tercer participant: </label>
        <input type="number" id="tercerPaticipantEdat" name="tercerPaticipantEdat">
        <br>
        <br>

        <input type="submit" name="enviar" value="Enviar" />
        <input class="button" type="button" onclick="window.location.replace('aplicacion.php')" value="Cancel" />
    </form>
</body>

</html>