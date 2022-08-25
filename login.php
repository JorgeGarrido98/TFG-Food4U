<?php
session_name('food4u');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link rel="icon" href="img/icono.png">
    <title>Food4U</title>
</head>

<body>
<?php
include_once ("header.php");
?>
    <main>
        <section class="form-registro">
            <h4>Ingresar</h4>
            <form action="" method="post">

                <input class="controls" type="text" name="correo" id="correo" placeholder="Ingrese su correo electrónico">

                <input class="controls" type="password" name="contrasena" id="contrasena" placeholder="Ingrese su contraseña">

                <input class="boton" name="entrar" type="submit" value="Entrar">

                <?php
                    if (isset($_POST['entrar'])){
                        if (isset($_POST['correo']) && isset($_POST['contrasena'])){
                            $mysql_host = "localhost:3306";
                            $mysql_database = "food4u";
                            $mysql_user = "root";
                            $mysql_password = "1234";
                            $conexion = mysqli_connect($mysql_host, $mysql_user, $mysql_password) or die("No ha podido realizarse la conexión");
                            mysqli_select_db($conexion, $mysql_database) or die("No ha podido seleccionarse la base de datos");
                            $contrasena = $_POST['contrasena'];
                            $correo = $_POST['correo'];
                            $consulta1 = "SELECT count(*) from usuarios where correo like '$correo';";
                            $resultado1 = mysqli_query($conexion, $consulta1);
                            $linea1 = mysqli_fetch_array($resultado1);
                            if ($linea1["count(*)"] == 1){
                                $consulta2 = "SELECT contrasena from usuarios where correo like '$correo';";
                                $resultado2 = mysqli_query($conexion, $consulta2);
                                $linea2 = mysqli_fetch_array($resultado2);
                                if(password_verify($contrasena, $linea2['contrasena'])){
                                    $_SESSION['correo'] = $correo;
                                    $consulta3 = "SELECT rol from usuarios where correo like '$correo';";
                                    $resultado3 = mysqli_query($conexion, $consulta3);
                                    $linea3 = mysqli_fetch_array($resultado3);
                                    $_SESSION['rol'] = $linea3['rol'];
                                    print $_SESSION['correo'] . " " . $_SESSION['rol'];
                                    header("location:index.php");
                                } else {
                                    echo '<p style="color:red">Contraseña incorrecta!</p>';
                                }
                            }
                        }
                    }
                ?>

            </form>
        </section>
    </main>
    <!-- INICIO FOOTER -->
    <footer>
        <div class="footer-content">
            <h3>Food4U</h3>
            <div class="footer-datos">
                <h4>Teléfono de Contacto</h4>
                <p>91 846 72 59 / 694 65 92 34</p>
                <h4>Correo de Contacto</h4>
                <p>info@food4u.com</p>
                <h4>Ubicación</h4>
                <p>C/ Santa Lucrecia, Plaza Elíptica, 11, 28019 Madrid</p>
            </div>
            <ul class="socials">
                <li><a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://twitter.com"><i class="fa fa-twitter"></i></a></li>
                <li><a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a></li>
                <li><a href="https://www.youtube.com"><i class="fa fa-youtube"></i></a></li>
                <li><a href="https://www.linkedin.com"><i class="fa fa-linkedin-square"></i></a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy;2022. Designed by <span>Food4U</span></p>
        </div>
    </footer>
    <!-- FIN FOOTER -->
</body>

</html>