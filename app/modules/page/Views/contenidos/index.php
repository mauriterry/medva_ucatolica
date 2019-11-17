<div class="container">
    <div class="row">
        <?php foreach ($this->contenidos as $key => $servicio) { ?>
            <div class="col-sm-4">
                <a href="/page/contenidos/detalle/<?php echo $servicio->contenido_id ?>/<?php echo $this->urllimpia($servicio->contenido_titulo); ?>" class="caja-servicio">
                    <div><img src="/images/<?php echo $servicio->contenido_imagen; ?>" alt=""></div>
                    <h3><?php echo $servicio->contenido_titulo; ?></h3>
                </a>
            </div>
        <?php } ?>
    </div>
    
</div>