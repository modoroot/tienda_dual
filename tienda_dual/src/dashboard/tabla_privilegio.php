<?php
session_start();
//pdo
include '../conn/conn.php';
include 'control_privilegios.php';

$opcion = $_POST['opcion'];

if ($opcion == 1) {
    //Comprueba si el ID del usuario es 1 (administrador)
    if ($id_privilegio == 1) {
        $where = "";
    } else {
        //Si no lo es, muestra solo los registros en la tabla que tengan el id del usuario
        $where = "WHERE id_usuario=$id_usuario";
    }
    // Se prepara una consulta SQL para seleccionar todos los registros de la tabla "privilegio"
    $stmt = $pdo->prepare("SELECT * FROM privilegio $where");
    // Se establece el modo de recuperación de datos en PDO::FETCH_ASSOC, que devuelve un array indexado por nombre de columna
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // Se ejecuta la consulta preparada
    $stmt->execute();
    // Se itera a través de los resultados de la consulta y se imprime una fila por cada registro
    while ($row = $stmt->fetch()) {
        echo '<tr>
                <td>' . $row["id_privilegio"] . '</td>
                <td>' . $row['nombre'] . '</td>
                <td>' . substr($row['descripcion'], 0, 20) . '...' . '</td>
                <td>
                     <button type="button" class="btn btn-primary btn-editar" 
                     data-toggle="modal" data-target="#exampleModal" id_priv="' . $row['id_privilegio'] . '" data-whatever="@editar">Editar registro 
                        </button>
                </td>
                <td>
                    <input class="btn btn-danger btn-eliminar" id_priv="' . $row['id_privilegio'] . '" value="Eliminar" type="submit">
                </td>
            </tr>';
    }
    // Acaba el script
    exit();
}
// Comprueba si la variable $opcion es igual a 2
if ($opcion == 2) {
    // Se prepara una consulta SQL para seleccionar todos los registros de la tabla "privilegio" que coincidan con el ID del registro
    try {
        $id_privilegio = trim($_POST['id']);
        $stmt = $pdo->prepare("DELETE FROM privilegio WHERE id_privilegio=?");
        $stmt->bindParam(1, $id_privilegio);
        $res = $stmt->execute([$id_privilegio]);
    } catch (Exception $e) {
        $res = $e->getMessage();
    }
    echo $res;

    exit();
}
// Comprueba si la variable $opcion es igual a 4
if ($opcion == 4) {
    try {
        $id_privilegio = $_POST['id'];
        //lo recoge de las etiquetas input/textarea (el id)
        $nombre_privilegio = trim($_POST['nombre_priv']);
        $descripcion_privilegio = trim($_POST['descripcion_priv']);
        // Si el ID de privilegio es vacío, se prepara una consulta SQL para insertar
        // un nuevo registro en la tabla de privilegio
        if ($id_privilegio == "") {
            $stmt = $pdo->prepare("INSERT INTO privilegio VALUES (NULL, ?,?)");
            $res = $stmt->execute([$nombre_privilegio, $descripcion_privilegio]);
        } else {
            // Si el ID de privilegio no es vacío, se prepara una consulta SQL para actualizar
            // el registro correspondiente en la tabla de privilegio
            $stmt = $pdo->prepare("UPDATE privilegio SET nombre =?, descripcion =? WHERE id_privilegio=?");
            $res = $stmt->execute([$nombre_privilegio, $descripcion_privilegio, $id_privilegio]);
        }
        // Si se produce una excepción durante el proceso de inserción o actualización,
        // se captura y se almacena en $res el mensaje de error
    } catch (Exception $e) {
        $res = $e->getMessage();
    }
    echo $res;
    exit();
}
// Comprueba si la variable $opcion es igual a 5
if ($opcion == 5) {
    try {
        // Se obtienen los valores de los campos enviados por POST
        $id_privilegio = trim($_POST['id']);
        $nombre_privilegio = trim($_POST['nombre']);
        $descripcion_privilegio = trim($_POST['descripcion']);
        // Se prepara y ejecuta la consulta para obtener los datos del pedido con el id indicado
        $stmt = $pdo->prepare("SELECT nombre,descripcion FROM privilegio WHERE id_privilegio=?");
        $stmt->execute([$id_privilegio]);
        // Se obtiene la fila de resultados como un array asociativo
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $res = $e->getMessage();
    }
    // Se devuelve la fila de resultados en formato JSON
    echo json_encode($res);
    // Se termina la ejecución del script
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
                                                <label for="nombre_priv" class="col-form-label">Nombre:</label>
                                                <input type="text" class="form-control input-nombre" id="nombre_priv"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion_priv"
                                                       class="col-form-label">Descripción:</label>
                                                <textarea class="form-control input-desc"
                                                          id="descripcion_priv"></textarea>
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

<script src="general.js?v=<?php echo rand(); ?>"></script>
<script>
    const FICHERO = '<?php echo $fichero; ?>'
    $(document).ready(function () {
        cargaTabla();
        $(document).on('click', '.btn-eliminar', function (e) {
            eliminaRegistro($(this).attr('id_priv'));
        });
        $(document).on('click', '.btn-editar', function (e) {
            $("input[type=text],textarea").val("");
            var id_priv = $(this).attr('id_priv');
            cargarRegistro(id_priv)
            $(".btn-guardar").off("click");
            $(".btn-guardar").click(function () {
                guardar(id_priv)
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
