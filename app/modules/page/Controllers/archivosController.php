<?php 

/**
*
*/

class Page_archivosController extends Page_mainController
{

	public function indexAction()
	{
        $archivosModel = new Page_Model_DbTable_Archivos();
        $this->_view->archivos = $archivosModel->getList(" 1 = 1 ", "orden ASC");
	}

}