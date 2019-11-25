<?php echo $this->bannerprincipal; ?>
<div class="padding-content" >
    <div class="container">
        <h2 class="titulo2-principal">Nuestras Sedes</h2>
        <div>
            <div id='carouselservicios'>
                <div class='left_scroll'><i class="fas fa-chevron-circle-left"></i></div>
                <div class="carousel_inner">
                    <ul>
                        <?php foreach ($this->sedes as $key => $sede) { ?>
                            <?php if ((($sede->contenido_estado)==1) && ($sede->contenido_padre)==0) { ?>
                                <li >
                                <a href="/page/sedes/detalle/<?php echo $sede->contenido_id ?>/<?php echo $this->urllimpia($sede->contenido_titulo); ?>" class="caja-servicio">
                                        <div><img src="/images/<?php echo $sede->contenido_imagen; ?>" alt=""></div>
                                        <h3><?php echo $sede->contenido_titulo; ?></h3>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
                <div class='right_scroll'><i class="fas fa-chevron-circle-right"></i></div>
            </div>
        </div>
    </div>
</div>
<?php //echo $this->contenidohome; ?>

