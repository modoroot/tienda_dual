<?php
include "../conn/conn.php";

$nombre = $_POST['nombre'];
$usuario = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$id_privilegio = $_POST['id_privilegio'];
$sha = sha1($password);

try {
    $stmt = $pdo->prepare("INSERT INTO usuario VALUES (NULL,?,?,?,?,?)");
    $stmt->execute([$nombre,$usuario,$sha,$email,$id_privilegio]);
    header("Location: tabla_usuario.php");
}
catch(Exception $e){
    echo $e->getMessage();
}
