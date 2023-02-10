<?php
include_once "conn/conn.php";
//ID de la categoria que se ha seleccionado
$categoria_id = $_GET['id'];
include_once 'header_frontend.php';
?>
        <div class="row">
            <div class="col-2">
                <?php
                $stmt = $pdo->prepare("SELECT * FROM categoria WHERE id_categoria = $categoria_id");
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($results as $result) {
                    echo "<h1>{$result['nombre']}</h1>
                    <p>{$result['descripcion']}</p>
                <a href='' class='btn'>Descubre más &#10132;</a>
            </div>
            <div class='col-2'>
                <img src='dashboard/img/{$result['img']}' alt='Imagen de la categoría'>
            </div>
        </div>
            ";
                }
                ?>
            </div>
        </div>
    </div>
    <!-- productos -->
    <div class="subcont">
        <h2 class="titulo">Productos</h2>
        <div class="row">
            <?php
            $stmt = $pdo->prepare("SELECT * FROM producto INNER JOIN producto_imagen ON producto.id_producto = 
                                                     producto_imagen.id_producto WHERE id_categoria = $categoria_id");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $result) {
                echo "
            <div class='col-4'>
              <img src='dashboard/img/{$result['imagen']}' alt='Imagen producto'>
                <h4>{$result['nombre']}</h4>
                <p>{$result['precio']} €</p>
            </div>
            ";
            }
            ?>
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
<?php include "footer_frontend.php";?>
    <!-- modal -->
    <section class="modal">
        <?php
        $stmt = $pdo->prepare("SELECT * FROM producto INNER JOIN producto_imagen ON producto.id_producto = 
                                                     producto_imagen.id_producto WHERE id_categoria = $categoria_id");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="modal_container">
            <div class="modal-image-container">
                <img src="" alt="Imagen del producto">
            </div>
            <h2 class="modal_title">¡Bienvenido al sitio!</h2>
            <p class="modal_paragraph">Lorem  Deleniti nobis nisi quibusdam  quisquam quas, culpa tempora. Veniam consectetur deleniti maxime.</p>
            <a href="#" class="modal_close">Cerrar Modal</a>
        </div>
    </section>
    <script src="js/main.js?v=<?php echo rand(); ?>"></script>
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