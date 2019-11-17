<?php

/**
*
*/

class Page_indexController extends Page_mainController
{

	public function indexAction()
	{
		$this->_view->bannerprincipal = $this->template->bannerprincipal(1);
		//$contenidoModel = new Page_Model_DbTable_Contenido();
		//$this->_view->servicios = $contenidoModel->getList("contenido_seccion = '2' ","orden ASC");
		$this->_view->contenidohome = $this->template->getContentseccion(1);
	}

}