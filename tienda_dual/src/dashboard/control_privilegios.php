<?php
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
$stmt = $pdo->prepare("SELECT * FROM usuario $where");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();