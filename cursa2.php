<?php

//Connexio con bases de datos
//$connexio = mysqli_connect("localhost", "root", "", "orientation_course");
$connexio = mysqli_connect("localhost", "id19596923_root", "Mtr@ore2001good", "id19596923_goodhands");

if (mysqli_connect_errno()) {

    echo "Connexió fallida: " . mysqli_connect_error();
    exit();
} else {

    $sentenciaSQL = "SELECT * FROM fites";

    //Consulta en la bases de datos.
    $consulta = mysqli_query($connexio, $sentenciaSQL);

    if ($consulta) {

        $valorEquip = 0;

        $conti = false;

        while ($vectorRegistres = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {

            //Consigo una sentencia de todos los datos de la tabla 'equip_fites' donde averiguo con el 'id_equip'
            $nuevaSentenciaSql = "SELECT * FROM equip_fites WHERE id_equip = {$_SESSION["id_equip"]}";
            $nuevaConsulta2 = mysqli_query($connexio, $nuevaSentenciaSql);
            $tableRows = mysqli_num_rows($consulta);
            $validat = false;

            //Comprovamos si hay hitos validadas
            if ($tableRows != 0) {

                while ($register = mysqli_fetch_array($nuevaConsulta2, MYSQLI_ASSOC)) {

                    if ($register["id_fita"] == $vectorRegistres["id_fita"]) {
                        $validat = true;
                    }
                }
            }

            //en caso que hay hitos validadas
            if ($validat) {

                //Guardo todas las fitas que se han sido validadas aqui.
                $idFitaValidat[] = $vectorRegistres["id_fita"];
                $puntFitaValidat[] = $vectorRegistres["punt_fita"];
                $valorFitaValidat[] = $vectorRegistres["valor_fita"];
                $codiFitaValidat[] = $vectorRegistres["codi_fita"];
                //Obtengo la suma del valor de cada fita.
                $valorEquip += (int) $vectorRegistres["valor_fita"];
                //Para la confirmacion de que hay fitas validadas.
                $conti = true;
            } else {

                if (isset($_SESSION["getIdFita"])) {

                    unset($_SESSION['getIdFita']);
                    unset($_SESSION['getPuntFita']);
                    unset($_SESSION['getValorFita']);
                    unset($_SESSION['getCodiFita']);
                }

                //Gurado cada datos de la tabla "fites" en array
                $getIdFita[] = $vectorRegistres["id_fita"];
                $getPuntFita[] = $vectorRegistres["punt_fita"];
                $getValorFita[] = $vectorRegistres["valor_fita"];
                $getCodiFita[] = $vectorRegistres["codi_fita"];
            }
        }

        //Recorre todas las arrays y les guadaras en session_array.
        //Les voy a necesitar en la cursa3.php
        if (isset($getIdFita)) {
            for ($i = 0; $i < sizeof($getIdFita); $i++) {

                $_SESSION["getIdFita"][] = $getIdFita[$i];
                $_SESSION["getPuntFita"][] = $getPuntFita[$i];
                $_SESSION["getValorFita"][] = $getValorFita[$i];
                $_SESSION["getCodiFita"][] = $getCodiFita[$i];
            }
        }

        //Obtenemos puntuacion total de las fitas.
        $num = 0;
        if (isset($getIdFita)) {

            for ($i = 0; $i < sizeof($getValorFita); $i++) {
                # code...
                $num += (int) $getValorFita[$i];
            }
        }

        $_SESSION["valorTotal"] = $num;
        $_SESSION["valorEquip"] = $valorEquip;
        $_SESSION["continuar"] = $conti;
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
    <title>Iniciar Cursa</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="shortcut icon" href="./Images/logo.ico">
</head>

<!-- style -->
<style>
    .cursa {
        display: flex;
        flex-wrap: wrap;
        gap: 20%;
    }

    .input {
        height: 50px;
        width: 100px;
    }

    .codiValidar {
        display: flex;
        gap: 60%;
    }
</style>

<!-- body -->

<body>
    <div class="cursa">

        <!-- FITAS -->
        <div>
            <h2>Fita</h2>
            <?php
            //Recorremos todas las fitas y los mostramos.
            if (isset($getIdFita)) {
                for ($i = 0; $i < sizeof($getPuntFita); $i++) {
                    echo "<p>" . $getPuntFita[$i] . "</p>";
                }
            }
            ?>
        </div>

        <!-- PUNTS -->
        <div>
            <h2>Puntuacio</h2>
            <?php
            //Recorremos todos los puntos y los mostramos.
            if (isset($getIdFita)) {
                for ($i = 0; $i < sizeof($getValorFita); $i++) {
                    echo "<p>" . $getValorFita[$i] . "</p>";
                }
            }
            ?>

        </div>

        <!-- CODI - VALIDACIONES -->
        <div>
            <!-- form -->
            <form method="POST" action="cursa3.php">

                <div class="codiValidar">

                    <div>
                        <h2>Codi</h2>
                        <?php
                        //Creamos 'input para introducir el codigo' a medida de los codigos de fitas que tenemos en la base datos.
                        // Y guardamos en la session el numero 'total' ---> util para una funcion mas adelante.
                        if (isset($getIdFita)) {
                            for ($i = 1; $i <= sizeof($getCodiFita); $i++) {

                                echo '<p>' . '<input type="text" id="' . $i . '" name="' . $i . '" placeholder="Codi">' . '</p>';
                                $_SESSION["cantitat"] = $i;
                            }
                        }
                        ?>
                    </div>

                    <div>
                        <h2>Validats</h2>
                        <?php
                        //Creamos para 'validar' a medida los codigos de fitas que tenemos en la base datos.
                        if (isset($getIdFita)) {
                            for ($i = 1; $i <= sizeof($getCodiFita); $i++) {
                                echo '<p>' . '<input type="submit" id="enviar" name="enviar" value="' . $i . '" style="width: 150px; background-color: #1A5AF7; color: white;" placeholder="Validar"/>' . '</p>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- LOS FITAS VALIDADES -->
    <div class="cursa">

        <div>
            <h2>Fita</h2>
            <?php
            if ($_SESSION["continuar"] == true) {

                //Recorremos todos los puntos y los mostramos.
                for ($i = 0; $i < sizeof($puntFitaValidat); $i++) {
                    echo "<p>" . $puntFitaValidat[$i] . "</p>";
                }
            }
            ?>
        </div>

        <div>
            <h2>Puntuacio</h2>
            <?php
            if ($_SESSION["continuar"] == true) {

                //Recorremos todos los puntos y los mostramos.
                for ($i = 0; $i < sizeof($valorFitaValidat); $i++) {
                    echo "<p>" . $valorFitaValidat[$i] . "</p>";
                }
            }
            ?>
        </div>

        <div>
            <h2>Codi</h2>
            <?php
            if ($_SESSION["continuar"] == true) {

                //Recorremos todos los puntos y los mostramos.
                for ($i = 0; $i < sizeof($codiFitaValidat); $i++) {
                    echo "<p>" . $codiFitaValidat[$i] . "</p>";
                }
            }
            ?>
        </div>

        <div>
            <h2>Validats</h2>
            <?php
            if ($_SESSION["continuar"] == true) {

                //Creamos para 'validar' a medida los codigos de fitas que tenemos en la base datos.
                for ($i = 0; $i < sizeof($codiFitaValidat); $i++) {
                    echo '<p>' . '<input type="button"  name="Validats" value="Validats" style="width: 150px; background-color: #3DF84E; color: white;"/>' . '</p>';
                }
            }
            ?>
        </div>
    </div>
</body>

</html>