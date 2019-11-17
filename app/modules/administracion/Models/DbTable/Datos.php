<?php
/**
* clase que genera la insercion y edicion  de datos en la base de datos
*/
class Administracion_Model_DbTable_Datos extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'datos';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'id';

	/**
	 * insert recibe la informacion de un dato y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$fecha = $data['fecha'];
		$hora = $data['hora'];
		$codigo = $data['codigo'];
		$valCarbono = $data['valCarbono'];
		$valDioxido = $data['valDioxido'];
		$valOzono = $data['valOzono'];
		$dispositivo = $data['dispositivo'];
		$sede = $data['sede'];
		$query = "INSERT INTO datos( fecha, hora, codigo, valCarbono, valDioxido, valOzono, dispositivo, sede) VALUES ( '$fecha', '$hora', '$codigo', '$valCarbono', '$valDioxido', '$valOzono', '$dispositivo', '$sede')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	public function insert1($data){
		$fecha = $data['modulofechas'];
		$hora = $data['modulohora'];
		$codigo = $data['modulodato'];
		$valCarbono = $data['modulovalores'][0];
		$valDioxido = $data['modulovalores'][2];
		$valOzono = $data['modulovalores'][1];
		$dispositivo = $data['modulonombre'];
		$sede = $data['modulosedes'];
		$query = "INSERT INTO datos( fecha, hora, codigo, valCarbono, valDioxido, valOzono, dispositivo, sede) VALUES ( '$fecha', '$hora', '$codigo', '$valCarbono', '$valDioxido', '$valOzono', '$dispositivo', '$sede')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un dato  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){

		$fecha = $data['fecha'];
		$hora = $data['hora'];
		$codigo = $data['codigo'];
		$valCarbono = $data['valCarbono'];
		$valDioxido = $data['valDioxido'];
		$valOzono = $data['valOzono'];
		$dispositivo = $data['dispositivo'];
		$sede = $data['sede'];
		$query = "UPDATE datos SET  fecha = '$fecha', hora = '$hora', codigo = '$codigo', valCarbono = '$valCarbono', valDioxido = '$valDioxido', valOzono = '$valOzono', dispositivo = '$dispositivo', sede = '$sede' WHERE id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}