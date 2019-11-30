<?php
/**
* Controlador de Graficas que permite la  creacion, edicion  y eliminacion de los Graficas del Sistema
*/
class Administracion_graficasController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos Graficas
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
	protected $_csrf_section = "administracion_graficas";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador graficas .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Graficas();
		$this->namefilter = "parametersfiltergraficas";
		$this->route = "/administracion/graficas";
		$this->namepages ="pages_graficas";
		$this->namepageactual ="page_actual_graficas";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  Graficas con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Aministración de Graficas";
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
		$this->_view->padre = $this->_getSanitizedParam("padre");
		$this->_view->padre2 = $this->getPadre2($this->_getSanitizedParam("padre"));		
		$this->_view->list_grafica_tipo = $this->getGraficatipo();
		$this->_view->list_grafica_lado = $this->getGraficalado();
		$this->_view->list_grafica_estado = $this->getGraficaestado();
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  Grafica  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_graficas_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->list_grafica_tipo = $this->getGraficatipo();
		$this->_view->list_grafica_lado = $this->getGraficalado();
		$this->_view->list_grafica_estado = $this->getGraficaestado();
		$padre2 = $this->getPadre2($this->_getSanitizedParam("padre"));
		$padre = $this->_getSanitizedParam("padre");
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->grafica_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar Grafica";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
				$padre = $content->grafica_padre;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear Grafica";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear Grafica";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
		$this->_view->padre = $padre;
		$this->_view->padre2 = $padre2;
	}

	/**
     * Inserta la informacion de un Grafica  y redirecciona al listado de Graficas.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$id = $this->mainModel->insert($data);
			$this->mainModel->changeOrder($id,$id);
			$data['grafica_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR GRAFICA';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		$rutaadicional = "";
		$padre = $this->_getSanitizedParam("grafica_padre");
		$padre2 = $this->getPadre2($this->_getSanitizedParam("grafica_padre"));
		if($padre > 0 ){
			if($padre > $padre2 ){
				$rutaadicional = "?padre=".$padre."&padre2=".$padre2;;
			}else{
				$rutaadicional = "?padre=".$padre;
			}
		}
		header('Location: '.$this->route.$rutaadicional);
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un Grafica  y redirecciona al listado de Graficas.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->grafica_id) {
				$data = $this->getData();
					$this->mainModel->update($data,$id);
			}
			$data['grafica_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR GRAFICA';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		$rutaadicional = "";
		$padre = $this->_getSanitizedParam("grafica_padre");
		if($padre > 0 ){
			$rutaadicional = "?padre=".$padre;
		}
		header('Location: '.$this->route.$rutaadicional);
	}

	/**
     * Recibe un identificador  y elimina un Grafica  y redirecciona al listado de Graficas.
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
					$data['log_tipo'] = 'BORRAR GRAFICA';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		$rutaadicional = "";
		$padre = $this->_getSanitizedParam("grafica_padre");
		if($padre > 0 ){
			$rutaadicional = "?padre=".$padre;
		}
		header('Location: '.$this->route.$rutaadicional);
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Graficas.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		if($this->_getSanitizedParam("grafica_tipo") == '' ) {
			$data['grafica_tipo'] = '0';
		} else {
			$data['grafica_tipo'] = $this->_getSanitizedParam("grafica_tipo");
		}
		if($this->_getSanitizedParam("grafica_lado") == '' ) {
			$data['grafica_lado'] = '0';
		} else {
			$data['grafica_lado'] = $this->_getSanitizedParam("grafica_lado");
		}
		if($this->_getSanitizedParam("grafica_padre") == '' ) {
			$data['grafica_padre'] = '0';
		} else {
			$data['grafica_padre'] = $this->_getSanitizedParam("grafica_padre");
		}
		$data['grafica_nombre'] = $this->_getSanitizedParam("grafica_nombre");
		if($this->_getSanitizedParam("grafica_valor") == '' ) {
			$data['grafica_valor'] = '0';
		} else {
			$data['grafica_valor'] = $this->_getSanitizedParam("grafica_valor");
		}
		if($this->_getSanitizedParam("grafica_estado") == '' ) {
			$data['grafica_estado'] = '0';
		} else {
			$data['grafica_estado'] = $this->_getSanitizedParam("grafica_estado");
		}
		return $data;
	}

	/**
     * Genera los valores del campo grafica_tipo.
     *
     * @return array cadena con los valores del campo grafica_tipo.
     */
	private function getGraficatipo()
	{
		$modelData = new Administracion_Model_DbTable_Dependtipograficas();
		$data = $modelData->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->id] = $value->nombre;
		}
		return $array;
	}

	/**
	* Genera los valores del campo grafica_tipo.
	*
	* @return array cadena con los valores del campo grafica_tipo.
	*/
	private function getGraficalado()
	{
		$modelData = new Administracion_Model_DbTable_Dependladograficas();
		$data = $modelData->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->id] = $value->nombre;
		}
		return $array;
	}


	/**
	* Genera los valores del campo grafica_tipo.
	*
	* @return array cadena con los valores del campo grafica_tipo.
	*/
	private function getPadre2($id)
	{
		$data = $this->mainModel->getList("grafica_id = ".$id,"orden ASC");
		$contador = 0;
		$padre2 = 0;
		foreach ($data as $key => $value) {
			$padre2 = $value->grafica_padre;
		}
		return $padre2;
	}
	

	/**
     * Genera la consulta con los filtros de este controlador.
     *
     * @return array cadena con los filtros que se van a asignar a la base de datos
     */
    protected function getFilter()
    {
    	$filtros = " 1 = 1 "; 
		$padre = $this->_getSanitizedParam('padre');
		$filtros = $filtros." AND grafica_padre = '$padre' ";
        if (Session::getInstance()->get($this->namefilter)!="") {
			$filters =(object)Session::getInstance()->get($this->namefilter);
			if ($filters->grafica_tipo != '') {
                $filtros = $filtros." AND grafica_tipo LIKE '%".$filters->grafica_tipo."%'";
			}
			if ($filters->grafica_lado != '') {
                $filtros = $filtros." AND grafica_lado LIKE '%".$filters->grafica_lado."%'";
            }
            if ($filters->grafica_nombre != '' && $padre!='') {
                $filtros = $filtros." AND grafica_nombre LIKE '%".$filters->grafica_nombre."%'";
            }
            if ($filters->grafica_valor != '') {
                $filtros = $filtros." AND grafica_valor LIKE '%".$filters->grafica_valor."%'";
			}
            if ($filters->grafica_estado != '') {
                $filtros = $filtros." AND grafica_estado LIKE '%".$filters->grafica_estado."%'";
            }
		}
        return $filtros;
	}
	
	/**
     * Genera los valores del campo Estado.
     *
     * @return array cadena con los valores del campo Estado.
     */
	private function getGraficaestado()
	{
		$array = array();
		$array['1'] = 'Activo';
		$array['2'] = 'Inactivo';
		return $array;
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
			$parramsfilter['grafica_tipo'] =  $this->_getSanitizedParam("grafica_tipo");
			$parramsfilter['grafica_lado'] =  $this->_getSanitizedParam("grafica_lado");
			$parramsfilter['grafica_nombre'] =  $this->_getSanitizedParam("grafica_nombre");
			$parramsfilter['grafica_valor'] =  $this->_getSanitizedParam("grafica_valor");
			$parramsfilter['grafica_estado'] =  $this->_getSanitizedParam("grafica_estado");
			Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}