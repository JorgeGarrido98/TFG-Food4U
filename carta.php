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
    <style>
        footer {
            margin-top: 30px;
        }
    </style>
</head>

<body>
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
                    echo '<a href="javascript:abrir()">Carrito</a>';
                    echo '<a href="logout.php" id="Cerrar sesion" class= "btn-cerrar" >Cerrar sesion</a>';
                }
            }
        ?>
    </nav>
</div>
</header>
    <main>
    <div class="container">
        <h1>Carta</h1>
        <hr>
        <h3>Primeros</h3>
        <div class="row" id="primeros"></div>
    </div>

    <template id="template-card-primeros">
        <div class="col-12 mb-2 col-md-4">
            <div class="card">
                <img src="" alt="" class="card-img-top">
                <div class="card-body">
                    <h5>Título</h5>
                    <hr>
                    <span class="precio">precio</span> €
                    <br>
                    <span class="kcal">calorias</span> Kcal
                    <br>
                    <span class="mediterraneo">mediterraneo</span>
                    <span class="vegano">vegano</span>
                    <span class="celiaco">celiaco</span>
                    <span class="vegetariano">vegetariano</span>
                    <hr>
                    <button class="btn btn-dark">Añadir al carrito</button>
                </div>
            </div>
        </div>
    </template>

    <div class="container">
        <h3>Segundos</h3>
        <div class="row" id="segundos"></div>
    </div>

    <template id="template-card-segundos">
        <div class="col-12 mb-2 col-md-4">
            <div class="card">
                <img src="" alt="" class="card-img-top">
                <div class="card-body">
                    <h5>Título</h5>
                    <hr>
                    <span>precio</span> €
                    <br>
                    <span class="kcal">calorias</span> Kcal
                    <br>
                    <span class="mediterraneo">mediterraneo</span>
                    <span class="vegano">vegano</span>
                    <span class="celiaco">celiaco</span>
                    <span class="vegetariano">vegetariano</span>
                    <hr>
                    <button class="btn btn-dark">Añadir al carrito</button>
                </div>
            </div>
        </div>
    </template>

    <div class="container" id="carrito">
        <h4>Carrito de compras</h4>
        
        <table class="table">
          <div id="cerrar">
            <a href="javascript:cerrar()"><img id="cruz-carrito" src="img/cruz.png"></a>
          </div>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Item</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Acción</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody id="items"></tbody>
          <tfoot>
            <tr id="footer">
              <th scope="row" colspan="5">Carrito vacío - comience a añadir platos!</th>
            </tr>
          </tfoot>
        </table>

        <div class="row" id="cards"></div>
      </div>

    <template id="template-footer">
        <th scope="row" colspan="2">Total productos</th>
        <td>10</td>
        <td>
            <button class="btn btn-danger btn-sm" id="vaciar-carrito">
                Vaciar todo
            </button>
        </td>
        <td class="font-weight-bold"><span>5000</span> €</td>
        <br><br>
        <p>
            <a href="javascript:finalizarPedido()">
                <button class="btn btn-danger btn-sm" id="finalizar-pedido">
                    Finalizar pedido
                </button>
            </a>
        </p>
    </template>
    
    <template id="template-carrito">
      <tr>
        <th scope="row">id</th>
        <td>Café</td>
        <td>1</td>
        <td>
            <button class="btn btn-info btn-sm">
                +
            </button>
            <button class="btn btn-danger btn-sm">
                -
            </button>
        </td>
        <td><span>500</span> €</td>
      </tr>
    </template>

    <div id="finalizar">
        <div id="cerrar-finalizar">
            <a href="javascript:cerrarFinalizarPedido()"><img id="cruz-finalizar" src="img/cruz.png"></a>
        </div>
        <div class="container-finalizar">
            <h1>
                Pedido finalizado!
            </h1>
            <h2>
                Nos pondremos en contacto contigo a través del correo
            </h2>
            <h3>
                para completar los datos para el envío
            </h3>
        </div>
    </div>

    <script src="js/app.js"></script>

    <!-- JavaScript Carrito Flotante -->
    <script>
        function abrir(){
            document.getElementById('carrito').style.display = "block"
        }

        function cerrar(){
            document.getElementById('carrito').style.display = "none"
        }

        function finalizarPedido(){
            document.getElementById('finalizar').style.display = "block"
        }

        function cerrarFinalizarPedido(){
            document.getElementById('finalizar').style.display = "none"
        }
    </script>
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