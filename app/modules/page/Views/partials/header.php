<div class="header-redes">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 text-left">
				<?php if($this->infopage->info_pagina_whatsapp) {?>
					<?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $this->infopage->info_pagina_whatsapp), 10);  ?>
					<a href="https://api.whatsapp.com/send?phone=<?php echo $whatsapp; ?>" target="_blank" class="red" >
						<i class="fab fa-whatsapp"></i>
						<span><?php echo $this->infopage->info_pagina_whatsapp ?></span>
					</a>
				<?php } ?>
			</div>
			<div class="col-sm-4">
				<div align="center">
					<?php if($this->infopage->info_pagina_facebook) {?>
						<a href="<?php echo $this->infopage->info_pagina_facebook ?>" target="_blank" class="red">
							<i class="fab fa-facebook-f"></i>
						</a>
					<?php } ?>
					<?php if($this->infopage->info_pagina_twitter) {?>
						<a href="<?php echo $this->infopage->info_pagina_twitter ?>" target="_blank" class="red">
							<i class="fab fa-twitter"></i>
						</a>
					<?php } ?>
					<?php if($this->infopage->info_pagina_instagram) {?>
						<a href="<?php echo $this->infopage->info_pagina_instagram ?>" target="_blank" class="red">
							<i class="fab fa-instagram"></i>
						</a>
					<?php } ?>
					<?php if($this->infopage->info_pagina_pinterest) {?>
						<a href="<?php echo $this->infopage->info_pagina_pinterest ?>" target="_blank" class="red">
							<i class="fab fa-pinterest-p"></i>
						</a>
					<?php } ?>
					<?php if($this->infopage->info_pagina_youtube) {?>
						<a href="<?php echo $this->infopage->info_pagina_youtube ?>" target="_blank" class="red">
							<i class="fab fa-youtube"></i>
						</a>
					<?php } ?>
					<?php if($this->infopage->info_pagina_linkdn) {?>
						<a href="<?php echo $this->infopage->info_pagina_linkdn ?>" target="_blank" class="red">
							<i class="fab fa-linkedin-in"></i>
						</a>
					<?php } ?>
					<?php if($this->infopage->info_pagina_google) {?>
						<a href="<?php echo $this->infopage->info_pagina_google ?>" target="_blank" class="red">
							<i class="fab fa-google-plus-g"></i>
						</a>
					<?php } ?>
					<?php if($this->infopage->info_pagina_flickr) {?>
						<a href="<?php echo $this->infopage->info_pagina_flickr ?>" target="_blank" class="red">
							<i class="fab fa-flickr"></i>
						</a>
					<?php } ?>
				</div>
			</div>
			<div class="col-sm-4 text-right">
				<a href="" target="_blank" class="red"><i class="far fa-envelope"></i>
					<?php echo $this->infopage->info_pagina_correos_contacto; ?>
				</a>
			</div>
		</div>
	</div>
</div>
<div class="header-content">
	<div class="container">
		<div class="botonera">
			<div class="row no-gutters">
				<div class="col-sm-5">
					<nav>
						<ul>
							<li><a href="#"><span>Quiénes Somos <i class="fas fa-angle-down"></i></span></a>
								<ul>
									<li><a href="/page/nosotros#24">¿Quiénes Somos?</a></li>
									<li><a href="/page/nosotros#26">Misión</a></li>
									<li><a href="/page/nosotros#28">Visión</a></li>
									<li><a href="/page/nosotros#50">Aviso de Privacidad</a></li>
									<li><a href="/page/nosotros#52">Responsabilidades en el Cumplimiento de SARLAFT</a></li>
									<li><a href="/page/nosotros#117">Preguntas Frecuentes</a></li>
									<li><a href="/page/tratamientodedatos">Política de Tratamiento de Datos</a></li>
									<li><a href="#">Preguntas Frecuentes</a></li>
								</ul>
							</li>
							<div class="linea">|</div>
							<li><a href="#"><span>Servicios <i class="fas fa-angle-down"></i></span></a>
								<ul>
									<li><a href="/page/creditos">Créditos</a></li>
									<li><a href="/page/ahorro">Ahorros</a></li>
									<li><a href="/page/bienestarsocial">Fondos de Bienestar Social</a></li>
									<li><a href="/page/servicios#116">Curso de Economía Solidaria</a></li>
								</ul>
							</li>
							<div class="linea">|</div>
							<li><a href="#"><span>Reglamentos y Formatos <i class="fas fa-angle-down"></i></span></a>
								<ul>
									<li><a href="/page/reglamentos">Reglamentos</a></li>
									<li><a href="/page/formatos">Formatos</a></li>
									<li><a href="/page/circulares">Circulares Asambleas</a></li>
									<li><a href="/page/circularesinformativas">Circulares Informativas</a></li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
				<div class="col-sm-2">
					<div class="logo" align="center"><a href="/page/index"><img src="/skins/page/images/logo_extendido.png"></a></div>
				</div>
				<div class="col-sm-5">
					<nav>
						<ul>
							<li><a href="/page/convenios"><span>Convenios</span></a></li>
							<div class="linea">|</div>
							<li><a href="/page/galeria/login"><span>Galería</span></a></li>
							<div class="linea">|</div>
							<li><a href="/page/contactenos"><span>Contáctenos</span></a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>