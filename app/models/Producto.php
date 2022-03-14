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
      $sql = 'SELECT codigo,
         descripcion,
         precio_compra,
         precio_venta,
         stock,
         stock_minimo,
         unidad_medida_codigo,
         marca_codigo,
         categoria_id FROM producto WHERE estado = 1 ORDER BY codigo';

      $query = $this->conn->prepare($sql);
      $query->execute();
      $productos = $query->fetchAll(PDO::FETCH_ASSOC);

      $cadena = $this->conexion->arrayToJSONFormat($productos);
      return $cadena;
   }

   public function show($codigo)
   {
      $sql = 'SELECT codigo,
         descripcion,
         precio_compra,
         precio_venta,
         stock,
         stock_minimo,
         unidad_medida_codigo,
         marca_codigo,
         categoria_id FROM producto WHERE codigo = :codigo AND estado = 1';

      try {
         $query = $this->conn->prepare($sql);
         $query->bindValue(':codigo', $codigo);
         $query->execute();
         $producto = $query->fetch(PDO::FETCH_ASSOC);

         if ($producto != null) {
            return ['EXITO', $producto];
         } else {
            return ['ERROR', 'No existe el producto ingresado'];
         }
      } catch (PDOException $e) {
         return ['ERROR', $e];
      }
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
         estado,
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
         :estado,
         :marca_codigo,
         :unidad_medida_codigo,
         :categoria_id
      )';

      try {
         $query = $this->conn->prepare($sql);

         $query->bindValue(':codigo', 'P');
         $query->bindValue(':descripcion', isset($datos['txtDescripcion']) ? $datos['txtDescripcion'] : '');
         $query->bindValue(':precio_compra', isset($datos['txtPrecioCompra']) ? $datos['txtPrecioCompra'] : '');
         $query->bindValue(':precio_venta', isset($datos['txtPrecioVenta']) ? $datos['txtPrecioVenta'] : '');
         $query->bindValue(':stock', isset($datos['txtStock']) ? $datos['txtStock'] : '');
         $query->bindValue(':stock_minimo', isset($datos['txtStockMinimo']) ? $datos['txtStockMinimo'] : '');
         $query->bindValue(':estado', 1);
         $query->bindValue(':marca_codigo', isset($datos['txtMarca']) ? $datos['txtMarca'] : '');
         $query->bindValue(':unidad_medida_codigo', isset($datos['txtUnidadMedida']) ? $datos['txtUnidadMedida'] : '');
         $query->bindValue(':categoria_id', isset($datos['txtCategoria']) ? $datos['txtCategoria'] : '');

         $query->execute();

         $ultimoID = $this->conn->lastInsertId();

         $codigo = 'P' . $ultimoID;

         $sql = 'UPDATE producto SET
         codigo = :codigo
         WHERE id = :id';

         $query = null;
         $query = $this->conn->prepare($sql);
         $query->bindValue(':codigo', $codigo);
         $query->bindValue(':id', $ultimoID);
         $query->execute();

         $cadena = $this->conexion->arrayToJSONFormat(array('EXITO', '¡Producto agregado con éxito!'));
         return $cadena;
      } catch (PDOException $e) {
         $cadena = $this->conexion->arrayToJSONFormat(array('ERROR', $e->getMessage()));
         return $cadena;
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
         if (isset($datos['txtCodigo'])) {
            if ($this->show($datos['txtCodigo'])[0] == 'EXITO') {
               $datos['txtCodigo'] = $this->show($datos['txtCodigo'])[1]['codigo'];
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
               $cadena = $this->conexion->arrayToJSONFormat(array('EXITO', '¡Producto actualizado con éxito!'));
               return $cadena;
            } else {
               $cadena = $this->conexion->arrayToJSONFormat(array('ERROR', $this->show($datos['txtCodigo'])[1]));
               return $cadena;
            }
         }
      } catch (PDOException $e) {
         $cadena = $this->conexion->arrayToJSONFormat(array('ERROR', $e->getMessage()));
         return $cadena;
      }
   }

   public function destroy($codigo)
   {
      $sql = 'UPDATE producto SET
         estado = 0
         WHERE codigo = :codigo';

      try {
         if ($this->show($codigo)[0] == 'EXITO') {
            $codigo = $this->show($codigo)[1]['codigo'];
            $query = $this->conn->prepare($sql);

            $query->bindValue(':codigo', $codigo);

            $query->execute();
            $cadena = $this->conexion->arrayToJSONFormat(array('EXITO', '¡Producto eliminado con éxito!'));
            return $cadena;
         } else {
            $cadena = $this->conexion->arrayToJSONFormat(array('ERROR', $this->show($codigo)[1]));
            return $cadena;
         }
      } catch (PDOException $e) {
         $cadena = $this->conexion->arrayToJSONFormat(array('ERROR', $e->getMessage()));
         return $cadena;
      }
   }
}
