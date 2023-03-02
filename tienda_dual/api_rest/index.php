<?php
require_once 'clases/conexion/Conexion.php';
$conexion = new Conexion();
$query = "SELECT * FROM usuario";
print_r($conexion->obtenerDatos($query));
