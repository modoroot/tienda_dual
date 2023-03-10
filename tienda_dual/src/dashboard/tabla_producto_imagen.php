<?php
// se inicia una sesión
session_start();

// se incluyen los archivos necesarios
// conexión a la base de datos
include '../conn/conn.php';
// archivo de control de privilegios
include 'control_privilegios.php';

// se obtiene el valor del parámetro "opcion" enviado por POST
$opcion = $_POST['opcion'];

// si la opción es 1
if ($opcion == 1) {

    // se prepara una consulta SQL para obtener información de las imágenes de los productos, incluyendo el nombre del producto al que pertenece cada imagen
    $stmt = $pdo->prepare("SELECT pi.id_producto_imagen, pi.nombre, pi.descripcion, pi.imagen, p.nombre AS nombre_producto, pi.id_producto 
                       FROM producto_imagen AS pi 
                       INNER JOIN producto AS p 
                       ON pi.id_producto = p.id_producto");

    // se configura el modo de recuperación de los datos de la consulta (en este caso, como un arreglo asociativo)
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // se ejecuta la consulta en la base de datos
    $stmt->execute();

    // se recorren los resultados obtenidos y se imprimen en formato HTML
    while ($row = $stmt->fetch()) {
        echo '<tr>
            <td>' . $row["id_producto_imagen"] . '</td>
            <td>' . $row['nombre'] . '</td>
            <td>' . mb_substr($row['descripcion'], 0, 20) . '...' . '</td>
            <td>' . $row['imagen'] . '</td>
            <td>' . $row['nombre_producto'] . '</td>
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

    // se finaliza la ejecución del script
    exit();
}

// Si la variable $opcion es igual a 2, se procede a eliminar una imagen de un producto
if ($opcion == 2) {
    try {
        // Se recupera el ID de la imagen a eliminar desde el array $_POST
        $id_imagen = trim($_POST['id']);

        // Se prepara la consulta para eliminar la imagen en la tabla "producto_imagen"
        $stmt = $pdo->prepare("DELETE FROM producto_imagen WHERE id_producto_imagen=?");

        // Se asigna el valor del ID de la imagen a eliminar a la consulta preparada
        $stmt->bindParam(1, $id_imagen);

        // Se ejecuta la consulta preparada
        $res = $stmt->execute([$id_imagen]);
    } catch (Exception $e) {
        // Si se produce un error al ejecutar la consulta, se almacena el mensaje de error en la variable $res
        $res = $e->getMessage();
    }

    // Se muestra el resultado de la operación (éxito o error)
    echo $res;

    // Se finaliza la ejecución del script
    exit();
}


// Si la variable $opcion es igual a 4, se procede a agregar o actualizar una imagen de un producto
if ($opcion == 4) {
    try {
        // Se recuperan los datos de la imagen desde el array $_POST y se limpian
        $id_imagen = trim($_POST['id']);
        $nombre_imagen = trim($_POST['nombre_prod_img']);
        $descripcion_imagen = trim($_POST['descripcion_prod_img']);
        $ruta_imagen = trim($_POST['ruta_img']);
        $id_producto_imagen = trim($_POST['id_producto_img']);

        // Se recuperan los datos del archivo de imagen subido
        $file_name = $_FILES['ruta_img']['name'];
        $file_size = $_FILES['ruta_img']['size'];
        $tmp_name = $_FILES['ruta_img']['tmp_name'];

        // Se comprueba que la extensión del archivo subido sea válida
        $img_ext_valida = ['jpg', 'jpeg', 'png'];
        $img_ext = explode('.', $file_name);
        $img_ext = strtolower(end($img_ext_valida));
        if (!in_array($img_ext, $img_ext_valida)) {
            // Si la extensión del archivo no es válida, se muestra una alerta con un mensaje de error
            echo "<script> alert('Extensión de la imagen inválida'); </script>";
        } else {
            // Si la extensión del archivo es válida, se guarda el archivo subido en el directorio "img" con su nombre original
            $nuevo_img_name = $file_name;
            move_uploaded_file($tmp_name, 'img/' . $nuevo_img_name);
        }

        // Si el ID de la imagen a agregar o actualizar está vacío, se procede a agregar una nueva imagen
        if ($id_imagen == "") {
            // Se prepara la consulta para agregar la nueva imagen en la tabla "producto_imagen"
            $stmt = $pdo->prepare("INSERT INTO producto_imagen VALUES (NULL,?,?,?,?)");

            // Se asignan los valores de los campos de la nueva imagen a la consulta preparada
            $res = $stmt->execute([$nombre_imagen, $descripcion_imagen, $nuevo_img_name, $id_producto_imagen]);
        }
    } catch (Exception $e) {
        $res = $e->getMessage();
    }
    echo $res;
    exit();
}

// Verifica si la opción enviada es igual a 5
if ($opcion == 5) {
    try {
        // Obtiene los valores enviados por POST y los almacena en variables
        $id_imagen = trim($_POST['id']);
        $nombre_imagen = trim($_POST['nombre']);
        $descripcion_imagen = trim($_POST['descripcion']);
        $ruta_imagen = trim($_POST['imagen']);
        $id_producto_imagen = trim($_POST['id_producto']);
        // Prepara una consulta SQL para seleccionar el nombre, descripción, imagen y ID del producto de la tabla producto_imagen
        $stmt = $pdo->prepare("SELECT nombre,descripcion,imagen,id_producto FROM producto_imagen WHERE id_producto_imagen=?");
        // Ejecuta la consulta SQL con el valor del ID de la imagen
        $stmt->execute([$id_imagen]);
        // Almacena el resultado de la consulta en un arreglo asociativo
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // Si ocurre una excepción, almacena el mensaje de error en una variable
        $res = $e->getMessage();
    }
    // Codifica el arreglo asociativo en formato JSON y lo imprime
    echo json_encode($res);
    // Finaliza la ejecución del script
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
    <!--<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet"/>-->
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
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
                            <!--                        Modal Registro-->
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
                            <div style="overflow-x:auto;">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID Imagen</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Imagen</th>
                                            <th>Producto</th>
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
    <script src="js/tabla_entries.js"></script>

    <script src="general.js?v=<?php echo rand(); ?>"></script>
    <script>
        const FICHERO = '<?php echo $fichero; ?>'
        $(document).ready(function() {
            cargaTabla();
            $(document).on('click', '.btn-eliminar', function(e) {
                eliminaRegistro($(this).attr('id_prod_img'));
            });
            $(document).on('click', '.btn-editar', function(e) {
                $("input[type=text],textarea,.select-clave-ajena-producto,input[type=file]").val("");
                var id_prod_img = $(this).attr('id_prod_img');
                cargarRegistro(id_prod_img);
                $(".btn-guardar").off("click");
                $(".btn-guardar").click(function() {
                    guardar(id_prod_img)
                    $(".btCancel").click();
                });
            });
            $(document).on('click', '.btn-aniadir', function(e) {
                $("input[type=text],textarea,.select-clave-ajena-producto,input[type=file]").val("");
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