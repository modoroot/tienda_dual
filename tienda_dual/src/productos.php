<?php
include_once "conn/config.php";
include_once "conn/conn.php";
//ID del producto que se ha seleccionado
$id_producto = $_GET['id'] ?? '';
//Token de seguridad
$token = $_GET['token'] ?? '';
if ($id_producto == '' || $token == '') {
    echo "Error en la petición";
    exit;
} else {
    $token_tmp = hash_hmac('sha1', $id_producto, KEY_TOKEN);
    if ($token != $token_tmp) {
        echo "Error en la petición";
        exit;
    }
}
include_once 'header_frontend.php';
?>
<div class="container-title">
    <?php
    $stmt = $pdo->prepare("SELECT * FROM producto WHERE id_producto = $id_producto");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $result) {
        echo "<h1>{$result['nombre']}</h1>";
    }
    ?>
</div>
<main>
    <div class="container-img">
        <?php
        $stmt = $pdo->prepare("SELECT * FROM producto_imagen WHERE id_producto = $id_producto");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $result) {
            echo "<img src='dashboard/img/{$result['imagen']}' alt='Imagen producto'>";
        }
        ?>
    </div>
    <div class="container-info-producto">
        <div class="container-price">
            <?php
            $stmt = $pdo->prepare("SELECT * FROM producto WHERE id_producto = $id_producto");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $result) {
                echo "<h2>{$result['precio']} €</h2>";
            }
            ?>
        </div>
        <div class="container-details-producto">
        </div>
        <div class="container-add-cart">
            <div class="container-quantity">
                <input class="input-quantity" type="number" placeholder="1" value="1" min="1" readonly/>
                <div class="btn-incrementar-decrementar">
                    <i class="fa-solid fa-chevron-up" id="incrementar"></i>
                    <i class="fa-solid fa-chevron-down" id="decrementar"></i>
                </div>
            </div>
            <a href="carrito.php">
                <button class="btn-add-to-cart"><i
                            class="fa-solid fa-plus"></i>
                    Añadir al carrito
                </button>
            </a>
        </div>
        <div class="container-description">
            <div class="titulo-description">
                <h4>Descripción</h4>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="text-description hidden">
                <?php
                $stmt = $pdo->prepare("SELECT * FROM producto WHERE id_producto = $id_producto");
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($results as $result) {
                    echo "<p>{$result['descripcion']}</p>";
                }
                ?>
            </div>
        </div>
        <div class="container-info">
            <div class="titulo-info">
                <h4>Requisitos</h4>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="text-info hidden">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, adipisci, alias amet
                    animi
                    asperiores atque autem</p>
            </div>
        </div>
        <div class="container-resenias">
            <div class="titulo-resenias">
                <h4>Reseñas</h4>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="text-resenias hidden">
                <p>"Es la polla" - Enrique</p>
            </div>
        </div>
        <div class="container-compartir">
            <span>Compartir</span>
            <div class="container-button-social">
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-steam"></i></a>
                <a href="#"><i class="fa-brands fa-discord"></i></a>
            </div>
        </div>
    </div>
</main>
<section class="productos-relacionados">
    <h2>Productos relacionados</h2>
    <div class="card-list-productos">
        <div class="card">
            <div class="card-img">
                <img src="img/elden-ring-banner.jpg" alt="Imagen ejemplo">
            </div>
            <div class="info-card">
                <div class="text-producto">
                    <h3>Producto</h3>
                    <p class="categoria">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium,
                        adipisci, alias amet animi
                        asperiores atque autem</p>
                </div>
                <div class="precio">
                    <span>$123</span>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-img">
                <img src="img/elden-ring-banner.jpg" alt="Imagen ejemplo">
            </div>
            <div class="info-card">
                <div class="text-producto">
                    <h3>Producto</h3>
                    <p class="categoria">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium,
                        adipisci, alias amet animi
                        asperiores atque autem</p>
                </div>
                <div class="precio">
                    <span>$123</span>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-img">
                <img src="img/elden-ring-banner.jpg" alt="Imagen ejemplo">
            </div>
            <div class="info-card">
                <div class="text-producto">
                    <h3>Producto</h3>
                    <p class="categoria">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium,
                        adipisci, alias amet animi
                        asperiores atque autem</p>
                </div>
                <div class="precio">
                    <span>$123</span>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<?php include "footer_frontend.php"; ?>
<script src="js/main.js?v=<?php echo rand(); ?>"></script>
<script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
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