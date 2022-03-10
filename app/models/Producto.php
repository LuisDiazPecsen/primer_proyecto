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

      try {
         $query = $this->conn->prepare($sql);

         $query->bindValue(':codigo', isset($datos['txtCodigo']) ? $datos['txtCodigo'] : '');
         $query->bindValue(':descripcion', isset($datos['txtDescripcion']) ? $datos['txtDescripcion'] : '');
         $query->bindValue(':precio_compra', isset($datos['txtPrecioCompra']) ? $datos['txtPrecioCompra'] : '');
         $query->bindValue(':precio_venta', isset($datos['txtPrecioVenta']) ? $datos['txtPrecioVenta'] : '');
         $query->bindValue(':stock', isset($datos['txtStock']) ? $datos['txtStock'] : '');
         $query->bindValue(':stock_minimo', isset($datos['txtStockMinimo']) ? $datos['txtStockMinimo'] : '');
         $query->bindValue(':marca_codigo', isset($datos['txtMarca']) ? $datos['txtMarca'] : '');
         $query->bindValue(':unidad_medida_codigo', isset($datos['txtUnidadMedida']) ? $datos['txtUnidadMedida'] : '');
         $query->bindValue(':categoria_id', isset($datos['txtCategoria']) ? $datos['txtCategoria'] : '');

         $query->execute();
         return true;
      } catch (PDOException $e) {
         return $e->getMessage();
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

      try {
         $query = $this->conn->prepare($sql);

         $query->bindValue(':codigo', isset($datos['txtCodigo']) ? $datos['txtCodigo'] : '');
         $query->bindValue(':descripcion', isset($datos['txtDescripcion']) ? $datos['txtDescripcion'] : '');
         $query->bindValue(':precio_compra', isset($datos['txtPrecioCompra']) ? $datos['txtPrecioCompra'] : '');
         $query->bindValue(':precio_venta', isset($datos['txtPrecioVenta']) ? $datos['txtPrecioVenta'] : '');
         $query->bindValue(':stock', isset($datos['txtStock']) ? $datos['txtStock'] : '');
         $query->bindValue(':stock_minimo', isset($datos['txtStockMinimo']) ? $datos['txtStockMinimo'] : '');
         $query->bindValue(':marca_codigo', isset($datos['txtMarca']) ? $datos['txtMarca'] : '');
         $query->bindValue(':unidad_medida_codigo', isset($datos['txtUnidadMedida']) ? $datos['txtUnidadMedida'] : '');
         $query->bindValue(':categoria_id', isset($datos['txtCategoria']) ? $datos['txtCategoria'] : '');

         $query->execute();
         return true;
      } catch (PDOException $e) {
         return $e->getMessage();
      }
   }

   public function destroy($codigo)
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
