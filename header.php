<header>
<div class="contenedor">
   <img src="img/logo_Food4U.png" class="logotipo">
    <nav>
        <a href="index.php" id="index">Inicio</a>
        <a href="about_us.php" id="about-us">Sobre nosotros</a>
        <a href="carta.php" id="carta">Carta</a>
        
        <?php
        if(!isset($_SESSION["rol"])) {
                echo '<a href="registro.php" id="carta">Registro</a>';
                echo '<a href="login.php" id="carta">Login</a>';
        }
        ?>
        <?php
        if(isset($_SESSION["rol"])) {
            if($_SESSION["rol"] == "Empresa" || $_SESSION["rol"] == "empresa") {
                    echo '<a href="empresa.php" id="carta">Empresa</a>';
            }
        }
        if(isset($_SESSION["rol"])) {
            if($_SESSION["rol"] == "empresa" || $_SESSION["rol"] == "Empresa" || $_SESSION["rol"] == "particular" || $_SESSION["rol"] == "Particular") {
                echo '<a href="#">Carrito</a>';
                echo '<a href="logout.php" id="Cerrar sesion" class= "btn-cerrar" >Cerrar sesion</a>';
            }
        }
        ?>
    </nav>
</div>
</header>