<div class="titulo-internas1" style="background-image:url(/skins/page/images/fondo1.jpg)">
    <div align="center"><h2>Documentos del Proyecto</h2></div>
</div>

<div class="formatos">
    <div class="container">
        <ul class="titulo-formatos">
            <li><h4>Documentos</h4></li>
        </ul>
        <?php foreach ($this->archivos as $key => $archivo) { ?>
            <ul>
                <li>
                    <a href="/files/<?php echo $archivo->archivo_formato?>" target="blank">
                        <div class="row">
                            <div class="col-10 nombre" style="padding-top: 5px;"><span><?php echo $archivo->archivo_nombre;?></span></div>
                            <div class="col-2"><?php if ($archivo->archivo_formato) { ?>
                                <i class="fas fa-file-download"></i><?php }?> 
                            </div> 
                        </div>
                    </a>
                </li>
            </ul>
        <?php } ?>
    </div>
</div>