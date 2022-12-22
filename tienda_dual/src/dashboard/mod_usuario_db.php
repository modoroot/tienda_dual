<?php
include "../conn/conn.php";
$id_usuario = $_POST['id_usuario'];
$nombre = $_POST['nombre'];
$usuario = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$id_privilegio = $_POST['id_privilegio'];
$sha = sha1($password);

try {
    $stmt = $pdo->prepare("UPDATE usuario SET nombre =?, username =?, password=?, email=?, id_privilegio=? WHERE id_usuario=?");
    $stmt->execute([$nombre, $usuario, $sha, $email, $id_privilegio, $id_usuario]);
    header("Location: tabla_usuario.php");
} catch (Exception $e) {
    echo $e->getMessage();
}