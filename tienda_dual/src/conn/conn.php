<?php
$BD_USUARIO = 'localhost';
$BD_BASE = 'tienda_dual';
$BD_USER = 'root';
$BD_PASS = 'root';
// CADENA DE CONEXIÓN
$pdo = new PDO('mysql:host=' . $BD_USUARIO . ';dbname=' . $BD_BASE, $BD_USER, $BD_PASS);
$pdo->exec("set names utf8mb4");
$fichero = basename($_SERVER['PHP_SELF']);
