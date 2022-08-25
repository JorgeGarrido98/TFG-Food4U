<?php
session_name("food4u");
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
            <h4>Registro</h4>
            <form action="" method="post" enctype='multipart/form-data'>

                <input class="controls" type="text" name="rol" id="rol" placeholder="Empresa o particular">

                <input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre">

                <input class="controls" type="text" name="apellidos" id="apellidos" placeholder="Ingrese su apellidos">

                <input class="controls" type="text" name="correo" id="correo" placeholder="Ingrese su email">

                <input class="controls" type="password" name="contrasena" id="contrasena" placeholder="Ingrese su contraseña">

                <input type="radio" name="terminos" value="1"> Estoy de acuerdo con <a href="https://foundation.wikimedia.org/wiki/Terms_of_Use/es">Terminos y Condiciones</a>

                <input class="boton" name="subir" type="submit" value="Registrar">

                <p><a href="login.php">¿Ya tengo cuenta?</a></p>

                <?php
                    if (isset($_POST['subir'])){
                        if (!empty($_POST['rol']) && !empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['correo']) && !empty($_POST['contrasena'])){
                            $mysql_host = "localhost:3306";
                            $mysql_database = "food4u";
                            $mysql_user = "root";
                            $mysql_password = "1234";
                            $conexion = mysqli_connect($mysql_host, $mysql_user, $mysql_password) or die("No ha podido realizarse la conexión");
                            mysqli_select_db($conexion, $mysql_database) or die("No ha podido seleccionarse la base de datos");
                            $rol = (isset($_POST["rol"])) ? htmlspecialchars(trim(strip_tags($_POST["rol"])), ENT_QUOTES, "UTF-8") : "";
                            $nombre = (isset($_POST["nombre"])) ? htmlspecialchars(trim(strip_tags($_POST["nombre"])), ENT_QUOTES, "UTF-8") : "";
                            $apellidos = (isset($_POST["apellidos"])) ? htmlspecialchars(trim(strip_tags($_POST["apellidos"])), ENT_QUOTES, "UTF-8") : "";
                            $contrasena = $_POST['contrasena'];
                            $pass = password_hash($contrasena, PASSWORD_DEFAULT, [15]);
                            $correo = (isset($_POST["correo"])) ? htmlspecialchars(trim(strip_tags($_POST["correo"])), ENT_QUOTES, "UTF-8") : "";
                            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                                echo '<p style="color:red">Formato de correo inválido</p>';
                            } else {
                                $sql = "INSERT into usuarios (rol, nombre, apellidos, correo, contrasena) values ('$rol', '$nombre', '$apellidos', '$correo', '$pass')";
                                mysqli_query($conexion, $sql);
                                header("location:login.php");
                            }
                            
                        } else {
                            echo '<p style="color:red">Faltan datos por rellenar</p>';
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