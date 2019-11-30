<?php 

/**
* 
*/
class Page_Model_Template_templateGraficas
{

    protected $_view;

    function __construct($view)
    {
        $this->_view = $view;
    }

    public function getContentid($id){
		$graficasModel = new Page_Model_DbTable_Grafica();
		$graficas = [];
		$regraficas = $graficasModel->getList("grafica_padre = '$id' ","orden ASC");
		foreach ($regraficas as $key => $value) {
			$graficas[$key] = [];
			$graficas[$key]['detalle'] = $value;
			$padre = $value->grafica_id;
			$hijos = $graficasModel->getList("grafica_padre = '$padre' ","orden ASC");
			foreach ($hijos as $key2 => $hijo) {
				$padre = $hijo->grafica_id;
				$graficas[$key]['hijos'][$key2] = [];
				$graficas[$key]['hijos'][$key2]['detalle'] = $hijo;
				$nietos = $graficasModel->getList("grafica_padre = '$padre' ","orden ASC");
				if($nietos){
					$graficas[$key]['hijos'][$key2]['hijos'] = $nietos;
				}
			}
		}
        $this->_view->graficas = $graficas;
		return $this->_view->getRoutPHP("modules/page/Views/template/contenedorGraficas.php");
	}
}