<?php echo $this->bannerprincipal; ?>
<div class="padding-content" >
    <div class="container">
        <h2 class="titulo-principal">Nuestras Sedes</h2>
        <div>
            <div id='carouselservicios'>
                <div class='left_scroll'><i class="fas fa-chevron-circle-left"></i></div>
                <div class="carousel_inner">
                    <ul>
                        <?php foreach ($this->sedes as $key => $sede) { ?>
                            <li >
                                <a href="" class="caja-servicio">
                                    <div><img src="/images/<?php echo $sede->contenido_imagen; ?>" alt=""></div>
                                    <h3><?php echo $sede->contenido_titulo; ?></h3>
                                </a>
                            </li>
                        <?php } ?>
            
                    </ul>
                </div>
                <div class='right_scroll'><i class="fas fa-chevron-circle-right"></i></div>
            </div>
        </div>
    </div>
</div>
<?php //echo $this->contenidohome; ?>

