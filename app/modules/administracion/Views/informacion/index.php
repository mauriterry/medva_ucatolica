<div class="container-fluid">
	<form enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>" data-toggle="validator">
		<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
		<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
		<?php if ($this->content->info_pagina_id) { ?>
			<input type="hidden" name="id" id="id" value="<?= $this->content->info_pagina_id; ?>" />
		<?php }?>

		<a id="redes" name="redes"></a>
		<div class="div-dashboard">
			<h2>
				<img src="/skins/administracion/images/redessociales.png"> Redes Sociales
			</h2>
			<div align="center" class="pading-dashboard">
				<br>
				<div class="row">
					<div class="col-6 form-group">
						<div class="input-group">
							<div class="input-group-prepend ">
								<span class="input-group-text input-icono fondo-facebook" ><i class="fab fa-facebook-f"></i></span>
							</div>
							<input type="text" value="<?= $this->content->info_pagina_facebook; ?>" name="info_pagina_facebook" id="info_pagina_facebook" class="form-control"   >
						</div>
					</div>
					<div class="col-6 form-group">
						<div class="input-group">
							<div class="input-group-prepend ">
								<span class="input-group-text input-icono fondo-instagram" ><i class="fab fa-instagram"></i></span>
							</div>
							<input type="text" value="<?= $this->content->info_pagina_instagram; ?>" name="info_pagina_instagram" id="info_pagina_instagram" class="form-control"   >
						</div>
					</div>
					<div class="col-6 form-group">
						<div class="input-group">
							<div class="input-group-prepend ">
								<span class="input-group-text input-icono fondo-twitter" ><i class="fab fa-twitter"></i></span>
							</div>
							<input type="text" value="<?= $this->content->info_pagina_twitter; ?>" name="info_pagina_twitter" id="info_pagina_twitter" class="form-control"   >
						</div>
					</div>
					<div class="col-6 form-group">
						<div class="input-group">
							<div class="input-group-prepend ">
								<span class="input-group-text input-icono fondo-pinterest" ><i class="fab fa-pinterest"></i></span>
							</div>
							<input type="text" value="<?= $this->content->info_pagina_pinterest; ?>" name="info_pagina_pinterest" id="info_pagina_pinterest" class="form-control"   >
						</div>
					</div>
					<div class="col-6 form-group">
						<div class="input-group">
							<div class="input-group-prepend ">
								<span class="input-group-text input-icono fondo-youtube" ><i class="fab fa-youtube"></i></span>
							</div>
							<input type="text" value="<?= $this->content->info_pagina_youtube; ?>" name="info_pagina_youtube" id="info_pagina_youtube" class="form-control"   >
						</div>
					</div>
					<div class="col-6 form-group">
						<div class="input-group">
							<div class="input-group-prepend ">
								<span class="input-group-text input-icono fondo-flickr" ><i class="fab fa-flickr"></i></span>
							</div>
							<input type="text" value="<?= $this->content->info_pagina_flickr; ?>" name="info_pagina_flickr" id="info_pagina_flickr" class="form-control"   >
						</div>
					</div>
					<div class="col-6 form-group">
						<div class="input-group">
							<div class="input-group-prepend ">
								<span class="input-group-text input-icono fondo-linkedin" ><i class="fab fa-linkedin"></i></span>
							</div>
							<input type="text" value="<?= $this->content->info_pagina_linkedin; ?>" name="info_pagina_linkedin" id="info_pagina_linkedin" class="form-control"   >
						</div>
					</div>
					<div class="col-6 form-group">
						<div class="input-group">
							<div class="input-group-prepend ">
								<span class="input-group-text input-icono fondo-google" ><i class="fab fa-google-plus-g"></i></span>
							</div>
							<input type="text" value="<?= $this->content->info_pagina_google; ?>" name="info_pagina_google" id="info_pagina_google" class="form-control"   >
						</div>
					</div>
					<div class="col-6 form-group">
						<div class="input-group">
							<div class="input-group-prepend ">
								<span class="input-group-text input-icono fondo-whatsapp" ><i class="fab fa-whatsapp"></i></span>
							</div>
							<input type="text" value="<?= $this->content->info_pagina_whatsapp; ?>" name="info_pagina_whatsapp" id="info_pagina_whatsapp" class="form-control"   >
						</div>
					</div>
				</div>
			</div>
		</div>

		<a id="contactenos" name="contactenos"></a>
		<div class="div-dashboard">
			<h2>
				<img src="/skins/administracion/images/informaciondecotactenos.png"> Información de Contáctenos
			</h2>
			<div class="pading-dashboard">
				<br>
				<div class="row">
					<div class="col-4 form-group">
						<label for="info_pagina_telefono"  class="control-label">Teléfonos:</label>
						<div class="input-group">
							<div class="input-group-prepend ">
								<span class="input-group-text input-icono fondo-telefono" ><i class="fas fa-phone"></i></span>
							</div>
							<textarea name="info_pagina_telefono" id="info_pagina_telefono"   class="form-control" rows="2"  ><?= $this->content->info_pagina_telefono; ?></textarea>
						</div>
					</div>
					<div class="col-4 form-group">
						<label for="info_pagina_correos_contacto" class="form-label" >Correo Contacto:</label>
						<div class="input-group">
							<div class="input-group-prepend ">
								<span class="input-group-text input-icono fondo-correo" ><i class="fas fa-envelope"></i></span>
							</div>
							<textarea name="info_pagina_correos_contacto" id="info_pagina_correos_contacto"   class="form-control" rows="2"  ><?= $this->content->info_pagina_correos_contacto; ?></textarea>
						</div>
					</div>
					<div class="col-4 form-group">
						<label for="info_pagina_direccion_contacto" class="form-label" >Dirección:</label>
						<div class="input-group">
							<div class="input-group-prepend ">
								<span class="input-group-text input-icono fondo-direccion" ><i class="fas fa-map-marked-alt"></i></span>
							</div>
							<textarea name="info_pagina_direccion_contacto" id="info_pagina_direccion_contacto"   class="form-control" rows="2"  ><?= $this->content->info_pagina_direccion_contacto; ?></textarea>
						</div>
					</div>
					<div class="col-6 form-group">
						<label for="info_pagina_informacion_contacto" class="form-label" >Información Contacto:</label>
						<textarea name="info_pagina_informacion_contacto" id="info_pagina_informacion_contacto"   class="form-control tinyeditor" rows="10"   ><?= $this->content->info_pagina_informacion_contacto; ?></textarea>
					</div>
					<div class="col-6 form-group">
						<label for="info_pagina_informacion_contacto_footer"  class="control-label">Información Contacto Footer:</label>
						<textarea name="info_pagina_informacion_contacto_footer" id="info_pagina_informacion_contacto_footer"   class="form-control tinyeditor" rows="10"   ><?= $this->content->info_pagina_informacion_contacto_footer; ?></textarea>
					</div>
				</div>
			</div>
		</div>

		<a id="maps" name="maps"></a>
		<div class="div-dashboard">
			<h2>
				<img src="/skins/administracion/images/googlemaps.png"> Google Maps
			</h2>
			<div class="pading-dashboard">
				<div class="row">
					<div class="col-4 form-group">
						<label for="info_pagina_latitud"  class="control-label">Latitud:</label>
						<div class="input-group">
							<div class="input-group-prepend ">
								<span class="input-group-text input-icono-grande fondo-mapa-latitud" ><img src="/skins/administracion/images/mapa-latitud.png"></span>
							</div>
							<input type="text" value="<?= $this->content->info_pagina_latitud; ?>" name="info_pagina_latitud" id="info_pagina_latitud" class="form-control"   >
						</div>
					</div>
					<div class="col-4 form-group">
						<label for="info_pagina_longitud"  class="control-label">Longitud:</label>
						<div class="input-group">
							<div class="input-group-prepend ">
								<span class="input-group-text input-icono-grande fondo-mapa-longitud" ><img src="/skins/administracion/images/mapa-longitud.png"></span>
							</div>
							<input type="text" value="<?= $this->content->info_pagina_longitud; ?>" name="info_pagina_longitud" id="info_pagina_longitud" class="form-control"   >
						</div>
					</div>
					<div class="col-4 form-group">
						<label for="info_pagina_zoom"  class="control-label">Zoom:</label>
						<div class="input-group">
							<div class="input-group-prepend ">
								<span class="input-group-text input-icono-grande fondo-mapa-zoom" ><img src="/skins/administracion/images/mapa-zoom.png"></span>
							</div>
							<input type="text" value="<?= $this->content->info_pagina_zoom; ?>" name="info_pagina_zoom" id="info_pagina_zoom" class="form-control"   >
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="/administracion/panel" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>