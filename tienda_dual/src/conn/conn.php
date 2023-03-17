<?php
session_set_cookie_params(300);
ini_set('session.gc_maxlifetime', 300);
session_start();
// CONFIGURACIÓN DE LA BASE DE DATOS
$BD_USUARIO = 'localhost';
$BD_BASE = 'tienda_dual';
$BD_USER = 'root';
$BD_PASS = 'root';
// CADENA DE CONEXIÓN
$pdo = new PDO('mysql:host=' . $BD_USUARIO . ';dbname=' . $BD_BASE, $BD_USER, $BD_PASS);
$pdo->exec("set names utf8mb4");
$fichero = basename($_SERVER['PHP_SELF']);