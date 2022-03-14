<?php

// app/controllers/ProductoController.php
// app/models/Producto.php
require_once '../app/models/Producto.php';

class ProductoController
{
   private $producto;

   public function __construct()
   {
      $this->producto = new Producto();
   }

   public function index()
   {
      $cadena = $this->producto->index();
      echo $cadena;
   }

   public function store()
   {
      $cadena = $this->producto->store($_POST);
      echo $cadena;
   }

   public function update()
   {
      $cadena = $this->producto->update($_POST);
      echo $cadena;
   }

   public function destroy()
   {
      $params = json_decode(file_get_contents('php://input'), true);
      $cadena = $this->producto->destroy($params['codigo']);
      echo $cadena;
   }
}
