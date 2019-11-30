<?php 
/**
* clase que genera la insercion y edicion  de Graficas en la base de datos
*/
class Administracion_Model_DbTable_Graficas extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'grafica';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'grafica_id';

	/**
	 * insert recibe la informacion de un Grafica y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$grafica_tipo = $data['grafica_tipo'];
		$grafica_lado = $data['grafica_lado'];
		$grafica_padre = $data['grafica_padre'];
		$grafica_nombre = $data['grafica_nombre'];
		$grafica_valor = $data['grafica_valor'];
		$grafica_estado = $data['grafica_estado'];
		$query = "INSERT INTO grafica( grafica_tipo, grafica_lado, grafica_padre, grafica_nombre, grafica_valor, grafica_estado) VALUES ( '$grafica_tipo', '$grafica_lado','$grafica_padre', '$grafica_nombre', '$grafica_valor', '$grafica_estado')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Grafica  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		$grafica_tipo = $data['grafica_tipo'];
		$grafica_tipo = $data['grafica_lado'];
		$grafica_padre = $data['grafica_padre'];
		$grafica_nombre = $data['grafica_nombre'];
		$grafica_valor = $data['grafica_valor'];
		$grafica_estado = $data['grafica_estado'];
		$query = "UPDATE grafica SET  grafica_tipo = '$grafica_tipo', grafica_lado = '$grafica_lado', grafica_padre = '$grafica_padre', grafica_nombre = '$grafica_nombre', grafica_valor = '$grafica_valor', grafica_estado = '$grafica_estado' WHERE grafica_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}