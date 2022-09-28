<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>Inici</title>
    <link rel="stylesheet" href="./CSS/indexAdmin.css">
    <link rel="shortcut icon" href="./Images/logo.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!--Averiguemos si exsite los cookies en el navegador-->
    <?php
    include "existenCookies.php";
    ?>

</head>

<body>
    <div class="login-wrap">

        <div class="login-html">

            <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
            <label for="tab-1" class="tab">Publica</label>

            <input id="tab-2" type="radio" name="tab" class="sign-up">
            <label for="tab-2" class="tab">Privado</label>

            <!-- parte administrador -->
            <div class="login-form">
                <form method="POST" action="autenticacion.php">
                    <div class="sign-up-htm">
                        <div class="group">
                            <label for="user" class="label">Usuari</label>
                            <input name="user" type="text" class="input" required>
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Contrasenya</label>
                            <input name="pass" type="password" class="input" data-type="password" required>
                        </div>
                        <div class="group">
                            <input id="cookies" name="cookies" type="checkbox" class="check" value="on">
                            <label for="cookies"><span class="icon"></span> Manteniu-me la sessió</label>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Inicieu la sessió">
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <a href="">Entrada pública</a>
                        </div>
                    </div>
                </form>

                <!-- parte publica-->
                <form method="POST" action="indexPublic.php">
                    <div class="sign-in-htm">
                        <div class="group">
                            <label for="codi" class="label">Codi</label>
                            <input name="codi" type="text" class="input" required>
                        </div>

                        <div class="group">
                            <input type="submit" class="button" value="Sign Up">
                        </div>
                        <div class="hr"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>