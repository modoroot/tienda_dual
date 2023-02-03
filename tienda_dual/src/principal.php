<?php
include 'conn/conn.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Framerate</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="css/modal_styles.css"
          crossorigin="anonymous">
    <style>
        img {
            border-radius: 8%;
        }
    </style>
</head>
<body>
<div class="modal fade" id="modal-categoria" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="modal-form">
                    <div class="form-group">
                        <label for="nombre_usu" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control input-nombre" id="nombre_usu">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btCancel" data-dismiss="modal">
                    Cerrar
                </button>
                <input class="btn btn-info btn-guardar" value="Guardar"
                       type="submit">
            </div>
        </div>
    </div>
</div>
<div class="header">
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <img src="img/logo.png" width="125px">
            </div>
            <nav>
                <ul id="menu_lista">
                    <li><a href="">Home</a></li>
                    <li><a href="">Productos</a></li>
                    <li><a href="">Info</a></li>
                    <li><a href="">Contacto</a></li>
                    <li><a href="">Cuenta</a></li>
                </ul>
            </nav>
            <img src="img/cart.png" width="30px" height="30px">
            <img src="img/menu.png" class="menu-icon" onclick="menuDesplegar()">
        </div>

        <div class="row">
            <div class="col-2">
                <h1>Fino<br>fino</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor<br>incididunt ut labore et dolore magna aliqua.
                    Ut enim ad minim veniam</p>
                <a href="" class="btn">Descubre más &#10132;</a>
            </div>
            <div class="col-2">
                <img src="img/banner-bb.jpg">
            </div>
        </div>
    </div>
</div>
<!-- categorías -->
<div class="categorias">
    <?php
    $stmt = $pdo->prepare("SELECT * FROM categoria");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="subcont">
        <h2 class="titulo">Categorías</h2>
        <div class="row">
            <?php
            foreach ($results as $result) {
                echo "<div class='col-3'>
                <img alt='Imagen' data-target='#modal-categoria' data-toggle='modal' src='img/{$result['img']} '>
                <h4>{$result['nombre']}</h4> </div>";
            }
            ?>
        </div>
    </div>
</div>
<!-- productos -->
<div class="subcont">
    <h2 class="titulo">Lo mejor de 2022</h2>
    <div class="row">
        <div class="col-4">
            <img src="img/vampire-survivors-banner.jpg">
            <h4>Vampire Survivors</h4>
            <p>3.99 €</p>
        </div>
        <div class="col-4">
            <img src="img/elden-ring-banner.jpg">
            <h4>Elden Ring</h4>
            <p>59.99 €</p>
        </div>
        <div class="col-4">
            <img src="img/requiem-banner.jpg">
            <h4>A Plague Tale: Requiem</h4>
            <p>49.99 €</p>
        </div>
        <div class="col-4">
            <img src="img/hellsinger-banner.jpg">
            <h4>Metal Hellsinger</h4>
            <p>29.99 €</p>
        </div>
    </div>
    <h2 class="titulo">Productos más comprados</h2>
    <div class="row">
        <div class="col-4">
            <img src="img/vampire-survivors-banner.jpg">
            <h4>Vampire Survivors</h4>
            <p>3.99 €</p>
        </div>
        <div class="col-4">
            <img src="img/elden-ring-banner.jpg">
            <h4>Elden Ring</h4>
            <p>59.99 €</p>
        </div>
        <div class="col-4">
            <img src="img/disco-elysium-banner.jpg">
            <h4>Disco Elysium</h4>
            <p>39.99 €</p>
        </div>
        <div class="col-4">
            <img src="img/gow-banner.jpg">
            <h4>God of War</h4>
            <p>49.99 €</p>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <img src="img/re4-banner.jpg">
            <h4>Resident Evil 4 Remake</h4>
            <p>59.99 €</p>
        </div>
        <div class="col-4">
            <img src="img/elden-ring-banner.jpg">
            <h4>Elden Ring</h4>
            <p>59.99 €</p>
        </div>
        <div class="col-4">
            <img src="img/cod-mw2-banner.jpg">
            <h4>Modern Warfare® II</h4>
            <p>39.99 €</p>
        </div>
        <div class="col-4">
            <img src="img/gow-banner.jpg">
            <h4>God of War</h4>
            <p>49.99 €</p>
        </div>
    </div>
</div>
<div class="exclusivo">
    <div class="subcont">
        <div class="row">
            <div class="col-2">
                <img src="img/bloodborne-remaster.jpg" class="exclusivo-img">
            </div>
            <div class="col-2">
                <p>Sólo disponible en Framerate</p>
                <h1>Bloodborne</h1>
                <small>Después de más de 7 años de espera, Bloodborne PC</small>
                <a href="" class="btn">Resérvalo ahora &#10132;</a>
            </div>
        </div>
    </div>
</div>
<!-- pie de página -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col-1">
                <h3>Descargar</h3>
                <p>asdsdaasdda</p>
            </div>
            <div class="footer-col-2">
                <img src="img/logo.png">
                <p>asdsdaasdda</p>
            </div>
            <div class="footer-col-3">
                <h3>RRSS</h3>
                <ul>
                    <li>Twitter</li>
                    <li>Youtube</li>
                </ul>
            </div>
        </div>
        <hr>
        <p class="copyright">Copyright &copy;</p>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<!--JS Lista del menú-->
<script>
    var menu_items = document.getElementById("menu_lista");
    menu_items.style.maxHeight = "0px";

    function menuDesplegar() {
        if (menu_items.style.maxHeight == "0px") {
            menu_items.style.maxHeight = "200px";
        } else {
            menu_items.style.maxHeight = "0px";
        }
    }
</script>
</body>
</html>