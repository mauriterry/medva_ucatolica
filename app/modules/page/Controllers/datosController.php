<?php 

/**
*
*/

class Page_datosController extends Page_mainController
{ 
    public function indexAction()
	{
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->datos  =  $contenidoModel->getList("contenido_seccion = '4'","orden ASC");
	}

	public function detalleAction()
	{
		$data = $this->getRoutes()->getRoutes();
		$this->_view->contenidohome = $this->template->getContentid($data[0]);
	}
}