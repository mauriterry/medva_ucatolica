<?php 

/**
*
*/

class Page_nosotrosController extends Page_mainController
{

	public function indexAction()
	{
		$this->_view->contenidos = $this->template->getContentseccion(3);
	}

}