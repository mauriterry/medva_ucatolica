<?php foreach ($this->graficas as $key => $resvalue): ?>
	<?php $id = $resvalue['id'];  ?>
	<?php $value = $resvalue['detalle'];  ?>
	<?php foreach ($resvalue['hijos'] as $key => $resvalue2): ?>
		<?php $id = $resvalue2['detalle']->grafica_id ; ?>
		<?php $lados[$key] = $resvalue2['detalle'];  ?>
		<?php $valores[$key] = $resvalue2['hijos'];  ?>
	<?php endforeach ?>
	<?php if($value->grafica_tipo == 1 ){ ?>
		<?php include(APP_PATH."modules/page/Views/template/graficas/bar.php"); ?>
	<?php } else if($value->grafica_tipo == 2){ ?>
		<?php  include(APP_PATH."modules/page/Views/template/graficas/line.php"); ?>
	<?php } else if($value->grafica_tipo == 3){ ?>
		<?php include(APP_PATH."modules/page/Views/template/graficas/pola.php"); ?>
	<?php } else if($value->grafica_tipo == 4){ ?>
		<?php include(APP_PATH."modules/page/Views/template/graficas/radar.php"); ?>
	<?php } else if($value->grafica_tipo == 5){ ?>
		<?php include(APP_PATH."modules/page/Views/template/graficas/pie.php"); ?>
	<?php } ?>
<?php endforeach ?>