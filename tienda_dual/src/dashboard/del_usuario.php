<?php
include '../conn/conn.php';

try {
    $id_usuario = trim($_POST['id_usuario']);
    $stmt = $pdo->prepare("DELETE FROM usuario WHERE id_usuario=?");
    $stmt->bindParam(1, $id_usuario);
    $stmt->execute([$id_usuario]);
    header("Location: tabla_usuario.php");
}
catch(Exception $e){
    echo $e->getMessage();
}