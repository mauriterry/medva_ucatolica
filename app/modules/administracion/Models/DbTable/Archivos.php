<?php 
/**
* clase que genera la insercion y edicion  de Archivos en la base de datos
*/
class Administracion_Model_DbTable_Archivos extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'archivos';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'archivo_id';

	/**
	 * insert recibe la informacion de un Archivo y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$archivo_nombre = $data['archivo_nombre'];
		$archivo_formato = $data['archivo_formato'];
		$archivo_dispositivo = $data['archivo_dispositivo'];
		$archivo_sede = $data['archivo_sede'];
		$query = "INSERT INTO archivos( archivo_nombre, archivo_formato, archivo_dispositivo, archivo_sede) VALUES ( '$archivo_nombre', '$archivo_formato', '$archivo_dispositivo', '$archivo_sede')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Archivo  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$archivo_nombre = $data['archivo_nombre'];
		$archivo_formato = $data['archivo_formato'];
		$archivo_dispositivo = $data['archivo_dispositivo'];
		$archivo_sede = $data['archivo_sede'];
		$query = "UPDATE archivos SET  archivo_nombre = '$archivo_nombre', archivo_formato = '$archivo_formato', archivo_dispositivo = '$archivo_dispositivo', archivo_sede = '$archivo_sede' WHERE archivo_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}