<?php
//Comprueba si existe el ID de usuario en la sesión
if (!isset($_SESSION['id_usuario'])) {
    //Si no existe, redirige al login.php
    header("Location: login.php");
}
// Almacena el nombre del usuario en una variable
$nombre = $_SESSION['nombre'];

// Almacena el ID del usuario en una variable
$id_usuario = $_SESSION['id_usuario'];

// Almacena el ID del privilegio en una variable
$id_privilegio = $_SESSION['id_privilegio'];

// Verifica el privilegio del usuario
if ($id_privilegio == 1) {
    // Si el usuario es administrador, selecciona todos los usuarios
    $where = "";
} else {
    // Si el usuario no es administrador, solo selecciona su propio registro
    $where = "WHERE id_usuario=$id_usuario";
}

// Prepara una consulta a la base de datos para seleccionar usuarios
$stmt = $pdo->prepare("SELECT * FROM usuario $where");

// Establece el modo de recuperación de los resultados de la consulta
$stmt->setFetchMode(PDO::FETCH_ASSOC);

// Ejecuta la consulta
$stmt->execute();

?>