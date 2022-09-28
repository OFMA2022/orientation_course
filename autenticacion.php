<?php
session_start();

//Connexio con bases de datos
//$connexio = mysqli_connect("localhost", "root", "", "orientation_course");
$connexio = mysqli_connect("localhost", "id19596923_root", "Mtr@ore2001good", "id19596923_goodhands");


if (mysqli_connect_errno()) {

    echo "Connexió fallida: " . mysqli_connect_error();
    exit();
} else {

    $sentenciaSQL = "SELECT * FROM credenciales";

    //Consulta en la bases de datos.
    $consulta = mysqli_query($connexio, $sentenciaSQL);

    if ($consulta) {

        //Su funcion es para confirmar si existe el usuario. Veremos lo que hace mas adelante.
        $conti = false;

        while ($vectorRegistres = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
            $user = $vectorRegistres["Usuario"];  //nom del usuari
            $pass = $vectorRegistres["Contrasenya"];  //contrasenya del usuari
            $email = $vectorRegistres["Correo"]; //admin

            //En caso si existe los cookies
            if ($_SESSION["conti"] == true) {

                if ($_COOKIE["USER"] == $user && $_COOKIE["CONTRA"] == $pass) {


                    $_SESSION["ultimAcces"] = time(); //Inicialitzem la data d'inici de sessió

                    //Guardem les dades de l'usuari autenticat en la sessió
                    $_SESSION["usuari"] = $_COOKIE["USER"];
                    $_SESSION["contrasenya"] = $_COOKIE["CONTRA"];
                    $_SESSION["cookies"] = $_COOKIE["on"];
                    $_SESSION["correo"] = $email;

                    $conti = true;

                    header("Location: aplicacion.php");
                }
            } else {

                //Comprobamos que los datos introducidos al iniciar la session estan en nuestra base de datos.
                if ($_POST["user"] == $user && $_POST["pass"] == $pass) {

                    $_SESSION["ultimAcces"] = time(); //Inicialitzem la data d'inici de sessió

                    //Guardem les dades de l'usuari autenticat en la sessió i al estat del casilla (check_box)
                    $_SESSION["usuari"] = $_POST["user"];
                    $_SESSION["contrasenya"] = $_POST["pass"];
                    $_SESSION["cookies"] = $_POST["cookies"];
                    $_SESSION["email"] = $email;

                    $conti = true;

                    //Mostrem la pàgina de l'aplicació
                    header("Location: aplicacion.php");
                }
            }
        }

        //En el caso de que los datos estan incorrectamente introducidos o que no existe.
        if ($conti == false) {
            echo 'Dades credencials no és correcta o usuari no existeix.<br>';
            echo '<br>';

            echo '<a href="eliminarCookies.php"><button>Torna a inici</button></a>';
            session_destroy();
            exit();
        }
    } else {
        echo "No s'ha produit la consulta: " . mysqli_error($connexio);
    }

    mysqli_free_result($consulta);
    mysqli_close($connexio);
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Autenticacion</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>

<body>

</body>

</html>