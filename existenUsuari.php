<?php

//Iniciem sessió.
session_start();

//iniciem la connexio
$connexio = mysqli_connect("localhost", "root", "", "cursacredenciales");

if (mysqli_connect_errno()) {

    echo "Connexió fallida: " . mysqli_connect_error();
    exit();
} else {

    $sentenciaSQL = "SELECT * FROM credenciales";

    $consulta = mysqli_query($connexio, $sentenciaSQL);

    if ($consulta) {

        while ($vectorRegistres = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
            $user = $vectorRegistres["Usuario"];  //nom del usuari
            $pass = $vectorRegistres["Contrasenya"];  //contrasenya del usuari
            $email = $vectorRegistres["Correo"]; //Valor del admin

            //Comprobación de los nuevos datos en la base de datos.
            if ($_POST["userSignUp"] == $user) {

                echo "El usuari ya existeis en la bases de dades.<br>";
                echo '<br>';

                echo '<a href="inici.php"><button>Torna a inici</button></a>';
                exit();
            }
        }

        $usernameIntro = $_POST["userSignUp"];
        $passwordIntro = $_POST["passSignUp"];
        $emailIntro = $_POST["emailSignUp"];

        //Hacemos la sentencial (insert into)
        $sentenciaSql = "INSERT INTO credenciales(Usuario,Contrasenya,Correo)
            VALUES ('$usernameIntro','$passwordIntro','$emailIntro')";

        //Fem la consulta a la base de dades per inserta el regsistro
        $consulta = mysqli_query($connexio, $sentenciaSql);

        if ($consulta == TRUE) {

            echo "Els dades s'ha creat correctament!!<br>";

            echo '<br>';
            echo '<a href="index.php"><button>Torna a inici</button></a>';
            exit();
        } else {
            echo "Els dades no s'ha creat correctament: " . mysqli_error($connexio);
        }
    } else {
        echo "No s'ha produit la consulta: " . mysqli_error($connexio);
    }
    mysqli_close($connexio);
}


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>sin título</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>

<body>

    <button type="button"> </button>

</body>

</html>