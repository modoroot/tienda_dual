<?php
// Obtener la conexión a la base de datos
require_once 'conn.php';

// Obtener los datos del mensaje y la sesión
$mensaje = $_POST['mensaje'];
$sesion = $_POST['sesion'];

// Seleccionar mensajes de la sesión
$stmt = $pdo->prepare("SELECT * FROM chat WHERE id_session = :sesion");
$stmt->bindParam(':sesion', $sesion);
$stmt->execute();
$mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($mensajes);