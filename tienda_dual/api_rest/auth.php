<?php
require_once 'clases/AuthClass.php';
require_once 'clases/Respuesta.php';

$_auth = new AuthClass();
$_respuesta = new Respuesta();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $postBody = file_get_contents("php://input");
    $datosArray = $_auth->login($postBody);
    print_r(json_encode($datosArray));
} else {
    header("Content-Type: application/json");
    $datosArray = $_respuesta->error_405();
    echo json_encode($datosArray);
}