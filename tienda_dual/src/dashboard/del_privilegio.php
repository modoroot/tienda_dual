<?php
include '../conn/conn.php';

try {
    $id_privilegio = trim($_POST['id_privilegio']);
    $stmt = $pdo->prepare("DELETE FROM privilegio WHERE id_privilegio=?");
    $stmt->bindParam(1, $id_privilegio);
    $stmt->execute([$id_privilegio]);
    header("Location: tabla_privilegio.php");
}
catch(Exception $e){
    echo $e->getMessage();
}