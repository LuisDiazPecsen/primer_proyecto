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

   private function viewIndex($productos, $resultado, $mensaje)
   {
      $data = array(
         'index' => 'Inicio',
         'producto/index' => 'Productos'
      );
      require_once '../app/views/producto/index.php';
   }

   public function index($resultado = null, $mensaje = null)
   {
      $this->marca = new Marca();
      $this->categoria = new Categoria();
      $this->unidadmedida = new UnidadMedida();

      $productos = array();
      $productos_original = $this->producto->index();
      for ($i = 0; $i < count($productos_original); $i++) {
         $productos += [$i => $productos_original[$i] +
            ['MARCA_descripcion' => $this->marca->show($productos_original[$i]['MARCA_codigo'])[1][0]['descripcion']] +
            ['CATEGORIA_descripcion' => $this->categoria->show($productos_original[$i]['CATEGORIA_id'])[1][0]['descripcion']] +
            ['UNIDAD_MEDIDA_descripcion' => $this->unidadmedida->show($productos_original[$i]['UNIDAD_MEDIDA_codigo'])[1][0]['descripcion']]];
      }
      $productos_original = null;

      $this->viewIndex($productos, $resultado, $mensaje);
   }

   public function store()
   {
      $resultado = null;
      $mensaje = null;
      if (isset($_POST)) {
         $_POST['txtUnidadMedida'] = substr($_POST['txtUnidadMedida'], 0, 4);
         $resultado = $this->producto->store($_POST);
         if ($resultado === true) {
            $mensaje = "¡Producto agregado con éxito!";
         } else {
            $mensaje = $resultado;
         }
      }
      $this->index($resultado, $mensaje);
   }

   public function update()
   {
      $resultado = null;
      $mensaje = null;
      if (isset($_POST)) {
         $_POST['txtUnidadMedida'] = substr($_POST['txtUnidadMedida'], 0, 4);
         //print_r($_POST);
         $resultado = $this->producto->update($_POST);
         //print_r($resultado);
         if ($resultado === true) {
            $mensaje = "¡Producto actualizado con éxito!";
         } else {
            $mensaje = $resultado;
         }
      }
      $this->index($resultado, $mensaje);
   }

   public function destroy()
   {
      $resultado = null;
      $mensaje = null;
      if (isset($_GET['codigo'])) {
         $resultado = $this->producto->destroy($_GET['codigo']);
         if ($resultado === true) {
            $mensaje = "¡Producto eliminado con éxito!";
         } else {
            $mensaje = $resultado;
         }
      }
      echo $resultado;
      $this->index($resultado, $mensaje);
   }
}
