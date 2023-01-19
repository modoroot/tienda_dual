<?php
session_start();
//pdo
include '../conn/conn.php';
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
}
$nombre = $_SESSION['nombre'];
$id_usuario = $_SESSION['id_usuario'];
$id_privilegio = $_SESSION['id_privilegio'];
if ($id_privilegio == 1) {
    $where = "";
} else {
    $where = "WHERE id_usuario=$id_usuario";
}
$stmt = $pdo->prepare("SELECT * FROM producto $where");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Tablas - Framerate</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<?php
include "header.php";
?>
<div id="layoutSidenav">
    <?php
    include 'sidebar.php';
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Tablas</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="principal.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tablas</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>ID_Producto</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>ID_Categoría</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID_Producto</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>ID_Categoría</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            while ($row = $stmt->fetch()) {
                                ?>
                                <tr>
                                    <td><?php echo $row["id_producto"] ?></td>
                                    <td><?php echo $row['nombre'] ?></td>
                                    <td><?php echo $row['precio'] ?></td>
                                    <td><?php echo $row['id_categoria'] ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <?php
        include "footer.php";
        ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>
</html>
