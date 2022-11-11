<?php

function setProducto($nombre,$precio,$id_categoria){
    include 'conn/conn.php';
    // Prepare
    $stmt = $pdo->prepare("INSERT INTO producto (id_producto, nombre, precio, id_categoria)
VALUES (NULL, ?, ?, ?)");
// Bind
    $stmt->bindParam(1, $nombre);
    $stmt->bindParam(2, $precio);
    $stmt->bindParam(3, $id_categoria);
// Execute
    $stmt->execute();
}
function getProductos(){
    include 'conn/conn.php';
    //consulta preparada: se compila antes de ejecutar
    $stmt = $pdo->prepare('SELECT * FROM producto');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
//binding de las columnas de la tabla variables con sus tipos de datos
//correspondientes
    while($row = $stmt->fetch()){
        echo "ID: {$row["id_producto"]} ";
        echo "\n";
        echo "Nombre: {$row["nombre"]} ";
        echo "\n";
        echo "Precio: {$row["precio"]} ";
        echo "\n";
        echo "ID Categoría: {$row["id_categoria"]} ";
        echo "\n";
        echo "---------\n";
    }
}
//setProducto("test nombre producto",5.99,1);
getProductos();

