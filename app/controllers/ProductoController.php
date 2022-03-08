<?php

require_once '../../models/Producto.php';

class ProductoController
{
   private $producto;

   public function __construct()
   {
      $this->producto = new Producto();
   }

   public function index()
   {
      $productos = $this->producto->index();
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
