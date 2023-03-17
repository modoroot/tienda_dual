<?php
session_start();
//pdo
include '../conn/conn.php';
include 'control_privilegios.php';

$opcion = $_POST['opcion'];

if ($opcion == 1) {
    $stmt = $pdo->prepare("SELECT producto.id_producto, producto.nombre AS nombre_producto, producto.precio, producto.descripcion, categoria.nombre AS nombre_categoria 
                       FROM producto 
                       INNER JOIN categoria 
                       ON producto.id_categoria = categoria.id_categoria");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        echo '<tr>
            <td>' . $row["id_producto"] . '</td>
            <td>' . $row['nombre_producto'] . '</td>
            <td>' . $row['precio'] . '</td>
            <td>' . mb_substr($row['descripcion'], 0, 20) . '...' . '</td>
            <td>' . $row['nombre_categoria'] . '</td>
            <td>
                 <button type="button" class="btn btn-primary btn-editar" 
                 data-toggle="modal" data-target="#exampleModal" id_prod="' . $row['id_producto'] . '" data-whatever="@editar">Editar registro 
                    </button>
            </td>
            <td>
                <input class="btn btn-danger btn-eliminar" id_prod="' . $row['id_producto'] . '" value="Eliminar" type="submit">
            </td>
        </tr>';
    }
    exit();
}

if ($opcion == 2) {
    try {
        $id_producto = trim($_POST['id']);
        $stmt = $pdo->prepare("DELETE FROM producto WHERE id_producto=?");
        $stmt->bindParam(1, $id_producto);
        $res = $stmt->execute([$id_producto]);
    } catch (Exception $e) {
        $res = $e->getMessage();
    }
    echo $res;
    exit();
}


if ($opcion == 4) {
    try {
        $id_producto = trim($_POST['id']);
        $nombre_producto = trim($_POST['nombre_prod']);
        $precio_producto = trim($_POST['precio_prod']);
        $descripcion_producto = trim($_POST['descripcion_prod']);
        $id_categoria_producto = trim($_POST['id_categoria_prod']);
        if ($id_producto == "") {
            $stmt = $pdo->prepare("INSERT INTO producto VALUES (NULL, ?,?,?,?)");
            $res = $stmt->execute([$nombre_producto, $precio_producto, $descripcion_producto, $id_categoria_producto]);
        } else {
            $stmt = $pdo->prepare("UPDATE producto SET nombre =?, precio=?, descripcion=?, id_categoria=? WHERE id_producto=?");
            $res = $stmt->execute([$nombre_producto, $precio_producto, $descripcion_producto, $id_categoria_producto, $id_producto]);
        }
    } catch (Exception $e) {
        $res = $e->getMessage();
    }
    echo $res;
    exit();
}

