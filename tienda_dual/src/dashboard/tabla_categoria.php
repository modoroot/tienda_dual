<?php
session_start();
//pdo
include '../conn/conn.php';
include 'control_privilegios.php';

$opcion = $_POST['opcion'];

// Comprueba si la variable $opcion es igual a 1
if ($opcion == 1) {
// Se prepara una consulta SQL para seleccionar todos los registros de la tabla "categoria"
    $stmt = $pdo->prepare("SELECT * FROM categoria");
// Se establece el modo de recuperación de datos en PDO::FETCH_ASSOC, que devuelve un array indexado por nombre de columna
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
// Se ejecuta la consulta preparada
    $stmt->execute();
// Se itera a través de los resultados de la consulta y se imprime una fila por cada registro
    while ($row = $stmt->fetch()) {
        echo '<tr>
            <td>' . $row["id_categoria"] . '</td>
            <td>' . $row['nombre'] . '</td>
            <td>' . substr($row['descripcion'], 0, 20) . '...' . '</td>
            <td>' . $row['img'] . '</td>
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

// Se interrumpe la ejecución del script
    exit();
}
// Comprueba si la variable $opcion es igual a 2
if ($opcion == 2) {
// Se intenta realizar una operación de eliminación en la base de datos
    try {
        // Se obtiene el ID de la categoría a eliminar desde los datos enviados por POST
        $id_categoria = trim($_POST['id']);

        // Se prepara una consulta SQL para eliminar el registro correspondiente a la categoría especificada
        $stmt = $pdo->prepare("DELETE FROM categoria WHERE id_categoria=?");

        // Se enlaza el parámetro del ID de categoría con la consulta preparada
        $stmt->bindParam(1, $id_categoria);

        // Se ejecuta la consulta preparada, pasando el ID de la categoría como parámetro
        $res = $stmt->execute([$id_categoria]);
    } // Si se produce una excepción durante el proceso de eliminación, se captura y se almacena en $res el mensaje de error
    catch (Exception $e) {
        $res = $e->getMessage();
    }

// Se imprime el resultado de la operación de eliminación (el número de filas afectadas o el mensaje de error)
    echo $res;

// Se interrumpe la ejecución del script
    exit();
}
// Comprueba si la variable $opcion es igual a 4
if ($opcion == 4) {
    // Se intenta realizar una operación de inserción o actualización en la base de datos
    try {
        // Se obtienen los datos de la categoría desde los datos enviados por POST
        $id_categoria = trim($_POST['id']);
        $nombre_categoria = trim($_POST['nombre_cat']);
        $descripcion_categoria = trim($_POST['descripcion_cat']);
        $ruta_imagen = trim($_POST['ruta_img']);
        $id_producto_imagen = trim($_POST['id_producto_img']);

        // Se obtienen los datos del archivo de imagen subido
        $file_name = $_FILES['ruta_img']['name'];
        $file_size = $_FILES['ruta_img']['size'];
        $tmp_name = $_FILES['ruta_img']['tmp_name'];

        // Se comprueba si la extensión del archivo es válida
        $img_ext_valida = ['jpg', 'jpeg', 'png'];
        $img_ext = explode('.', $file_name);
        $img_ext = strtolower(end($img_ext_valida));
        if (!in_array($img_ext, $img_ext_valida)) {
            echo "<script> alert('Extensión de la imagen inválida'); </script>";
        } // Si la extensión del archivo es válida, se mueve el archivo a la carpeta de imágenes
        else {
            $nuevo_img_name = $file_name;
            move_uploaded_file($tmp_name, 'img/' . $nuevo_img_name);
        }
        // Si el ID de categoría es vacío, se prepara una consulta SQL para
        // insertar un nuevo registro en la tabla de categorías
        if ($id_categoria == "") {
            $stmt = $pdo->prepare("INSERT INTO categoria VALUES (NULL, ?,?,?)");
            $res = $stmt->execute([$nombre_categoria, $descripcion_categoria, $nuevo_img_name]);
        } // Si el ID de categoría no es vacío, se prepara una consulta SQL para actualizar
        // el registro correspondiente en la tabla de categorías
        else {
            $stmt = $pdo->prepare("UPDATE categoria SET nombre =?, descripcion =?, img=? WHERE id_categoria=?");
            $res = $stmt->execute([$nombre_categoria, $descripcion_categoria, $nuevo_img_name, $id_categoria]);
        }
    } // Si se produce una excepción durante el proceso de inserción o actualización,
        // se captura y se almacena en $res el mensaje de error
    catch (Exception $e) {
        $res = $e->getMessage();
    }

// Se imprime el resultado de la operación de inserción o actualización
// (ya sea el número de filas afectadas o el mensaje de error)
    echo $res;

// Se interrumpe la ejecución del script
    exit();
}
// Comprueba si la variable $opcion es igual a 5
if ($opcion == 5) {
    try {
        // Se obtienen los valores de los campos enviados por POST
        $id_categoria = trim($_POST['id']);
        $nombre_categoria = trim($_POST['nombre']);
        $descripcion_categoria = trim($_POST['descripcion']);
        $ruta_imagen = trim($_POST['img']);

        // Se prepara y ejecuta la consulta para obtener los datos de la categoría con el id indicado
        $stmt = $pdo->prepare("SELECT nombre,descripcion,img FROM categoria WHERE id_categoria=?");
        $stmt->execute([$id_categoria]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC); // Se obtiene la fila de resultados como un array asociativo
    } catch (Exception $e) {
        $res = $e->getMessage(); // Si ocurre un error, se captura el mensaje y se guarda en $res
    }
    echo json_encode($res); // Se devuelve la fila de resultados en formato JSON
    exit(); // Se termina la ejecución del script
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
                                                <label for="nombre_cat" class="col-form-label">Nombre:</label>
                                                <input type="text" class="form-control input-nombre" id="nombre_cat">
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion_cat"
                                                       class="col-form-label">Descripción:</label>
                                                <textarea class="form-control input-desc"
                                                          id="descripcion_cat"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="ruta_img" class="col-form-label">Imagen:</label>
                                                <input type="file" class="form-control input-ruta"
                                                       accept=".jpg,.jpeg,.png" name="ruta_img" id="ruta_img">
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
                                    <th>Imagen</th>
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
    // Guarda el nombre del fichero para ser utilizado en las funciones de ajax
    const FICHERO = '<?php echo $fichero;  ?>'
    // Controlador de eventos que se ejecuta cuando el documento está listo para ser manipulado
    $(document).ready(function () {
        // Carga la tabla con los datos de la base de datos
        cargaTabla();
        // Controlador de eventos que se ejecuta cuando se pulsa el botón de eliminar
        $(document).on('click', '.btn-eliminar', function (e) {
            // Elimina el registro de la base de datos según el id_cat
            eliminaRegistro($(this).attr('id_cat'));
        });
        // Controlador de eventos que se ejecuta cuando se pulsa el botón de editar
        $(document).on('click', '.btn-editar', function (e) {
            // Limpia los campos del formulario
            $("input[type=text],textarea,input[type=file]").val("");
            // Carga los datos del registro en el formulario
            var id_cat = $(this).attr('id_cat');
            // Carga el registro según el id_cat
            cargarRegistro(id_cat);
            // Desactiva el controlador de eventos del botón de guardar
            $(".btn-guardar").off("click");
            // Controlador de eventos que se ejecuta cuando se pulsa el botón de guardar
            $(".btn-guardar").click(function () {
                // Guarda los datos del formulario en la base de datos
                guardar(id_cat);
                // Cierra el modal
                $(".btCancel").click();
            });
        });
        // Controlador de eventos que se ejecuta cuando se pulsa el botón de añadir
        $(document).on('click', '.btn-aniadir', function (e) {
            // Limpia los campos del formulario
            $("input[type=text],textarea,input[type=file]").val("");
            // Desactiva el controlador de eventos del botón de guardar
            $(".btn-guardar").off("click");
            // Controlador de eventos que se ejecuta cuando se pulsa el botón de guardar
            $(".btn-guardar").click(function () {
                // Añade un registro a la base de datos. Utiliza la misma función que el botón de editar,
                // pero en este caso no se pasa ningún ID porque se está añadiendo un registro nuevo
                guardar("");
                // Cierra el modal
                $(".btCancel").click();
            });
        });

    });
</script>
</body>
</html>
