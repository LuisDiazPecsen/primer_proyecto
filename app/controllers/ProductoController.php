<?php

// app/controllers/ProductoController.php
// app/models/Producto.php
require_once '../app/models/Producto.php';
require_once '../app/models/Marca.php';
require_once '../app/models/Categoria.php';
require_once '../app/models/UnidadMedida.php';

class ProductoController
{
   private $producto;
   private $marca;
   private $categoria;
   private $unidadmedida;

   public function __construct()
   {
      $this->producto = new Producto();
   }

   private function viewIndex($productos)
   {
      $data = array(
         'index' => 'Inicio',
         'producto/index' => 'Productos'
      );
      require_once '../app/views/producto/index.php';
   }

   public function index()
   {
      $this->marca = new Marca();
      $this->categoria = new Categoria();
      $this->unidadmedida = new UnidadMedida();

      $productos = array();
      $productos_original = $this->producto->index();
      for ($i = 0; $i < count($productos_original); $i++) {
         $productos += [$i => $productos_original[$i] +
            ['MARCA_descripcion' => $this->marca->show($productos_original[$i]['MARCA_codigo'])[0]['descripcion']] +
            ['CATEGORIA_descripcion' => $this->categoria->show($productos_original[$i]['CATEGORIA_id'])[0]['descripcion']] +
            ['UNIDAD_MEDIDA_descripcion' => $this->unidadmedida->show($productos_original[$i]['UNIDAD_MEDIDA_codigo'])[0]['descripcion']]];
      }
      $productos_original = null;

      $this->viewIndex($productos);
   }

   public function store()
   {
      $resultado = null;
      if (isset($_POST)) {
         $resultado = $this->producto->store($_POST);
      }
      echo $resultado;
      $this->index();
   }

   public function update()
   {
      $resultado = null;
      if (isset($_POST)) {
         //print_r($_POST);
         $resultado = $this->producto->update($_POST);
      }
      echo $resultado;
      $this->index();
   }

   public function destroy()
   {
      $resultado = null;
      if (isset($_GET)) {
         $resultado = $this->producto->destroy($_GET['codigo']);
      }
      echo $resultado;
      $this->index();
   }
}
