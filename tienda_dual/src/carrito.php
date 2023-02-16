<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles_carrito.css">
    <title>carrito de los cojones</title>
</head>
<body>
<header>
    <h1>Resumen del carrito de la compra</h1>
</header>
<nav>
    <ul>
        <li><a href="#">Inicio</a></li>
        <li><a href="#">Productos</a></li>
        <li><a href="#">Carrito</a></li>
        <li><a href="#" class="btn-buy">Comprar</a></li>
    </ul>
</nav>
<section>
    <h2>Productos</h2>
    <table>
        <thead>
        <tr>
            <th>Producto</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio unitario</th>
            <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><img src="https://via.placeholder.com/100x100" alt="Producto 1" class="product-img"></td>
            <td class="product-desc">Producto 1<br>Descripción del producto</td>
            <td>2</td>
            <td>$10.00</td>
            <td>$20.00</td>
        </tr>
        <tr>
            <td><img src="https://via.placeholder.com/100x100" alt="Producto 2" class="product-img"></td>
            <td class="product-desc">Producto 2<br>Descripción del producto</td>
            <td>1</td>
            <td>$15.00</td>
            <td>$15.00</td>
        </tr>
        <tr>
            <td><img src="https://via.placeholder.com/100x100" alt="Producto 3" class="product-img"></td>
            <td class="product-desc">Producto 3<br>Descripción del producto</td>
            <td>3</td>
            <td>$20.00</td>
            <td>$60.00</td>
        </tr>
        <tr>
            <td colspan="4" class="subtotal">Subtotal</td>
            <td class="subtotal">$95.00</td>
        </tr>
        <tr>
            <td colspan="4">Envío</td>
            <td>$5.00</td>
        </tr>
        <tr>
            <td colspan="4" class="total">Total</td>
            <td class="total">$100.00</td>
        </tr>
        </tbody>
    </table>
</section>
</body>
</html>