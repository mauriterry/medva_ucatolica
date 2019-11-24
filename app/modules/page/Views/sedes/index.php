<div class="titulo-internas1" style="background-image:url(/skins/page/images/fondo1.jpg)">
    <div align="center"><h2>Nuestras Sedes</h2></div>
</div>

<div class="caja-sedes">
    <div class="container">
        <div class="row" style="justify-content: center;">
            <?php foreach ($this->sedes as $key => $sede) { ?>
                <?php if ((($sede->contenido_estado)==1) && ($sede->contenido_padre)==0) { ?>
                    <div class="col-sm-12 col-md-6 col-lg-4 convenio-interna">
                        <div class="caja-servicios">
                            <a href="/page/sedes/detalle/<?php echo $sede->contenido_id ?>/<?php echo $this->urllimpia($sede->contenido_titulo); ?>">
                                <div class="servicios-imagen">
                                    <img src="/images/<?php echo $sede->contenido_imagen; ?>" alt="">
                                </div>
                                <div class="servicios-descripcion">
                                    <h3><?php echo $sede->contenido_titulo; ?></h3>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>