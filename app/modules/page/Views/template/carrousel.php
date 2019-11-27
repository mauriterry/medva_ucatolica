<div class="padding-content" >
    <div class="container">
        <h2 class="titulo2-principal">Nuestras Sedes</h2>
        <div>
            <div id='carouselsect'>
                <div class='left_scroll'><i class="fas fa-chevron-circle-left"></i></div>
                <div class="carousel_inner">
                    <ul>
						<?php $colorfondo = $columna->contenido_fondo_color; ?>
						<?php foreach ($carrousel as $key => $contenido): ?>
							<li style="width: 343.333px;">
								<?php include($disenio); ?>
							</li>
						<?php endforeach ?>
                    </ul>
                </div>
                <div class='right_scroll'><i class="fas fa-chevron-circle-right"></i></div>
            </div>
        </div>
    </div>
</div>