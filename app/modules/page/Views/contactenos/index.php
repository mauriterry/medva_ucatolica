<div class="titulo-internas1" style="background-image:url(/skins/page/images/fondo1.jpg)">
    <div align="center"><h2>Contáctenos</h2></div>
</div>
<div class="contacto">  
    <div class="container"> 
        <div class="col-sm-12">
            <?php  if($this->res == 1 ) { ?>
                <div align="center" class="alert alert-success"> El mensaje se envió satisfactoriamente, muy pronto nos pondremos en contacto contigo.</div>
            <?php } else if ($this->res == 2) {?>
                <div align="center" class="alert alert-danger">EL mensaje no se pudo enviar, intente de nuevo</div>
            <?php } ?> 
            <form method="POST" action="/page/contactenos/enviar" onsubmit="return miFuncion(this)">
                <div class="informacion-contacto-responsive">
                    <h3>Información de Contacto</h3><?php echo $this->infopage->info_pagina_informacion_contacto_footer ?>
                </div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="inputEmail4"></label>
								<input type="text"  name="nombre" class="form-control" id="inputEmail4" placeholder="Nombre:" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="inputEmail4"></label>
								<input type="email" name="email" class="form-control" id="inputEmail4" placeholder="E-mail:" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="inputEmail4"></label>
								<input type="number" max="9999999999" min="1000000000" name="telefono" class="form-control" id="inputEmail4" placeholder="Teléfono:" required>
							</div>
						</div>
                        <div class="form-row">
							<div class="form-group col-md-12">
								<label for="inputEmail4"></label>
								<input type="text"  name="ciudad" class="form-control" id="inputEmail4" placeholder="Ciudad:" required>
							</div>
						</div>
					</div>
				</div>
                <div class="form-row">
                    <div class="form-group col-md-12">
						<label for="inputEmail4"></label>
						<textarea style="resize:none;" class="form-control" name="mensaje" id="" rows="4" placeholder="Mensaje:" required></textarea>						
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check" required>
						<input class="form-check-input" type="checkbox" id="gridCheck" required>
						<label class="form-check-label" for="gridCheck">
							Politica de manejo de datos.
						</label>
                    </div>
                </div>
                <div class="g-recaptcha" data-sitekey="6LfeqpAUAAAAANvnKLrd1MIOGb6585JWIfA4oJJ-"></div>
                <div class="boton-contactenos"><button type="submit" class="btn btn-primary">Enviar</button></div>
            </form>
        </div>
    </div>
</div>
<script>
    function miFuncion(a) {
    var response = grecaptcha.getResponse();

    if(response.length == 0){
        alert("Captcha no verificado");
        return false;
        event.preventDefault();
    } else {
      return true;
    }
  }
</script>