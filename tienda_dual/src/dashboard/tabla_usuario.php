<?php
session_start();
//pdo
include '../conn/conn.php';
include 'control_privilegios.php';


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
    include "sidebar.php";
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
                    <a href="add_usuario.php"
                       class="btn btn-info fa-search ms-auto me-0 me-md-3 my-2 my-md-0 fa-search">Añadir registro</a>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>ID_Usuario</th>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Contraseña</th>
                                <th>Email</th>
                                <th>Privilegio</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID_Usuario</th>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Contraseña</th>
                                <th>Email</th>
                                <th>Privilegio</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            while ($row = $stmt->fetch()) {
                                ?>
                                <tr>
                                    <td><?php echo $row['id_usuario'] ?></td>
                                    <td><?php echo $row['nombre'] ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php echo $row['password'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['id_privilegio'] ?></td>
                                    <td>
                                        <form action="mod_usuario.php" method="post">
                                            <input type="hidden" name="id_usuario"
                                                   value="<?php echo $row['id_usuario']; ?>">
                                            <input class="btn btn-info" value="Editar" type="submit">
                                        </form>
                                    </td>
                                    <td>
                                        <form action="del_usuario.php" method="post">
                                            <input type="hidden" name="id_usuario"
                                                   value="<?php echo $row['id_usuario']; ?>">
                                            <input class="btn btn-danger" value="Eliminar" type="submit">
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <?php include 'footer.php'; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>
</html>
