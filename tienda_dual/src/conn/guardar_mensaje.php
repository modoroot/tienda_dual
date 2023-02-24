<?php
// Obtener la conexión a la base de datos
require_once 'conn.php';

// Obtener los datos del mensaje y la sesión
$mensaje = $_POST['mensaje'];
$sesion = $_POST['sesion'];

// Insertar el mensaje en la base de datos
$stmt = $pdo->prepare("INSERT INTO chat (mensaje, id_session,cliente) VALUES (:mensaje, :sesion,1)");
$stmt->bindParam(':mensaje', $mensaje);
$stmt->bindParam(':sesion', $sesion);
$stmt->execute();
