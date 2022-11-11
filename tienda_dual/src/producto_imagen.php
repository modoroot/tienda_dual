<?php
function setProductoImagen($nombre,$descripcion,$id_producto)
{
    include 'conn/conn.php';
    // Prepare
    $stmt = $pdo->prepare("INSERT INTO producto_imagen (id_producto_imagen, nombre, descripcion, id_producto)
VALUES (NULL,?,?,?)");
    // Bind
    $stmt->bindParam(1, $nombre);
    $stmt->bindParam(2, $descripcion);
    $stmt->bindParam(3, $id_producto);
    // Execute
    $stmt->execute();
}

function getProductosImagenes()
{
    include 'conn/conn.php';
    //consulta preparada: se compila antes de ejecutar
    $stmt = $pdo->prepare('SELECT * FROM producto_imagen');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
//binding de las columnas de la tabla variables con sus tipos de datos
//correspondientes
    while ($row = $stmt->fetch()) {
        echo "ID: {$row["id_producto_imagen"]} ";
        echo "\n";
        echo "Nombre: {$row["nombre"]} ";
        echo "\n";
        echo "ID Usuario: {$row["descripcion"]} ";
        echo "\n";
        echo "Fecha Pedido: {$row["id_producto"]} ";
        echo "\n";
        echo "---------\n";
    }
}
setProductoImagen("test imagen insert","test desc insert producto",1);
getProductosImagenes();
