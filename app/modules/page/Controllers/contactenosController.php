<?php 

/**
*
*/

class Page_contactenosController extends Page_mainController
{ 
    public function indexAction(){
		
	}
	
    public function enviarAction()
	{
		$this->setLayout('blanco');
		$data = [''];
		$data ['nombre'] = $this->_getSanitizedParam('nombre'); 
		$data ['email'] = $this->_getSanitizedParam('email');
        $data ['telefono'] = $this->_getSanitizedParam('telefono');
        $data ['ciudad'] = $this->_getSanitizedParam('ciudad');
		$data ['mensaje'] = $this->_getSanitizedParam('mensaje');
		$email = new Core_Model_Sendingemail($this->_view); 
		$res = $email->enviarcorreo($data);
		header("Location: /page/contactenos?res=".$res); 
	}	
}