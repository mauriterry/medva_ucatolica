<div class="fondo-gris">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div><h3>CONTÁCTENOS</h3></div>
				<div><div><?php echo $this->infopage->info_pagina_informacion_contacto_footer; ?></div></div>
			</div>
			<div class="col-sm-4">
				<div class="correos"><?php echo $this->infopage->info_pagina_informacion_contacto; ?></div>
			</div>
			<div class="col-sm-4">
				<div><h2>NUESTRAS REDES</h2></div>
				<div class="redes-footer">
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
		</div>
	</div>
</div>
<div class="fondo-rojo"align="center">
	&copy; FEROLDÁN | Diseñado por Omega Soluciones Web <?php echo $this->infofooter;?>
</div>