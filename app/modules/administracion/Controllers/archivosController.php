<?php
/**
* Controlador de Archivos que permite la  creacion, edicion  y eliminacion de los Archivos del Sistema
*/
class Administracion_archivosController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos Archivos
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
	protected $_csrf_section = "administracion_archivos";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador archivos .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Archivos();
		$this->namefilter = "parametersfilterarchivos";
		$this->route = "/administracion/archivos";
		$this->namepages ="pages_archivos";
		$this->namepageactual ="page_actual_archivos";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  Archivos con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Aministración de Archivos";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters =(object)Session::getInstance()->get($this->namefilter);
        $this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "orden ASC";
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
		$this->_view->list_archivo_dispositivo = $this->getArchivodispositivo();
		$this->_view->list_archivo_sede = $this->getArchivosede();
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  Archivo  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_archivos_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->list_archivo_dispositivo = $this->getArchivodispositivo();
		$this->_view->list_archivo_sede = $this->getArchivosede();
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->archivo_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar Archivo";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear Archivo";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear Archivo";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un Archivo  y redirecciona al listado de Archivos.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$uploadDocument =  new Core_Model_Upload_Document();
			if($_FILES['archivo_formato']['name'] != ''){
				$data['archivo_formato'] = $uploadDocument->upload("archivo_formato");
			}
			$id = $this->mainModel->insert($data);
			$this->mainModel->changeOrder($id,$id);
			$data['archivo_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR ARCHIVO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un Archivo  y redirecciona al listado de Archivos.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->archivo_id) {
				$data = $this->getData();
					$uploadDocument =  new Core_Model_Upload_Document();
				if($_FILES['archivo_formato']['name'] != ''){
					if($content->archivo_formato){
						$uploadDocument->delete($content->archivo_formato);
					}
					$data['archivo_formato'] = $uploadDocument->upload("archivo_formato");
				} else {
					$data['archivo_formato'] = $content->archivo_formato;
				}
				$this->mainModel->update($data,$id);
			}
			$data['archivo_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR ARCHIVO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y elimina un Archivo  y redirecciona al listado de Archivos.
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
					$uploadDocument =  new Core_Model_Upload_Document();
					if (isset($content->archivo_formato) && $content->archivo_formato != '') {
						$uploadDocument->delete($content->archivo_formato);
					}
					$this->mainModel->deleteRegister($id);$data = (array)$content;
					$data['log_log'] = print_r($data,true);
					$data['log_tipo'] = 'BORRAR ARCHIVO';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Archivos.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['archivo_nombre'] = $this->_getSanitizedParam("archivo_nombre");
		$data['archivo_formato'] = "";
		if($this->_getSanitizedParam("archivo_dispositivo") == '' ) {
			$data['archivo_dispositivo'] = '0';
		} else {
			$data['archivo_dispositivo'] = $this->_getSanitizedParam("archivo_dispositivo");
		}
		if($this->_getSanitizedParam("archivo_sede") == '' ) {
			$data['archivo_sede'] = '0';
		} else {
			$data['archivo_sede'] = $this->_getSanitizedParam("archivo_sede");
		}
		return $data;
	}

	/**
     * Genera los valores del campo Dispositivo.
     *
     * @return array cadena con los valores del campo Dispositivo.
     */
	private function getArchivodispositivo()
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
     * Genera los valores del campo Sede.
     *
     * @return array cadena con los valores del campo Sede.
     */
	private function getArchivosede()
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
            if ($filters->archivo_nombre != '') {
                $filtros = $filtros." AND archivo_nombre LIKE '%".$filters->archivo_nombre."%'";
            }
            if ($filters->archivo_formato != '') {
                $filtros = $filtros." AND archivo_formato LIKE '%".$filters->archivo_formato."%'";
            }
            if ($filters->archivo_dispositivo != '') {
                $filtros = $filtros." AND archivo_dispositivo LIKE '%".$filters->archivo_dispositivo."%'";
            }
            if ($filters->archivo_sede != '') {
                $filtros = $filtros." AND archivo_sede LIKE '%".$filters->archivo_sede."%'";
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
					$parramsfilter['archivo_nombre'] =  $this->_getSanitizedParam("archivo_nombre");
					$parramsfilter['archivo_formato'] =  $this->_getSanitizedParam("archivo_formato");
					$parramsfilter['archivo_dispositivo'] =  $this->_getSanitizedParam("archivo_dispositivo");
					$parramsfilter['archivo_sede'] =  $this->_getSanitizedParam("archivo_sede");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}