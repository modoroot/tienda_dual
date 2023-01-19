<?php
session_start();
//pdo
include '../conn/conn.php';

$nombre = $_SESSION['nombre'];
$id_usuario = $_SESSION['id_usuario'];
$id_privilegio = $_SESSION['id_privilegio'];

$opcion = $_POST['opcion'];

if ($opcion == 1) {
    if ($id_privilegio == 1) {
        $where = "";
    } else {
        $where = "WHERE id_usuario=$id_usuario";
    }
    $stmt = $pdo->prepare("SELECT * FROM privilegio $where");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        echo '<tr>
                <td>' . $row["id_privilegio"] . '</td>
                <td>' . $row['nombre'] . '</td>
                <td>' . $row['descripcion'] . '</td>
                <td>
                    <input class="btn btn-info btn-editar" id_priv="' . $row['id_privilegio'] . '" value="Editar" type="submit">
                </td>
                <td>
                    <input class="btn btn-danger btn-eliminar" id_priv="' . $row['id_privilegio'] . '" value="Eliminar" type="submit">
                </td>
            </tr>';
    }
    exit();
}

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
}

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
    <!--<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet"/>-->
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<?php include 'header.php';?>
<div id="layoutSidenav">
    <?php include "sidebar.php";?>
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
                        <input class="btn btn-info btn-aniadir" value="Añadir registro" type="submit">
                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>ID Privilegio</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <?php include 'footer.php';?>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>-->
<script src="general.js"></script>
<script>
    $(document).ready(function () {
        cargaTabla();
        $(document).on('click', '.btn-eliminar',function(e){
            console.log($(this).attr('id_priv'));
        });
    });
</script>
</body>
</html>
