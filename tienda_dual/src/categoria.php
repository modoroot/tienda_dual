<?php
function setCategoria($nombre, $descripcion)
{
    include 'conn/conn.php';
    // Prepare
    $stmt = $pdo->prepare("INSERT INTO categoria (id_categoria, nombre, descripcion)
VALUES (NULL, ?, ?)");
    // Bind
    $stmt->bindParam(1, $nombre);
    $stmt->bindParam(2, $descripcion);
    // Execute
    $stmt->execute();
}

function getCategorias()
{
    include 'conn/conn.php';
    //consulta preparada: se compila antes de ejecutar
    $stmt = $pdo->prepare('SELECT * FROM categoria');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
//binding de las columnas de la tabla variables con sus tipos de datos
//correspondientes
    while ($row = $stmt->fetch()) {
        echo "ID: {$row["id_categoria"]} ";
        echo "\n";
        echo "Nombre: {$row["nombre"]} ";
        echo "\n";
        echo "Descripción: {$row["descripcion"]} ";
        echo "\n";
        echo "---------\n";
    }
}

setCategoria("test categoria insert", "test desc insert");
getCategorias();
