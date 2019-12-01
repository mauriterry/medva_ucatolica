<?php
/**
* Controlador de Datos que permite la  creacion, edicion  y eliminacion de los datos del Sistema
*/
class Administracion_datosController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos datos
	 * @var modeloContenidos
	 */
	public $mainModel;

	/**
	 * $route  url del controlador base
	 * @var string
	 */
	protected $route;

	/**
	 * $pages cantidad de registros a mostrar por pagina]
	 * @var integer
	 */
	protected $pages ;

	/**
	 * $namefilter nombre de la variable a la fual se le van a guardar los filtros
	 * @var string
	 */
	protected $namefilter;

	/**
	 * $_csrf_section  nombre de la variable general csrf  que se va a almacenar en la session
	 * @var string
	 */
	protected $_csrf_section = "administracion_datos";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador datos .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Datos();
		$this->namefilter = "parametersfilterdatos";
		$this->route = "/administracion/datos";
		$this->namepages ="pages_datos";
		$this->namepageactual ="page_actual_datos";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  datos con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Aministración de datos";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters =(object)Session::getInstance()->get($this->namefilter);
        $this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "";
		$list = $this->mainModel->getList($filters,$order);
		$amount = $this->pages;
		$page = $this->_getSanitizedParam("page");
		if (!$page && Session::getInstance()->get($this->namepageactual)) {
		   	$page = Session::getInstance()->get($this->namepageactual);
		   	$start = ($page - 1) * $amount;
		} else if(!$page){
			$start = 0;
		   	$page=1;
			Session::getInstance()->set($this->namepageactual,$page);
		} else {
			Session::getInstance()->set($this->namepageactual,$page);
		   	$start = ($page - 1) * $amount;
		}
		$this->_view->register_number = count($list);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($list)/$amount);
		$this->_view->page = $page;
		$this->_view->lists = $this->mainModel->getListPages($filters,$order,$start,$amount);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->list_dispositivo = $this->getDispositivo();
		$this->_view->list_sede = $this->getSede();
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  dato  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_datos_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->list_dispositivo = $this->getDispositivo();
		$this->_view->list_sede = $this->getSede();
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar dato";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear dato";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear dato";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un dat  y redirecciona al listado de datos.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$data = $this->getData();
			$id = $this->mainModel->insert($data);
			$data['id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR DATO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Inserta la informacion de una array de cadena  y redirecciona al listado de datos.
     *
     * @return void.
     */

	public function insertDatosAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$data = $this->firebase();
			foreach($data as $key => $value){
				$id = $this->mainModel->insert1($value);
				$value['id']= $id;
				$value['log_log'] = print_r($value,true);
				$value['log_tipo'] = 'CREAR DATOS CARGADOS DE FIREBASE';
				$logModel = new Administracion_Model_DbTable_Log();
				$logModel->insert($value);
			}
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Descarga la informacion del listado de datos y genera un archivo excel.
     *
     * @return void.
     */

	public function descargarDatosAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->generararchivoExcel();
			$value['id']= $id;
			$value['log_log'] = print_r($value,true);
			$value['log_tipo'] = 'CREAR DATOS CARGADOS DE FIREBASE';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($value);
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un dato  y redirecciona al listado de datos.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->id) {
				$data = $this->getData();
					$this->mainModel->update($data,$id);
			}
			$data['id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR DATO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y elimina un dato  y redirecciona al listado de datos.
     *
     * @return void.
     */
	public function deleteAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_csrf_section] == $csrf ) {
			$id =  $this->_getSanitizedParam("id");
			if (isset($id) && $id > 0) {
				$content = $this->mainModel->getById($id);
				if (isset($content)) {
					$this->mainModel->deleteRegister($id);$data = (array)$content;
					$data['log_log'] = print_r($data,true);
					$data['log_tipo'] = 'BORRAR DATO';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Datos.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['fecha'] = $this->_getSanitizedParam("fecha");
		$data['hora'] = $this->_getSanitizedParam("hora");
		$data['codigo'] = $this->_getSanitizedParam("codigo");
		if($this->_getSanitizedParam("valCarbono") == '' ) {
			$data['valCarbono'] = '0';
			$data['carbonoV'] = '0' ;
			$data['rsCarbono'] = '0' ;
			$data['ppmCarbono'] = '0' ;
		} else {
			$data['valCarbono'] = $this->_getSanitizedParam("valCarbono");
			$data['carbonoV'] = ($this->_getSanitizedParam("valCarbono")/1024)*5 ;
			$data['rsCarbono'] = ((5 -$this->_getSanitizedParam("valCarbono"))/$this->_getSanitizedParam("valCarbono"))*1 ;
			$data['ppmCarbono'] = floatval('73,688')*(($this->_getSanitizedParam("valCarbono")/floatval('0,72'))^(floatval('-1,679'))) ;
		}
		if($this->_getSanitizedParam("valDioxido") == '' ) {
			$data['valDioxido'] = '0';
			$data['dioxidoV'] = '0' ;
			$data['rsDioxido'] = '0' ;
			$data['ppmDioxido'] = '0' ;
		} else {
			$data['valDioxido'] = $this->_getSanitizedParam("valDioxido");
			$data['dioxidoV'] = ($this->_getSanitizedParam("valDioxido")/1024)*5 ;
			$data['rsDioxido'] = ((5 -$this->_getSanitizedParam("valDioxido"))/$this->_getSanitizedParam("valDioxido"))*1 ; 
			$data['ppmDioxido'] = floatval('73,688')*(($this->_getSanitizedParam("valDioxido")/floatval('0,72'))^(floatval('-1,679'))) ;
		}
		if($this->_getSanitizedParam("valOzono") == '' ) {
			$data['valOzono'] = '0';
			$data['ozonoV'] = '0' ;
			$data['rsOzono'] = '0' ;
			$data['ppmOzono'] = '0' ;
		} else {
			$data['valOzono'] = $this->_getSanitizedParam("valOzono");
			$data['ozonoV'] = ($this->_getSanitizedParam("valOzono")/1024)*5 ;
			$data['rsOzono'] = ((5 -$this->_getSanitizedParam("valOzono"))/$this->_getSanitizedParam("valOzono"))*1 ;
			$data['ppmOzono'] = floatval('73,688')*(($this->_getSanitizedParam("valOzono")/floatval('0,72'))^(floatval('-1,679'))) ;
		}
				
		if($this->_getSanitizedParam("dispositivo") == '' ) {
			$data['dispositivo'] = '0';
		} else {
			$data['dispositivo'] = $this->_getSanitizedParam("dispositivo");
		}
		if($this->_getSanitizedParam("sede") == '' ) {
			$data['sede'] = '0';
		} else {
			$data['sede'] = $this->_getSanitizedParam("sede");
		}
		return $data;
	}

	/**
     * Genera un archivo Excel con la lista de la Tabla Datos.
     *
     * @return al escritorio un Archivo Excel.
     */

	public function generararchivoExcel(){
		$contador1Datos = 3;
		$dataDatos = $this->mainModel->getList();
		$modelDataDispositivos = new Administracion_Model_DbTable_Dependdispositivos();
		$dataDispositivos = $modelDataDispositivos->getList();
		$modelDataSedes = new Administracion_Model_DbTable_Dependsedes();
		$dataSedes = $modelDataSedes->getList();

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Add some data
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('E1', 'Valores Datos Recolectados')
		            ->setCellValue('A2', 'id')
		            ->setCellValue('B2', 'fecha')
		            ->setCellValue('C3', 'fecha')
		            ->setCellValue('D2', 'codigo')
		            ->setCellValue('E2', 'valCarbono')
		            ->setCellValue('F2', 'valDioxido')
		            ->setCellValue('G2', 'valOzono')
		            ->setCellValue('H2', 'dispositivo')
		            ->setCellValue('I2', 'sede');

		foreach ($dataDatos as $key => $value) {
			$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('A' . $contador1Datos, $value->id)
		            ->setCellValue('B' . $contador1Datos, $value->fecha)
		            ->setCellValue('C' . $contador1Datos, $value->hora)
		            ->setCellValue('D' . $contador1Datos, $value->codigo)
		            ->setCellValue('E' . $contador1Datos, $value->valCarbono)
		            ->setCellValue('F' . $contador1Datos, $value->valDioxido)
		            ->setCellValue('G' . $contador1Datos, $value->valOzono)
		            ->setCellValue('H' . $contador1Datos, $value->dispositivo)
		            ->setCellValue('I' . $contador1Datos, $value->sede);
		   $contador1Datos += 1;
		}

		 // Miscellaneous glyphs, UTF-8
		$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('M1', 'Valores Sedes')
		            ->setCellValue('L2', 'id')
		            ->setCellValue('M2', 'nombre')
		            ->setCellValue('N2', 'descripcion');

		$contador1Datos = 3;
		foreach ($dataSedes as $key => $value) {
			$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('L' . $contador1Datos, $value->id)
		            ->setCellValue('M' . $contador1Datos, $value->nombre)
		            ->setCellValue('N' . $contador1Datos, $value->descripcion);

			$contador1Datos += 1;
		}

		// Miscellaneous glyphs, UTF-8
		$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('R1', 'Valores Dispositivos')
		            ->setCellValue('Q2', 'id')
		            ->setCellValue('R2', 'nombre')
		            ->setCellValue('S2', 'descripcion');

		$contador1Datos = 3;
		foreach ($dataDispositivos as $key => $value) {
			$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('Q' . $contador1Datos, $value->id)
		            ->setCellValue('R' . $contador1Datos, $value->nombre)
		            ->setCellValue('S' . $contador1Datos, $value->descripcion);

			$contador1Datos += 1;
		}

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Datos Recolectados');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="archivosdatosMedva.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	}

	/**
     * Genera un los valores correspondientea a la Tabla Datos.
     *
     * @return un Array de Cadena.
     */

	public function firebase(){
		$dat = $this->getFirebase();
		$dat1 = json_decode($dat,true);
		$modulodat = [];
		$datos = [];
		$contador = 0;
		foreach($dat1 as $key => $value){
			if($key == "Sensores"){
				$modulodat = $value;
				foreach($modulodat as $key => $value){
					$modulodat1 = $value;
					$modulonombre = $key;
					if( $key == "ModuloF1" || $key == "ModuloF2"){
						foreach($modulodat1["Sedes"] as $key => $value){
							$modulodat2 = $value;
							$modulosedes = $key;
							foreach($modulodat2 as $key => $value){
								$modulodat3 = $this->orderMultiDimensionalArray($value,$modulofechas);
								$modulofechas = $key;
								foreach($modulodat3 as $key => $value){
									$modulodat4 = $value;
									$modulodato = $key;
									foreach($modulodat4 as $key => $value){
										$modulovalores = $value;
										if($key == "texto"){
											$modulovalores1 = $this->getValores($modulovalores);
										}
										if($key == "Hora"){
											$modulohora = $modulovalores;
										}
									}
									$datos[$contador]["modulonombre"] = $this->getValNombre($modulonombre);
									$datos[$contador]["modulosedes"] = $this->getValSedes($modulosedes);
									$datos[$contador]["modulofechas"] = $modulofechas;
									$datos[$contador]["modulodato"] = $modulodato;
									$datos[$contador]["modulohora"] = $modulohora;
									$datos[$contador]["modulovalores"] = explode(",", $modulovalores1);
									$contador += 1;
								}
							}
						}
					}
				}
			}
		}
		return $datos;
	}

	/**
     * Obtene un Cadena y reemplaza el valor por la key que es asignada.
     *
     * @return una Cadena.
     */

	public function getValNombre($string){
		$dispositivos = $this->getDispositivo();
		$dispo = "";
		foreach($dispositivos as $key => $value){
			if($value == $string){
				$dispo = $key;
			}
		}
		return $dispo;
	}

	/**
     * Obtene un Cadena y reemplaza el valor por la key que es asignada.
     *
     * @return una Cadena.
     */

	public function getValSedes($string){
		$sedes = $this->getSede();
		$sed = "";
		foreach($sedes as $key => $value){
			if($value == $string){
				$sed = $key;
			}
		}
		return $sed;
	}

	/**
     * Obtene un Array Cadena y lo ordena de menos a mayor.
     *
     * @return una Array Cadena.
     */

	public function orderMultiDimensionalArray($toOrderArray, $field, $inverse = false) {
	    $position = array();
	    $newRow = array();
	    foreach ($toOrderArray as $key => $row) {
	            $position[$key]  = $row[$field];
	            $newRow[$key] = $row;
	    }
	    if ($inverse) {
	        arsort($position);
	    }
	    else {
	        asort($position);
	    }
	    $returnArray = array();
	    foreach ($position as $key => $pos) {
	        $returnArray[] = $newRow[$key];
	    }
	    return $returnArray;
	}

	/**
     * Obtene un String y remplaza algunas letras por comas.
     *
     * @return una cadena.
     */

	public function getValores($string){
		$datos = str_replace("c","",$string);
		$datos = str_replace("o",",",$datos);
		$datos = str_replace("d",",",$datos);
		return $datos;
	}

	/**
     * Extrae los valores de Firebase.
     *
     * @return array cadena con los valores de Firebase Console.
     */

	public function getFirebase(){
    	$url = "https://esp32-8cc87.firebaseio.com/Medva.json";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		return $result;
		header('Location: '.$this->route.''.'');
	}

	/**
     * Genera los valores del campo Nombre Dispositivo.
     *
     * @return array cadena con los valores del campo Nombre Dispositivo.
     */
	private function getDispositivo()
	{
		$modelData = new Administracion_Model_DbTable_Dependdispositivos();
		$data = $modelData->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->id] = $value->nombre;
		}
		return $array;
	}


	/**
     * Genera los valores del campo Nombre Sede.
     *
     * @return array cadena con los valores del campo Nombre Sede.
     */
	private function getSede()
	{
		$modelData = new Administracion_Model_DbTable_Dependsedes();
		$data = $modelData->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->id] = $value->nombre;
		}
		return $array;
	}

	/**
     * Genera la consulta con los filtros de este controlador.
     *
     * @return array cadena con los filtros que se van a asignar a la base de datos
     */
    protected function getFilter()
    {
    	$filtros = " 1 = 1 ";
        if (Session::getInstance()->get($this->namefilter)!="") {
            $filters =(object)Session::getInstance()->get($this->namefilter);
            if ($filters->fecha != '') {
                $filtros = $filtros." AND fecha LIKE '%".$filters->fecha."%'";
            }
            if ($filters->hora != '') {
                $filtros = $filtros." AND hora LIKE '%".$filters->hora."%'";
            }
            if ($filters->codigo != '') {
                $filtros = $filtros." AND codigo LIKE '%".$filters->codigo."%'";
            }
            if ($filters->valCarbono != '') {
                $filtros = $filtros." AND valCarbono LIKE '%".$filters->valCarbono."%'";
            }
            if ($filters->valDioxido != '') {
                $filtros = $filtros." AND valDioxido LIKE '%".$filters->valDioxido."%'";
            }
            if ($filters->valOzono != '') {
                $filtros = $filtros." AND valOzono LIKE '%".$filters->valOzono."%'";
            }
            if ($filters->dispositivo != '') {
                $filtros = $filtros." AND dispositivo LIKE '%".$filters->dispositivo."%'";
            }
            if ($filters->sede != '') {
                $filtros = $filtros." AND sede LIKE '%".$filters->sede."%'";
            }
		}
        return $filtros;
    }

    /**
     * Recibe y asigna los filtros de este controlador
     *
     * @return void
     */
    protected function filters()
    {
        if ($this->getRequest()->isPost()== true) {
        	Session::getInstance()->set($this->namepageactual,1);
            $parramsfilter = array();
					$parramsfilter['fecha'] =  $this->_getSanitizedParam("fecha");
					$parramsfilter['hora'] =  $this->_getSanitizedParam("hora");
					$parramsfilter['codigo'] =  $this->_getSanitizedParam("codigo");
					$parramsfilter['valCarbono'] =  $this->_getSanitizedParam("valCarbono");
					$parramsfilter['valDioxido'] =  $this->_getSanitizedParam("valDioxido");
					$parramsfilter['valOzono'] =  $this->_getSanitizedParam("valOzono");
					$parramsfilter['dispositivo'] =  $this->_getSanitizedParam("dispositivo");
					$parramsfilter['sede'] =  $this->_getSanitizedParam("sede");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}