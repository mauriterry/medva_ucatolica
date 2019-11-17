<div class="padding-content">
<h1 class="titulo-principal">Productos</h1>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="categorias-producto">
                <ul>
                    <?php foreach ($this->categorias as $key => $cat) { ?>
                        <?php $categoria = $cat['detalle']; ?>
                        <li>
                            <a><?php echo $categoria->categoria_nombre; ?></a>
                            <ul>
                                <?php foreach ($cat['subcategorias'] as $key => $subcategoria) { ?>
                                    <li><a><?php echo $subcategoria->categoria_nombre; ?> </a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="row">
                <?php foreach ($this->productos as $key => $producto) { ?>
                    <div class="col-sm-4">
                        <a class="caja-producto">
                            <div class="imagen">
                                <img src="/images/<?php echo $producto->producto_imagen; ?>" alt="">
                            </div>
                            <h2><?php echo $producto->producto_nombre; ?></h2>
                            <div class="row align-items-center">
                                <div class="col-9 text-center">
                                    <div class="valor">$<?php echo number_format($producto->producto_valor); ?></div>
                                </div>
                                <div class="col-3">
                                    <button class="btn-compra additemsolo" data-id="<?php echo $producto->producto_id; ?>"><i class="fas fa-cart-plus"></i></button>
                                </div>  
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>