<?php 

/**
*
*/

class Page_sedesController extends Page_mainController
{

	public function indexAction()
	{
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->sedes  =  $contenidoModel->getList("contenido_seccion = '2'","orden ASC");
	}

	public function detalleAction()
	{
		$data = $this->getRoutes()->getRoutes();
		$this->_view->contenidohome = $this->template->getContentid($data[0]);
	}
	


}