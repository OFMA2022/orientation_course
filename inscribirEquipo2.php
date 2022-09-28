<?php
session_start();

//Connexio con bases de datos
//$connexio = mysqli_connect("localhost", "root", "", "orientation_course");
$connexio = mysqli_connect("localhost", "id19596923_root", "Mtr@ore2001good", "id19596923_goodhands");

if (mysqli_connect_errno()) {

    echo "Connexió fallida: " . mysqli_connect_error();
    exit();
} else {

    $sentenciaSQL = "SELECT * FROM equip";

    //Consulta en la bases de datos.
    $consulta = mysqli_query($connexio, $sentenciaSQL);

    if ($consulta) {

        while ($vectorRegistres = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
            $id_equip = $vectorRegistres["id_equip"];  //id del equip
            $nom_equip = $vectorRegistres["nom_equip"];  //nom del equip
            $participants_equip = $vectorRegistres["participants_equip"]; //numero del particpants
            $codi_equip = $vectorRegistres["codi_equip"]; //codi del equip

            //Miramos si existe el nombre del equipo o el codigo en la base de datos.
            if ($_POST["nomEquip"] == $nom_equip) {

                echo "El nom i/o el codi del equip ya existeis en la bases de dades.<br>";
                echo '<br>';

                echo '<a href="aplicacion.php"><button>Torna a la aplicacio</button></a>';
                exit();
            }
        }

        //------- equip
        $nomEquip = $_POST["nomEquip"];
        $numeroParticipants = $_POST["numeroComponent"];

        //generar codigo del equipo aleatoriamente
        $codiAleatori = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codiEquip = substr(str_shuffle($codiAleatori), 0, 4);

        //Hacemos la sentencial (insert into a la tabla del equip)
        $sentenciaSql = "INSERT INTO equip(id_equip,nom_equip,participants_equip,codi_equip)
                VALUES ('','$nomEquip','$numeroParticipants','$codiEquip')";

        $consulta = mysqli_query($connexio, $sentenciaSql);


        //--------- primer Participant
        if ($_POST["primerPaticipantNom"] && $_POST["primerPaticipantEdat"]) {

            $nomParticipant1 = $_POST["primerPaticipantNom"];
            $edatParticipant1 = $_POST["primerPaticipantEdat"];

            $sentenciaSql1 = "INSERT INTO participants_equip(id_equip,id_participant,nom_participant,edat_participant)
                    VALUES ((SELECT id_equip FROM equip
                             WHERE codi_equip = '$codiEquip'),'','$nomParticipant1','$edatParticipant1')";

            $consulta1 = mysqli_query($connexio, $sentenciaSql1);
        }

        //------- segon Participant
        if ($_POST["segonPaticipantNom"] && $_POST["segonPaticipantEdat"]) {

            $nomParticipant2 = $_POST["segonPaticipantNom"];
            $edatParticipant2 = $_POST["segonPaticipantEdat"];

            $sentenciaSql2 = "INSERT INTO participants_equip(id_equip,id_participant,nom_participant,edat_participant)
                    VALUES ((SELECT id_equip FROM equip
                             WHERE codi_equip = '$codiEquip'),'','$nomParticipant2','$edatParticipant2')";

            $consulta2 = mysqli_query($connexio, $sentenciaSql2);
        }


        //------- tercer Participant
        if ($_POST["tercerPaticipantNom"] && $_POST["tercerPaticipantEdat"]) {

            $nomParticipant3 = $_POST["tercerPaticipantNom"];
            $edatParticipant3 = $_POST["tercerPaticipantEdat"];

            $sentenciaSql3 = "INSERT INTO participants_equip(id_equip,id_participant,nom_participant,edat_participant)
            VALUES ((SELECT id_equip FROM equip
                     WHERE codi_equip = '$codiEquip'),'','$nomParticipant3','$edatParticipant3')";

            $consulta3 = mysqli_query($connexio, $sentenciaSql3);
        }

        //Comprobamos si todas las consultas han funcionado correctamente.
        if ($consulta == TRUE || $consulta1 == TRUE || $consulta2 == TRUE || $consulta3 == TRUE) {

            echo "L'equip s'ha inscrit correctament<br>";

            echo '<br>';
            echo '<a href="aplicacion.php"><button>Torna a la aplicacio</button></a>';
            exit();
        } else {

            //Mensajes de error...
            echo "No s'ha inscrit l'equip correctament: " . mysqli_error($connexio);
            echo '<br>';
            echo '<a href="aplicacion.php"><button>Torna a la aplicacio</button></a>';
        }
    } else {

        echo "No s'ha produit la consulta: " . mysqli_error($connexio);
    }

    //mysqli_free_result($consulta);
    mysqli_close($connexio);
}
?>
<!DOCTYPE html>
<html>
<!-- head -->

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>Inscribir Equipo</title>
    <link rel="shortcut icon" href="./Images/logo.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

</html>