if ($opcion == 5) {
    try {
        $id_producto = trim($_POST['id']);
        $nombre_producto = trim($_POST['nombre']);
        $precio_producto = trim($_POST['precio']);
        $descripcion_producto = trim($_POST['descripcion']);
        $id_categoria_producto = $_POST['id_categoria'];
        $stmt = $pdo->prepare("SELECT nombre,precio,descripcion,id_categoria FROM producto WHERE id_producto=?");
        $stmt->execute([$id_producto]);
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
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tablas - Framerate</title>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                            <button type="button" class="btn btn-primary btn-aniadir" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Añadir nuevo registro
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <label for="nombre_prod" class="col-form-label">Nombre:</label>
                                                    <input type="text" class="form-control input-nombre" id="nombre_prod">
                                                </div>
                                                <div class="form-group">
                                                    <label for="precio_prod" class="col-form-label">Precio:</label>
                                                    <input type="text" class="form-control input-precio" id="precio_prod">
                                                </div>
                                                <div class="form-group">
                                                    <label for="descripcion_prod" class="col-form-label">Descripción:</label>
                                                    <textarea class="form-control input-descripcion" id="descripcion_prod"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_categoria_prod" class="col-form-label">Categoría
                                                        <select name="id_categoria_prod" class="form-control select-clave-ajena-categoria">
                                                            <?php
                                                            // Preparar la consulta SQL para seleccionar la columna 'id_categoria' y 'nombre' de la tabla 'categoria'.
                                                            $stmt = $pdo->prepare('SELECT id_categoria,nombre FROM categoria');

                                                            // Establecer el modo de recuperación de datos como FETCH_ASSOC.
                                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);

                                                            // Ejecutar la consulta SQL.
                                                            $stmt->execute();

                                                            // Iterar sobre los resultados obtenidos de la consulta SQL y generar opciones de selección de categoría en el formulario HTML.
                                                            while ($row = $stmt->fetch()) {
                                                            ?>
                                                                <option value="<?php echo $row['id_categoria']; ?>">
                                                                    <?php echo $row['nombre']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalImagen" data-whatever="@mdo"><i class="bi bi-images"> Examinar
                                                            imagen</i>
                                                    </button>
                                                </div>
                                                <div class="form-group">
                                                    <div class="vista-previa-multiple" id="vista-previa-multiple">

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btCancel" data-dismiss="modal">
                                                Cerrar
                                            </button>
                                            <input class="btn btn-info btn-guardar" value="Guardar" type="submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Modal de la imagen-->
                            <div class="modal fade" id="modalImagen" tabindex="-1" role="dialog" aria-labelledby="modalImagenLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalImagenLabel">Examinar imagen</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nombre_prod_img" class="col-form-label">Nombre:</label>
                                                <input type="text" class="form-control input-nombre" id="nombre_prod_img">
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion_prod_img" class="col-form-label">Descripción:</label>
                                                <textarea class="form-control input-descripcion" id="descripcion_prod_img"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="ruta_img" class="col-form-label">Imagen:</label>
                                                <input type="file" class="form-control input-ruta" accept=".jpg,.jpeg,.png" name="ruta_img" id="ruta_img">
                                            </div>
                                            <div class="form-group">
                                                <img id="vista-previa" src="#" alt="Vista previa de la imagen" style="max-width: 50%;">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btCancelModalImagen" data-dismiss="modal">
                                                Cerrar
                                            </button>
                                            <button id="guardar-imagen" class="btn btn-info" data-dismiss="modal" type="button">Guardar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Final modal imagen-->
                            <div style="overflow-x:auto;">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID Producto</th>
                                            <th>Nombre</th>
                                            <th>Precio (€)</th>
                                            <th>Descripción</th>
                                            <th>Categoría</th>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script src="general.js?v=<?php echo rand(); ?>"></script>
<script>
    // Espera a que el documento esté completamente cargado
    $(document).ready(function () {
        // Detecta cambios en el input con el id "ruta_img"
        $("#ruta_img").change(function () {
            // Obtiene el archivo seleccionado en el input
            var file = this.files[0];
            // Crea un objeto FileReader para leer el archivo
            var reader = new FileReader();
            // Cuando se termina de leer el archivo
            reader.onloadend = function () {
                // Muestra la imagen en en el elemento ID "vista-previa"
                $("#vista-previa").attr("src", reader.result);
            }

            // Evento para guardar la imagen seleccionada cuando se hace clic en el botón "Guardar Imagen"
            $('#guardar-imagen').on('click', function() {
                guardarImagenSeleccionada();

                // Cerrar la ventana modal
                $('#modal-imagen').modal('hide');
            });
        });
    });
    </script>
    <script>
        const FICHERO = '<?php echo $fichero; ?>'
        $(document).ready(function() {
            cargaTabla();
            $(document).on('click', '.btn-eliminar', function(e) {
                eliminaRegistro($(this).attr('id_prod'));
            });
            $(document).on('click', '.btn-editar', function(e) {
                $("input[type=text],textarea,.select-clave-ajena-categoria").val("");
                var id_prod = $(this).attr('id_prod');
                cargarRegistro(id_prod)
                $(".btn-guardar").off("click");
                $(".btn-guardar").click(function() {
                    guardar(id_prod)
                    $(".btCancel").click();
                });
            });
            $(document).on('click', '.btn-aniadir', function(e) {
                $("input[type=text],textarea,.select-clave-ajena-categoria").val("");
                $(".btn-guardar").off("click");
                $(".btn-guardar").click(function() {
                    guardar("");
                    $(".btCancel").click();
                });
            });

        });
    </script>
</body>

</html>