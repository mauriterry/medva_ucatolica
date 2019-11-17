<?php 

/**
*
*/

class Page_productosController extends Page_mainController
{

	public function indexAction()
	{
        $categoriaModel = new Page_Model_DbTable_Categoria();
        $productosModel = new Page_Model_DbTable_Productos();
        $datacategorias = [];
        $categorias = $categoriaModel->getList("categoria_padre = '0'","orden ASC");
        foreach ($categorias as $key => $categoria) {
            $datacategorias[$key] = [];
            $datacategorias[$key]['detalle'] = $categoria;
            $datacategorias[$key]['subcategorias'] = $categoriaModel->getList("categoria_padre = '".$categoria->categoria_id."'","orden ASC");
        }
        $this->_view->categorias = $datacategorias;

        $this->_view->productos = $productosModel->getList();
    }
	


}