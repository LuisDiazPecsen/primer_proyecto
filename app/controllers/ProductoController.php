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

   public function index()
   {
      //$this->marca = new Marca();
      $this->categoria = new Categoria();
      //$this->unidadmedida = new UnidadMedida();

      $productos = array();
      foreach ($this->producto->index() as $producto) {
         $productos += [$producto + ['CATEGORIA_descripcion' => $this->categoria->show($producto['CATEGORIA_id'])[0]['descripcion']]];
      }

      $data = array(
         'index' => 'Inicio',
         'producto/index' => 'Productos'
      );
      require_once '../app/views/producto/index.php';
   }

   public function create()
   {
   }

   public function registrar($datos)
   {
   }

   public function mostrar()
   {
   }

   public function edit()
   {
   }

   public function actualizar()
   {
   }

   public function eliminar()
   {
   }
}
