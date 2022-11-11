<?php
function setPrivilegio($nombre,$descripcion)
{
    include 'conn/conn.php';
    // Prepare
    $stmt = $pdo->prepare("INSERT INTO privilegio (id_privilegio, nombre, descripcion)
VALUES (NULL, ?, ?)");
    // Bind
    $stmt->bindParam(1, $nombre);
    $stmt->bindParam(2, $descripcion);
    // Execute
    $stmt->execute();
}

function getPrivilegios()
{
    include 'conn/conn.php';
    //consulta preparada: se compila antes de ejecutar
    $stmt = $pdo->prepare('SELECT * FROM privilegio');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
//binding de las columnas de la tabla variables con sus tipos de datos
//correspondientes
    while ($row = $stmt->fetch()) {
        echo "ID: {$row["id_privilegio"]} ";
        echo "\n";
        echo "Nombre: {$row["nombre"]} ";
        echo "\n";
        echo "ID Usuario: {$row["descripcion"]} ";
        echo "\n";
        echo "---------\n";
    }
}

setPrivilegio("test privilegio insert","test desc insert");
getPrivilegios();
