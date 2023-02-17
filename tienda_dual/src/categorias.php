<?php
include_once "conn/config.php";
include_once "conn/conn.php";
//ID de la categoria que se ha seleccionado. Si no existe lo deja vacío
$categoria_id = $_GET['id'] ?? '';
//Token de seguridad. Si no existe lo deja vacío
$token = $_GET['token'] ?? '';

// Se verifica si la variable $categoria_id y $token están vacías
if ($categoria_id == '' || $token == '') {
// Si alguno de los dos está vacío se muestra un mensaje de error y se detiene la ejecución del script
    echo "Error en la petición";
    exit;
} else {
// Si ambos están llenos, se genera un token temporal
    $token_tmp = hash_hmac('sha1', $categoria_id, KEY_TOKEN);
// Se verifica si el token temporal es igual al token recibido
    if ($token != $token_tmp) {
// Si los tokens no coinciden, se muestra un mensaje de error y se detiene la ejecución del script
        echo "Error en la petición";
        exit;
    }
}
include_once 'header_frontend.php';
?>
<div class="row">
    <div class="col-2">
        <?php
        //Prepara y ejecuta la consulta para obtener los datos de la categoría. Muestra la imagen correspondiente
        //al ID anteriormente seleccionado en principal.php
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
        //Prepara y ejecuta la consulta para obtener los datos de los productos que pertenecen a la categoría
        //seleccionada anteriormente. Además, muestra la imagen del producto
        $stmt = $pdo->prepare("SELECT * FROM producto INNER JOIN producto_imagen ON producto.id_producto = 
                                                     producto_imagen.id_producto WHERE id_categoria = $categoria_id");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $result) {
            //Se guarda el id del producto en una variable para poder utilizarla en el enlace con
            //un token para evitar cambiar a mano el id del producto y poder acceder a otra página web
            echo "
            <div class='col-4'>
              <a href='productos.php?id={$result['id_producto']}&token=" . hash_hmac('sha1', $result['id_producto'], KEY_TOKEN) . "'>
              <img src='dashboard/img/{$result['imagen']}' alt='Imagen producto'></a>
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
<?php include "footer_frontend.php"; ?>
<!--JS Lista del menú-->
<script>
    //Se obtiene el elemento del menú y se le asigna un valor de 0px para que no se muestre
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