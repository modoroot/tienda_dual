<?php

function setUsuario($nombre, $username, $password, $nombre_perfil, $id_privilegio)
{
    include 'conn/conn.php';
    // Prepare
    $stmt = $pdo->prepare("INSERT INTO usuario (id_usuario,nombre,username,password,nombre_perfil,id_privilegio)
VALUES (NULL, ?, ?, ?, ?, ?)");
// Bind
    $stmt->bindParam(1, $nombre);
    $stmt->bindParam(2, $username);
    $stmt->bindParam(3, $password);
    $stmt->bindParam(4, $nombre_perfil);
    $stmt->bindParam(5, $id_privilegio);
// Execute
    $stmt->execute();
}

function getUsuarios()
{
    include 'conn/conn.php';
    //consulta preparada: se compila antes de ejecutar
    $stmt = $pdo->prepare('SELECT * FROM usuario');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
//binding de las columnas de la tabla variables con sus tipos de datos
//correspondientes
    while ($row = $stmt->fetch()) {
        echo "ID: {$row["id_usuario"]} ";
        echo "\n";
        echo "Nombre: {$row["nombre"]} ";
        echo "\n";
        echo "Username: {$row["username"]} ";
        echo "\n";
        echo "Contraseña: {$row["password"]} ";
        echo "\n";
        echo "Perfil: {$row["nombre_perfil"]} ";
        echo "\n";
        echo "ID Privilegio: {$row["id_privilegio"]} ";
        echo "\n";
        echo "---------\n";
    }
}


