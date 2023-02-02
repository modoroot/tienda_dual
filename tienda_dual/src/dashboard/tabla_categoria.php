<?php
session_start();
//pdo
include '../conn/conn.php';
include 'control_privilegios.php';

$opcion = $_POST['opcion'];

if ($opcion == 1) {

    $stmt = $pdo->prepare("SELECT * FROM categoria");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        echo '<tr>
                <td>' . $row["id_categoria"] . '</td>
                <td>' . $row['nombre'] . '</td>
                <td>' . $row['descripcion'] . '</td>
                <td>
                     <button type="button" class="btn btn-primary btn-editar" 
                     data-toggle="modal" data-target="#exampleModal" id_cat="' . $row['id_categoria'] . '" data-whatever="@editar">Editar registro 
                        </button>
                </td>
                <td>
                    <input class="btn btn-danger btn-eliminar" id_cat="' . $row['id_categoria'] . '" value="Eliminar" type="submit">
                </td>
            </tr>';
    }
    exit();
}

if ($opcion == 2) {
    try {
        $id_categoria = trim($_POST['id']);
        $stmt = $pdo->prepare("DELETE FROM categoria WHERE id_categoria=?");
        $stmt->bindParam(1, $id_categoria);
        $res = $stmt->execute([$id_categoria]);
    } catch (Exception $e) {
        $res = $e->getMessage();
    }
    echo $res;

    exit();
}

if ($opcion == 3) {
    try {
        $nombre_categoria = trim($_POST['nombre']);
        $descripcion_categoria = trim($_POST['descripcion']);
        $stmt = $pdo->prepare("INSERT INTO categoria VALUES (NULL, ?,?)");
        $res = $stmt->execute([$nombre_categoria, $descripcion_categoria]);
    } catch (Exception $e) {
        $res = $e->getMessage();
    }
    echo $res;
    exit();
}

if ($opcion == 4) {
    try {
        $id_categoria = trim($_POST['id']);
        $nombre_categoria = trim($_POST['nombre_cat']);
        $descripcion_categoria = trim($_POST['descripcion_cat']);
        if ($id_categoria == "") {
            $stmt = $pdo->prepare("INSERT INTO categoria VALUES (NULL, ?,?)");
            $res = $stmt->execute([$nombre_categoria, $descripcion_categoria]);
        } else {
            $stmt = $pdo->prepare("UPDATE categoria SET nombre =?, descripcion =? WHERE id_categoria=?");
            $res = $stmt->execute([$nombre_categoria, $descripcion_categoria, $id_categoria]);
        }
    } catch (Exception $e) {
        $res = $e->getMessage();
    }
    echo $res;
    exit();
}

if ($opcion == 5) {
    try {
        $id_categoria = trim($_POST['id']);
        $nombre_categoria = trim($_POST['nombre']);
        $descripcion_categoria = trim($_POST['descripcion']);
        $stmt = $pdo->prepare("SELECT nombre,descripcion FROM categoria WHERE id_categoria=?");
        $stmt->execute([$id_categoria]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $res = $e->getMessage();
    }
    echo json_encode($res);
    exit();
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

</head>
<body class="sb-nav-fixed">
<?php include 'header.php'; ?>
<div id="layoutSidenav">
    <?php include "sidebar.php"; ?>
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
                        <button type="button" class="btn btn-primary btn-aniadir" data-toggle="modal"
                                data-target="#exampleModal"
                                data-whatever="@mdo">Añadir nuevo registro
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
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
                                                <label for="nombre_cat" class="col-form-label">Nombre:</label>
                                                <input type="text" class="form-control input-nombre" id="nombre_cat">
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion_cat"
                                                       class="col-form-label">Descripción:</label>
                                                <textarea class="form-control input-desc"
                                                          id="descripcion_cat"></textarea>
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
                        <div style="overflow-x:auto;">
                            <table id="datatablesSimple">
                                <thead>
                                <tr>
                                    <th>ID Categoría</th>
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
            </div>
        </main>
        <?php include 'footer.php'; ?>
    </div>
</div>

<script src="js/scripts.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<!--<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>-->
<script src="general.js?v=<?php echo rand(); ?>"></script>
<script>
    const FICHERO = '<?php echo $fichero; ?>'
    $(document).ready(function () {
        cargaTabla();
        $(document).on('click', '.btn-eliminar', function (e) {
            eliminaRegistro($(this).attr('id_cat'));
        });
        $(document).on('click', '.btn-editar', function (e) {
            $("input[type=text],textarea").val("");
            var id_cat = $(this).attr('id_cat');
            cargarRegistro(id_cat)
            $(".btn-guardar").off("click");
            $(".btn-guardar").click(function () {
                guardar(id_cat)
                $(".btCancel").click();
            });
        });
        $(document).on('click', '.btn-aniadir', function (e) {
            $("input[type=text],textarea").val("");
            $(".btn-guardar").off("click");
            $(".btn-guardar").click(function () {
                guardar("");
                $(".btCancel").click();
            });
        });

    });
</script>
</body>
</html>
