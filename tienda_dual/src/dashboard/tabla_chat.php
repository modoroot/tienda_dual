<?php
session_start();
//pdo
include '../conn/conn.php';
include 'control_privilegios.php';

$opcion = $_POST['opcion'];

// Comprueba si la variable $opcion es igual a 1
if ($opcion == 1) {
// Se prepara una consulta SQL para seleccionar todos los registros de la tabla "categoria"
    $stmt = $pdo->prepare("SELECT * FROM chat");
// Se establece el modo de recuperación de datos en PDO::FETCH_ASSOC, que devuelve un array indexado por nombre de columna
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
// Se ejecuta la consulta preparada
    $stmt->execute();
// Se itera a través de los resultados de la consulta y se imprime una fila por cada registro
    while ($row = $stmt->fetch()) {
        echo '<tr>
            <td>' . $row["id_mensaje"] . '</td>
            <td>' . $row['id_session'] . '</td>
            <td>' . substr($row['mensaje'], 0, 20) . '...' . '</td>
            <td>' . $row['fecha'] . '</td>
            <td>' . $row['cliente'] . '</td>
            <td>
                 <button type="button" class="btn btn-primary btn-abrir-chat"
                 data-toggle="modal" data-target="#exampleModal" id_msg="' . $row['id_mensaje'] . '" id_session="' . $row['id_session'] . '" data-whatever="@editar">Abrir chat
                    </button>
            </td>
            <td>
                <input class="btn btn-danger btn-eliminar" id_msg="' . $row['id_mensaje'] . '" value="Eliminar" type="submit">
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
        $id_mensaje = trim($_POST['id']);

        // Se prepara una consulta SQL para eliminar el registro correspondiente a la categoría especificada
        $stmt = $pdo->prepare("DELETE FROM chat WHERE id_mensaje=?");

        // Se enlaza el parámetro del ID de categoría con la consulta preparada
        $stmt->bindParam(1, $id_mensaje);

        // Se ejecuta la consulta preparada, pasando el ID de la categoría como parámetro
        $res = $stmt->execute([$id_mensaje]);
    } // Si se produce una excepción durante el proceso de eliminación, se captura y se almacena en $res el mensaje de error
    catch (Exception $e) {
        $res = $e->getMessage();
    }

// Se imprime el resultado de la operación de eliminación (el número de filas afectadas o el mensaje de error)
    echo $res;

// Se interrumpe la ejecución del script
    exit();
}
// Comprueba si la variable $opcion es igual a 5
//if ($opcion == 5) {
//    try {
//        // Se obtienen los valores de los campos enviados por POST
//        $id_mensaje = trim($_POST['id']);
//        $nombre_categoria = trim($_POST['nombre']);
//        $descripcion_categoria = trim($_POST['descripcion']);
//        $ruta_imagen = trim($_POST['img']);
//
//        // Se prepara y ejecuta la consulta para obtener los datos de la categoría con el id indicado
//        $stmt = $pdo->prepare("SELECT nombre,descripcion,img FROM categoria WHERE id_categoria=?");
//        $stmt->execute([$id_mensaje]);
//        // Se obtiene la fila de resultados como un array asociativo
//        $res = $stmt->fetch(PDO::FETCH_ASSOC);
//    } catch (Exception $e) {
//        // Si ocurre un error, se captura el mensaje y se guarda en $res
//        $res = $e->getMessage();
//    }
//    // Se devuelve la fila de resultados en formato JSON
//    echo json_encode($res);
//    // Se termina la ejecución del script
//    exit();
//}
if($opcion == 6){
    try {
        // Se obtienen los valores de los campos enviados por POST
        $id_session = trim($_POST['id_session']);
        $mensaje = trim($_POST['mensaje']);
        $fecha = trim($_POST['fecha']);
        $cliente = trim($_POST['cliente']);

        // Se prepara y ejecuta la consulta para obtener los datos de la categoría con el id indicado
        $stmt = $pdo->prepare("SELECT mensaje,fecha FROM chat WHERE id_session=?");
        $stmt->execute([$id_session]);
        // Se obtiene la fila de resultados como un array asociativo
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
    }catch (Exception $e) {
        // Si ocurre un error, se captura el mensaje y se guarda en $res
        $res = $e->getMessage();
    }
    echo json_encode($res);
    exit;
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
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
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
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <!--Titulo-->
                                        <h5 class="modal-title" id="exampleModalLabel">Chat</h5>
                                        <!--Botón para cerrar la ventana modal-->
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="chat-container">
                                            <div class="chat-body">
                                                <ul class="lista-mensajes">
                                                   <li class="mensaje-lista"></li>
                                                </ul>
                                            </div>
                                            <div class="chat-footer">
                                                <input type="text" class="form-control"
                                                       placeholder="Escribe un mensaje...">
                                                <button id="enviar-mensaje" class="btn btn-primary">Enviar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <!--Botón para cerrar la ventana modal-->
                                        <button type="button" class="btn btn-secondary btCancel" data-dismiss="modal">
                                            Cerrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin ventana modal-->
                        <div style="overflow-x:auto;">
                            <table id="datatablesSimple">
                                <thead>
                                <tr>
                                    <th>ID Mensaje</th>
                                    <th>ID Sesión</th>
                                    <th>Mensaje</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
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
<script src="js/chat.js"></script>
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
            // Elimina el registro de la base de datos según el id_msg
            eliminaRegistro($(this).attr('id_msg'));
        });
        // Controlador de eventos que se ejecuta cuando se pulsa el botón de abrir chat
        $(document).on('click', '.btn-abrir-chat', function (e) {
            var id_session = $(this).attr('id_session');
            cargarMensajesChat(id_session);
        });
    });
</script>
</body>
</html>
