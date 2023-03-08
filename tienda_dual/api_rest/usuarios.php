<?php
// Incluimos la clase Respuesta y UsuariosClass
require_once 'clases/Respuesta.php';
require_once 'clases/UsuariosClass.php';

// Instanciamos las clases
$_respuesta = new Respuesta();
$_usuarios = new UsuariosClass();

// Si el método de solicitud es GET
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    // Si se especifica una página, obtenemos los usuarios para esa página
    if (isset($_GET['page'])) {
        $pagina = $_GET['page'];
        $listaUsuarios = $_usuarios->listaUsuarios($pagina);
        header("Content-Type: application/json");
        echo json_encode($listaUsuarios);
        http_response_code(200);
    }
    // Si se especifica un ID de usuario, obtenemos ese usuario
    else if (isset($_GET['id'])) {
        $id_usuario = $_GET['id'];
        $datosUsuario = $_usuarios->obtenerUsuario($id_usuario);
        header("Content-Type: application/json");
        echo json_encode($datosUsuario);
        http_response_code(200);
    } 
    // Si no se especifica una página ni un ID de usuario, obtenemos la lista completa de usuarios
    else {
        $listaUsuarios = $_usuarios->listaUsuarios();
        echo json_encode($listaUsuarios);
    }
} 
// Si el método de solicitud es POST
else if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Obtenemos los datos enviados por el cliente
    $postBody = file_get_contents("php://input");
    // Enviamos los datos al manejador
    $datosArray = $_usuarios->post($postBody);
    // Enviamos la respuesta al cliente
    header("Content-Type: application/json");
    if (isset($datosArray["result"]["error_id"])) {
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo json_encode($datosArray);
} 
// Si el método de solicitud es PUT
else if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    // Obtenemos los datos enviados por el cliente
    $postBody = file_get_contents("php://input");
    // Enviamos los datos al manejador
    $datosArray = $_usuarios->put($postBody);
    // Enviamos la respuesta al cliente
    header("Content-Type: application/json");
    if (isset($datosArray["result"]["error_id"])) {
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo json_encode($datosArray);
} 
// Si el método de solicitud es DELETE
else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    // Obtenemos los datos enviados por el cliente
    $postBody = file_get_contents("php://input");
    // Enviamos los datos al manejador
    $datosArray = $_usuarios->delete($postBody);
    // Enviamos la respuesta al cliente
    header("Content-Type: application/json");
    if (isset($datosArray["result"]["error_id"])) {
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo json_encode($datosArray);
} 
// Si el método de solicitud no está permitido, devolvemos una respuesta de error
else {
    header("Content-Type: application/json");
    $datosArray = $_respuesta->error_405();
    echo json_encode($datosArray);
}
