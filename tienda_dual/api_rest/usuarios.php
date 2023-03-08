<?php
require_once 'clases/Respuesta.php';
require_once 'clases/UsuariosClass.php';

$_respuesta = new Respuesta();
$_usuarios = new UsuariosClass();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['page'])) {
        $pagina = $_GET['page'];
        $listaUsuarios = $_usuarios->listaUsuarios($pagina);
        header("Content-Type: application/json");
        echo json_encode($listaUsuarios);
        http_response_code(200);
    } else if (isset($_GET['id'])) {
        $id_usuario = $_GET['id'];
        $datosUsuario = $_usuarios->obtenerUsuario($id_usuario);
        header("Content-Type: application/json");
        echo json_encode($datosUsuario);
        http_response_code(200);
    } else {
        $listaUsuarios = $_usuarios->listaUsuarios();
        echo json_encode($listaUsuarios);
    }
} else if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //Recepción de datos enviados por el cliente
    $postBody = file_get_contents("php://input");
    //Se envía al manejador
    $datosArray = $_usuarios->post($postBody);
    //Se envía respuesta al cliente
    header("Content-Type: application/json");
    if (isset($datosArray["result"]["error_id"])) {
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo json_encode($datosArray);
} else if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    //Recepción de datos enviados por el cliente
    $postBody = file_get_contents("php://input");
    //Se envía al manejador
    $datosArray = $_usuarios->put($postBody);
    //Se envía respuesta al cliente
    header("Content-Type: application/json");
    if (isset($datosArray["result"]["error_id"])) {
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo json_encode($datosArray);
} else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    //Recepción de datos enviados por el cliente
    $postBody = file_get_contents("php://input");
    //Se envía al manejador
    $datosArray = $_usuarios->delete($postBody);
    //Se envía respuesta al cliente
    header("Content-Type: application/json");
    if (isset($datosArray["result"]["error_id"])) {
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo json_encode($datosArray);
} else {
    header("Content-Type: application/json");
    $datosArray = $_respuesta->error_405();
    echo json_encode($datosArray);
}
