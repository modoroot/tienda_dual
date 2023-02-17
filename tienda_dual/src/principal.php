<?php
include 'conn/config.php';
include 'conn/conn.php';
include 'header_frontend.php';
?>
        <div class="row">
            <div class="col-2">
                <h1>Framerate</h1>
                <p>Tu tienda de compra de videojuegos online</p>
                <a href="" class="btn">Descubre más &#10132;</a>
            </div>
            <div class="col-2">
                <img src="img/banner-bb.jpg" alt="">
            </div>
        </div>
    </div>
</div>
<!-- categorías -->
<div class="categorias">
    <?php
    //Prepara y ejecuta la consulta para obtener los datos de la categoría. Muestra las imágenes de las categorías
    //con su id y nombre correspondiente
    $stmt = $pdo->prepare("SELECT * FROM categoria");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="subcont">
        <h2 class="titulo">Categorías</h2>
        <div class="row">
            <?php
            foreach ($results as $result) {
                //Se guarda el id de la categoría en una variable para poder utilizarla en el enlace con
                //un token para evitar cambiar a mano el id de la categoría y poder acceder a otra página web
                echo "<div class='col-3'>
                    <a href='categorias.php?id={$result['id_categoria']}&token=" . hash_hmac('sha1', $result['id_categoria'], KEY_TOKEN) . "'>
                    <img alt='Imagen' src='dashboard/img/{$result['img']}'></a>
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
<?php include "footer_frontend.php";?>
<!--JS-->
<!--Para la caché de los archivos JS se utiliza la función rand() para que cada vez que se cargue la página se genere un número aleatorio-->
<script src="js/main.js?v=<?php echo rand(); ?>"></script>
<!--JS Lista del menú-->
<script>
    //Muestra y oculta la lista del menú
    var menu_items = document.getElementById("menu_lista");
    menu_items.style.maxHeight = "0px";
    /**
     * Función que se ejecuta al pulsar el botón del menú. Si el valor de maxHeight es 0px, se le asigna
     * el valor de 200px para que se muestre el menú. Si el valor es 200px, se le asigna el valor de 0px
     * para que se oculte el menú
     */
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