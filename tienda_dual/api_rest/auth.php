<?php
require_once 'clases/AuthClass.php';
require_once 'clases/Respuesta.php';

$_auth = new AuthClass();
$_respuesta = new Respuesta();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //Recepción de datos
    $postBody = file_get_contents("php://input");
    //Enviar datos al manejador
    $datosArray = $_auth->login($postBody);
    //Respuesta de datos al cliente tipo Json
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