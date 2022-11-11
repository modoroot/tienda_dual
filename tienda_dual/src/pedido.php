<?php
function setPedido($codigo_pedido,$id_producto,$id_usuario,$fecha_pedido, $precio_total)
{
    include 'conn/conn.php';
    // Prepare
    $stmt = $pdo->prepare("INSERT INTO pedido (id_pedido, codigo_pedido, id_producto,id_usuario,fecha_pedido,precio_total)
VALUES (NULL, ?, ?, ?, ?, ?)");
    // Bind
    $stmt->bindParam(1, $codigo_pedido);
    $stmt->bindParam(2, $id_producto);
    $stmt->bindParam(3, $id_usuario);
    $stmt->bindParam(4, $fecha_pedido);
    $stmt->bindParam(5, $precio_total);
    // Execute
    $stmt->execute();
}

function getPedidos()
{
    include 'conn/conn.php';
    //consulta preparada: se compila antes de ejecutar
    $stmt = $pdo->prepare('SELECT * FROM pedido');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
//binding de las columnas de la tabla variables con sus tipos de datos
//correspondientes
    while ($row = $stmt->fetch()) {
        echo "ID: {$row["id_pedido"]} ";
        echo "\n";
        echo "Nombre: {$row["codigo_pedido"]} ";
        echo "\n";
        echo "ID Usuario: {$row["id_usuario"]} ";
        echo "\n";
        echo "Fecha Pedido: {$row["fecha_pedido"]} ";
        echo "\n";
        echo "Precio total: {$row["precio_total"]} ";
        echo "\n";
        echo "---------\n";
    }
}

//setPedido("455445",1,2,date("Y-m-d H:i:s"),9.94);
getPedidos();
