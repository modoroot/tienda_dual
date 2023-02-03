<?php
session_start();
//pdo
include '../conn/conn.php';
include 'control_privilegios.php';

$opcion = $_POST['opcion'];

if ($opcion == 1) {

    $stmt = $pdo->prepare("SELECT * FROM producto_imagen");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        echo '<tr>
                <td>' . $row["id_producto_imagen"] . '</td>
                <td>' . $row['nombre'] . '</td>
                <td>' . $row['descripcion'] . '</td>
                <td>' . $row['imagen'] . '</td>
                <td>' . $row['id_producto'] . '</td>
                <td>
                     <button type="button" class="btn btn-primary btn-editar"
                     data-toggle="modal" data-target="#exampleModal" id_prod_img="' . $row['id_producto_imagen'] . '" data-whatever="@editar">Editar registro 
                        </button>
                </td>
                <td>
                    <input class="btn btn-danger btn-eliminar" id_prod_img="' . $row['id_producto_imagen'] . '" value="Eliminar" type="submit">
                </td>
            </tr>';
    }
    exit();
}

if ($opcion == 2) {
    try {
        $id_imagen = trim($_POST['id']);
        $stmt = $pdo->prepare("DELETE FROM producto_imagen WHERE id_producto_imagen=?");
        $stmt->bindParam(1, $id_imagen);
        $res = $stmt->execute([$id_imagen]);
    } catch (Exception $e) {
        $res = $e->getMessage();
    }
    echo $res;
    exit();
}


if ($opcion == 4) {
    try {
        $id_imagen = trim($_POST['id']);
        $nombre_imagen = trim($_POST['nombre_prod_img']);
        $descripcion_imagen = trim($_POST['descripcion_prod_img']);
        $ruta_imagen = trim($_POST['ruta_img']);
        $id_producto_imagen = trim($_POST['id_producto_img']);
        $file_name = $_FILES['ruta_img']['name'];
        $file_size = $_FILES['ruta_img']['size'];
        $tmp_name = $_FILES['ruta_img']['tmp_name'];
        $img_ext_valida = ['jpg','jpeg','png'];
        $img_ext = explode('.',$file_name);
        $img_ext = strtolower(end($img_ext_valida));
        if(!in_array($img_ext,$img_ext_valida)){
            echo "<script> alert('Extensión de la imagen inválida'); </script>";
        }else{
            $nuevo_img_name = $file_name;
            move_uploaded_file($tmp_name, 'img/'.$nuevo_img_name);
        }


        if ($id_imagen == "") {

            $stmt = $pdo->prepare("INSERT INTO producto_imagen VALUES (NULL,?,?,?,?)");
            $res = $stmt->execute([$nombre_imagen, $descripcion_imagen, $nuevo_img_name, $id_producto_imagen]);
        } else {
            $stmt = $pdo->prepare("UPDATE producto_imagen SET nombre =?, descripcion=?, imagen=?, id_producto=? WHERE id_producto_imagen=?");
            $res = $stmt->execute([$nombre_imagen, $descripcion_imagen, $nuevo_img_name, $id_producto_imagen, $id_imagen]);
        }
    } catch (Exception $e) {
        $res = $e->getMessage();
    }
    echo $res;
    exit();
}

if ($opcion == 5) {
    try {
        $id_imagen = trim($_POST['id']);
        $nombre_imagen = trim($_POST['nombre']);
        $descripcion_imagen = trim($_POST['descripcion']);
        $ruta_imagen = trim($_POST['imagen']);
        $id_producto_imagen = trim($_POST['id_producto']);
        $stmt = $pdo->prepare("SELECT nombre,descripcion,imagen,id_producto FROM producto_imagen WHERE id_producto_imagen=?");
        $stmt->execute([$id_imagen]);
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
                                        <form id="modal-form" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="nombre_prod_img" class="col-form-label">Nombre:</label>
                                                <input type="text" class="form-control input-nombre"
                                                       id="nombre_prod_img">
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion_prod_img"
                                                       class="col-form-label">Descripción:</label>
                                                <textarea class="form-control input-descripcion"
                                                          id="descripcion_prod_img"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="ruta_img" class="col-form-label">Imagen:</label>
                                                <input type="file" class="form-control input-ruta"
                                                       accept=".jpg,.jpeg,.png" name="ruta_img" id="ruta_img">
                                            </div>
                                            <div class="form-group">
                                                <label for="id_producto_img" class="col-form-label">Id Producto
                                                    <select name="id_producto_img"
                                                            class="form-control select-clave-ajena">
                                                        <?php
                                                        $stmt = $pdo->prepare('SELECT * FROM producto');
                                                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                        $stmt->execute();
                                                        while ($row = $stmt->fetch()) {
                                                            ?>
                                                            <option>
                                                                <?php echo $row['id_producto'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </label>
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
                                    <th>ID Imagen</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Imagen</th>
                                    <th>ID Producto</th>
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
<script src="js/tabla_entries.js"></script>

<!--<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>-->
<script src="general.js?v=<?php echo rand(); ?>"></script>
<script>
    const FICHERO = '<?php echo $fichero; ?>'
    $(document).ready(function () {
        cargaTabla();
        $(document).on('click', '.btn-eliminar', function (e) {
            eliminaRegistro($(this).attr('id_prod_img'));
        });
        $(document).on('click', '.btn-editar', function (e) {
            $("input[type=text],textarea,.select-clave-ajena,input[type=file]").val("");
            var id_prod_img = $(this).attr('id_prod_img');
            cargarRegistro(id_prod_img);
            $(".btn-guardar").off("click");
            $(".btn-guardar").click(function () {
                guardar(id_prod_img)
                $(".btCancel").click();
            });
        });
        $(document).on('click', '.btn-aniadir', function (e) {
            $("input[type=text],textarea,.select-clave-ajena,input[type=file]").val("");
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
