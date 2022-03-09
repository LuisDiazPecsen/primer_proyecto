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
      $productos = $query->fetchAll(PDO::FETCH_ASSOC);

      return $productos;
   }

   public function show($codigo)
   {
      $sql = 'SELECT * FROM producto WHERE codigo = :codigo';

      $query = $this->conn->prepare($sql);
      $query->bindValue(':codigo', $codigo);
      $query->execute();
      $producto = $query->fetchAll(PDO::FETCH_ASSOC);

      return $producto;
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

      $query->bindValue(':codigo', $datos['codigo']);
      $query->bindValue(':descripcion', $datos['descripcion']);
      $query->bindValue(':precio_compra', $datos['precio_compra']);
      $query->bindValue(':precio_venta', $datos['precio_venta']);
      $query->bindValue(':stock', $datos['stock']);
      $query->bindValue(':stock_minimo', $datos['stock_minimo']);
      $query->bindValue(':marca_codigo', $datos['marca_codigo']);
      $query->bindValue(':unidad_medida_codigo', $datos['unidad_medida_codigo']);
      $query->bindValue(':categoria_id', $datos['categoria_id']);

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

      $query->bindValue(':codigo', $datos['codigo']);
      $query->bindValue(':descripcion', $datos['descripcion']);
      $query->bindValue(':precio_compra', $datos['precio_compra']);
      $query->bindValue(':precio_venta', $datos['precio_venta']);
      $query->bindValue(':stock', $datos['stock']);
      $query->bindValue(':stock_minimo', $datos['stock_minimo']);
      $query->bindValue(':marca_codigo', $datos['marca_codigo']);
      $query->bindValue(':unidad_medida_codigo', $datos['unidad_medida_codigo']);
      $query->bindValue(':categoria_id', $datos['categoria_id']);

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

      $query->bindValue(':codigo', $codigo);

      if ($query->execute()) {
         return true;
      } else {
         return false;
      }
   }
}
