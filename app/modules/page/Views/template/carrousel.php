<div id='carouselsect'>
    <div class='left_scroll'><i class="fas fa-chevron-circle-left"></i></div>
    <div class="carousel_inner">
        <ul>
			<?php $colorfondo = $columna->contenido_fondo_color; ?>
			<?php foreach ($carrousel as $key => $contenido): ?>
				<li>
					<?php include($disenio); ?>
				</li>
			<?php endforeach ?>
        </ul>
    </div>
    <div class='right_scroll'><i class="fas fa-chevron-circle-right"></i></div>
</div>