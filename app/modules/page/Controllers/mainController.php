<?php

/**
*
*/

class Page_mainController extends Controllers_Abstract
{

	public $template;
	public $templateGraficas;

	public function init()
	{
		$this->setLayout('page_page');
		$this->template = new Page_Model_Template_Template($this->_view);
		$this->templateGraficas = new Page_Model_Template_templateGraficas($this->_view);
		$infopageModel = new Page_Model_DbTable_Informacion();
		$this->_view->infopage = $infopageModel->getById(1);
		$this->getLayout()->setData("metadescription",$this->_view->infopage->info_pagina_descripcion);
		$this->getLayout()->setData("metakeywords",$this->_view->infopage->info_pagina_tags);
		$header = $this->_view->getRoutPHP('modules/page/Views/partials/header.php');
		$this->getLayout()->setData("header",$header);
		$footer = $this->_view->getRoutPHP('modules/page/Views/partials/footer.php');
		$this->getLayout()->setData("footer",$footer);
	}
}