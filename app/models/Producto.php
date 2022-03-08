<?php

class Producto
{
   private $conexion;
   private $conn;

   public function __construct()
   {
      $this->conexion = new Conexion();
      $this->conn = $this->conexion->getConexion();
   }

   public function index()
   {
      $sql = 'SELECT * FROM producto ORDER BY codigo';

      $query = $this->conn->prepare($sql);
      $query->execute();
      $productos = $query->fetchAll(PDO::FETCH_OBJ);

      return $productos;
   }

   public function store($datos)
   {
      $sql = 'INSERT INTO producto(
         codigo,
         descripcion,
         precio_compra,
         precio_venta,
         stock,
         stock_minimo,
         marca_codigo,
         unidad_medida_codigo,
         categoria_id
      ) VALUES (
         :codigo,
         :descripcion,
         :precio_compra,
         :precio_venta,
         :stock,
         :stock_minimo,
         :marca_codigo,
         :unidad_medida_codigo,
         :categoria_id
      )';

      $query = $this->conn->prepare($sql);

      $query->bind(':codigo', $datos['codigo']);
      $query->bind(':descripcion', $datos['descripcion']);
      $query->bind(':precio_compra', $datos['precio_compra']);
      $query->bind(':precio_venta', $datos['precio_venta']);
      $query->bind(':stock', $datos['stock']);
      $query->bind(':stock_minimo', $datos['stock_minimo']);
      $query->bind(':marca_codigo', $datos['marca_codigo']);
      $query->bind(':unidad_medida_codigo', $datos['unidad_medida_codigo']);
      $query->bind(':categoria_id', $datos['categoria_id']);

      if ($query->execute()) {
         return true;
      } else {
         return false;
      }
   }

   public function update($datos)
   {
      $sql = 'UPDATE producto SET
         descripcion = :descripcion,
         precio_compra = :precio_compra,
         precio_venta = :precio_venta,
         stock = :stock,
         stock_minimo = :stock_minimo,
         marca_codigo = :marca_codigo,
         unidad_medida_codigo = :unidad_medida_codigo,
         categoria_id = :categoria_id
         WHERE codigo = :codigo';

      $query = $this->conn->prepare($sql);

      $query->bind(':codigo', $datos['codigo']);
      $query->bind(':descripcion', $datos['descripcion']);
      $query->bind(':precio_compra', $datos['precio_compra']);
      $query->bind(':precio_venta', $datos['precio_venta']);
      $query->bind(':stock', $datos['stock']);
      $query->bind(':stock_minimo', $datos['stock_minimo']);
      $query->bind(':marca_codigo', $datos['marca_codigo']);
      $query->bind(':unidad_medida_codigo', $datos['unidad_medida_codigo']);
      $query->bind(':categoria_id', $datos['categoria_id']);

      if ($query->execute()) {
         return true;
      } else {
         return false;
      }
   }

   public function delete($codigo)
   {
      $sql = 'DELETE FROM producto WHERE codigo = :codigo';
      $query = $this->conn->prepare($sql);

      $query->bind(':codigo', $codigo);

      if ($query->execute()) {
         return true;
      } else {
         return false;
      }
   }
}
