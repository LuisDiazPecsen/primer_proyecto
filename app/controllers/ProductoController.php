<?php

require_once '../models/Producto.php';

class ProductoController
{
   private $producto;

   public function __construct()
   {
      $this->producto = new Producto();
   }

   public function index()
   {
      require_once '../views/productos/index.php';
      $productos = $this->producto->index();

      return view('../views/productos/index.php', $productos);
   }

   public function create()
   {
      require_once '../views/productos/create.php';
      return view('../views/productos/create.php');
   }

   public function registrar($datos)
   {
      $resultado = $this->producto->registrar($datos);
      return $resultado;
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
