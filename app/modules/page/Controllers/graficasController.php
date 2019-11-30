<?php 

/**
*
*/

class Page_graficasController extends Page_mainController{

	public function indexAction(){
        $this->_view->contenidohome = $this->templateGraficas->getContentid($data[0]);
	}

}