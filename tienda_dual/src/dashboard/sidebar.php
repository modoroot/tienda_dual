<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="index.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <?php
                if ($id_privilegio == 1) {
                ?>
                <div class="sb-sidenav-menu-heading">Registros</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTablas"
                   aria-expanded="false" aria-controls="collapseTablas">
                    <div class="sb-nav-link-icon"><i class="fas fa-search"></i></div>
                    Tablas
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseTablas" aria-labelledby="headingTwo"
                     data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                           data-bs-target="#pagesCollapseCat" aria-expanded="false"
                           aria-controls="pagesCollapseCat">
                            Categorías
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseCat" aria-labelledby="headingOne"
                             data-bs-parent="#sidenavAccordionCat">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="tabla_categoria.php">Categoría</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                           data-bs-target="#pagesCollapsePedido" aria-expanded="false"
                           aria-controls="pagesCollapsePedido">
                            Pedidos
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapsePedido" aria-labelledby="headingOne"
                             data-bs-parent="#sidenavAccordionPedido">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="tabla_pedido.php">Pedido</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                           data-bs-target="#pagesCollapsePrivilegio" aria-expanded="false"
                           aria-controls="pagesCollapsePrivilegio">
                            Privilegios
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapsePrivilegio" aria-labelledby="headingOne"
                             data-bs-parent="#sidenavAccordionPrivilegio">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="tabla_privilegio.php">Privilegio</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                           data-bs-target="#pagesCollapseProducto" aria-expanded="false"
                           aria-controls="pagesCollapseProducto">
                            Productos
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseProducto" aria-labelledby="headingOne"
                             data-bs-parent="#sidenavAccordionProducto">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="tabla_producto.php">Producto</a>
                                <a class="nav-link" href="tabla_producto_imagen.php">Imagen</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                           data-bs-target="#pagesCollapseUsuario" aria-expanded="false"
                           aria-controls="pagesCollapseUsuario">
                            Usuarios
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseUsuario" aria-labelledby="headingOne"
                             data-bs-parent="#sidenavAccordionUsuario">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="tabla_usuario.php">Usuario</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="tabla_usuario.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tablas
                </a>
                <a class="nav-link" href="tabla_chat.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Chat
                </a>
            </div>
        </div>
        <?php } ?>
        <div class="sb-sidenav-footer">
            <div class="small">Sesión iniciada como</div>
            <?php echo $nombre ?>
        </div>
    </nav>
</div>
