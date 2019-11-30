<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>" data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->grafica_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->grafica_id; ?>" />
			<?php }?>
			<?php 
				if($this->content->grafica_padre) { $padre = $this->content->grafica_padre; } else { $padre = $this->padre; }
			 ?>
			<div class="row">
				<div class="col-4 form-group">
					<label for="grafica_nombre"  class="control-label">Nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->grafica_nombre; ?>" name="grafica_nombre" id="grafica_nombre" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<?php if( $padre > 0 ){ ?>
					<?php if($this->padre > $this->padre2 || $this->padre == $this->padre2 ){ ?>
						<div class="col-4 form-group">
							<label for="grafica_valor"  class="control-label">Valor</label>
							<label class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text input-icono  fondo-azul " ><i class="fas fa-pencil-alt"></i></span>
								</div>
								<input type="text" value="<?= $this->content->grafica_valor; ?>" name="grafica_valor" id="grafica_valor" class="form-control"  required >
							</label>
							<div class="help-block with-errors"></div>
						</div>
					<?php }else{ ?>
						<div class="col-4 form-group">
							<label class="control-label">Lado</label>
							<label class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text input-icono  fondo-azul-claro " ><i class="far fa-list-alt"></i></span>
								</div>
								<select class="form-control" name="grafica_lado"  required >
									<option value="">Seleccione...</option>
									<?php foreach ($this->list_grafica_lado AS $key => $value ){?>
										<option <?php if($this->getObjectVariable($this->content,"grafica_lado") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
									<?php } ?>
								</select>
							</label>
							<div class="help-block with-errors"></div>
						</div>
					<?php } ?>
				<?php }else{ ?>
					<div class="col-4 form-group">
						<label class="control-label">Tipo</label>
						<label class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text input-icono  fondo-azul-claro " ><i class="far fa-list-alt"></i></span>
							</div>
							<select class="form-control" name="grafica_tipo"  required >
								<option value="">Seleccione...</option>
								<?php foreach ($this->list_grafica_tipo AS $key => $value ){?>
									<option <?php if($this->getObjectVariable($this->content,"grafica_tipo") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
								<?php } ?>
							</select>
						</label>
						<div class="help-block with-errors"></div>
					</div>
				<?php } ?>
				<div class="col-4 form-group">
					<label for="grafica_nombre"  class="control-label">Estado</label>
					<label class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text input-icono  fondo-azul-claro "><i class="far fa-list-alt"></i></span>
                        </div>
                        <select class="form-control" name="grafica_estado">
                            <option value="">Seleccione...</option>
                            <?php foreach ($this->list_grafica_estado AS $key => $value ){?>
                            <option <?php if($this->getObjectVariable($this->content,"grafica_estado") == $key ){
                                echo "selected"; }?> value="
                                <?php echo $key; ?>" />
                                <?= $value; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </label>
					<div class="help-block with-errors"></div>
				</div>
				<input type="hidden" name="grafica_padre"  value="<?php echo $padre ?>">
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?><?php if($padre ){ echo "?padre=".$padre; } ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>