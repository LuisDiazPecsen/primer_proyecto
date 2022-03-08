<?php

class ProductoModel
{
   private $codigo;
   private $descripcion;
   private $precio_compra;
   private $precio_venta;
   private $stock;
   private $stock_minimo;
   private $marca_codigo;
   private $unidad_medida_codigo;
   private $categoria_id;

   public function __construct($codigo, $descripcion, $precio_compra, $precio_venta, $stock, $stock_minimo, $marca_codigo, $unidad_medida_codigo, $categoria_id)
   {
      $this->codigo = $codigo;
      $this->descripcion = $descripcion;
      $this->precio_compra = $precio_compra;
      $this->precio_venta = $precio_venta;
      $this->stock = $stock;
      $this->stock_minimo = $stock_minimo;
      $this->marca_codigo = $marca_codigo;
      $this->unidad_medida_codigo = $unidad_medida_codigo;
      $this->categoria_id = $categoria_id;
   }

   public function listar()
   {
   }

   public function agregar()
   {
   }

   public function editar()
   {
   }

   public function eliminar()
   {
   }
}
