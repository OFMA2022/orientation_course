<?php
//iniciar la session
session_start();

//Connexio con bases de datos
//$connexio = mysqli_connect("localhost", "root", "", "orientation_course");
$connexio = mysqli_connect("localhost", "id19596923_root", "Mtr@ore2001good", "id19596923_goodhands");

if (mysqli_connect_errno()) {

    echo "Connexió fallida: " . mysqli_connect_error();
    exit();
} else {


    $recibirIdFita[] = '';
    $recibirPuntFita[] = '';
    $recibirValorFita[] = '';
    $recibirCodiFita[] = '';


    //Obtenemos el numero total de las fitas que tenemos en cursa.
    $cantitat = $_SESSION["cantitat"];
    $conti = false;

    //Obtengo 'id' o 'valor' cuando le doy para validar fitas. Que en teoria son numeros. Cada fita tiene 
    //un numero/id de 1 - hasta la maxima fita que hay.
    $submit = $_POST["enviar"];

    $totalDelFita = sizeof($_SESSION["getIdFita"]);
    //Recorre todas las arrays y les guadaras en session_array
    for ($i = 0; $i < $totalDelFita; $i++) {
        $recibirIdFita[] = $_SESSION["getIdFita"][$i];
        $recibirPuntFita[] = $_SESSION["getPuntFita"][$i];
        $recibirValorFita[] = $_SESSION["getValorFita"][$i];
        $recibirCodiFita[] = $_SESSION["getCodiFita"][$i];
    }

    //For --> Recorre el 'for' por la cantidad de fita que tenemos en la cursa
    for ($i = 0; $i <= $cantitat; $i++) {

        //Hago este 'if' para indentificar los 'campos de entrada (los inputs donde introducimos los codigos)'.
        //Asi puedo comparar la 'indentificador del campo de entrada de los codigos' y la 'indentificador del campo de validacion'.
        if (isset($_POST[$i])) {

            //$submit --> Contiene la 'indentificador de campo de validacion'...
            //Lo uso para comparar, si lo que tiene la variable '$i' es igual lo que tiene la '$submit'.
            if ($i == $submit) {

                //Miro si los codigos si son iguales.
                if ($recibirCodiFita[$i] == $_POST[$i]) {

                    //Guardo el tiempo enseguida, una vez comprovo que los codigos son iguales y correctos.
                    $equipsFitesTemps = date('h:i:s');

                    //Guardo la id_fita en una variable. Veremos su funcion mas adelante.
                    $idFita = (int) $recibirIdFita[$i];

                    //Guardo el 'nom_equip' a una variable.
                    //En la pagina 'indexPublic.php', una vez he comprovado que el codigo que introducio..
                    //el usuario esta en la base de datos, guardo el nombre del equipo y el codigo en la session.
                    $nomEquip = $_SESSION["nom_equip"];

                    //Obtengo el id y codigo del equipo.
                    $idEquip = (int) $_SESSION["id_equip"];
                    $codiEquip = $_SESSION["codi_equip"];


                    //UNA CONNEXIO HACIA BASES DE DATOS CON LA TABLE 'equip_fites'.
                    $sentenciaSQL = "SELECT * FROM equip_fites";
                    //Consulta en la bases de datos.
                    $consulta = mysqli_query($connexio, $sentenciaSQL);
                    if ($consulta) {

                        //Hacemos la sentencial (insert into a la tabla del equip)
                        $sentenciaSql = "INSERT INTO equip_fites(id_equip, id_fita, temps)
                                                VALUES ('$idEquip', '$idFita', '$equipsFitesTemps')";

                        $consulta = mysqli_query($connexio, $sentenciaSql);

                        if (!$consulta) {
                            echo mysqli_error($connexio);
                        }
                    } else {
                        echo "No s'ha produit la consulta: " . mysqli_error($connexio);
                    }

                    $conti = true;
                    header('location: cursa.php');
                    break;
                }
            }
        }
    }

    if (!$conti) {
        echo '<h2>El codi no correspon a cap fita</h2>' . '<br/>';

        echo '<a href="cursa.php"><button>Torna a cursa</button></a>';
        exit();
    }

    //mysqli_free_result($consulta);
    mysqli_close($connexio);
}
