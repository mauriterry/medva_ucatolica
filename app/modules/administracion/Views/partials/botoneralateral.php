<ul>
	<li <?php if($this->botonpanel == 1){ ?>class="activo"<?php } ?>><a href="/administracion/panel"><i class="fas fa-info-circle"></i> Información pagina</a></li>
	<li <?php if($this->botonpanel == 2){ ?>class="activo"<?php } ?>><a href="/administracion/publicidad"><i class="far fa-images"></i> Administrar Banner</a></li>
	<li <?php if($this->botonpanel == 3){ ?>class="activo"<?php } ?>><a href="/administracion/contenido"><i class="fas fa-file-invoice"></i> Administrar Contenidos</a></li>
	<li <?php if($this->botonpanel == 4){ ?>class="activo"<?php } ?>><a href="/administracion/usuario"><i class="fas fa-users"></i> Administrar Usuarios</a></li>
	<li <?php if($this->botonpanel == 5){ ?>class="activo"<?php } ?>><a href="/administracion/datos"><i class="fas fa-desktop"></i> Administrar datos</a></li>
</ul>