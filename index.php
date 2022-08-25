<!--php-->
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
        <div class="contenedor-principal">
            <div class="contenedor2">
                <h3 class="titulo">¡Nos preocupamos por ti!</h3>
                <p class="descripcion">Descuentos especiales</p>
                <a href="carta.php"><button role="button" class="boton">Haz tu pedido</button></a>
                <a href="login.php"><button role="button" class="boton">Inicia sesión</button></a>
            </div>

        </div>


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