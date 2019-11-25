<div class="titulo-internas1" style="background-image:url(/skins/page/images/fondo1.jpg)">
    <div align="center"><h2>Sensores</h2></div>
</div>

<div class="caja-sedes">
    <div class="container">
        <div class="row" style="justify-content: center;">
            <?php foreach ($this->datos as $key => $dato) { ?>
                <?php if ((($dato->contenido_estado)==1) && ($dato->contenido_padre)==0) { ?>
                    <div class="col-sm-12 col-md-6 col-lg-4 convenio-interna">
                        <div class="caja-servicios">
                            <a href="/page/datos/detalle/<?php echo $dato->contenido_id ?>/<?php echo $this->urllimpia($dato->contenido_titulo); ?>">
                                <div class="servicios-imagen">
                                    <img src="/images/<?php echo $dato->contenido_imagen; ?>" alt="">
                                </div>
                                <div class="servicios-descripcion">
                                    <h3><?php echo $dato->contenido_titulo; ?></h3>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>