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
      /*$sql = 'SELECT codigo,
         descripcion,
         precio_compra,
         precio_venta,
         stock,
         stock_minimo,
         unidad_medida_id,
         marca_id,
         categoria_id FROM producto WHERE estado = 1 ORDER BY codigo';*/

      $sql = 'SELECT P.codigo, 
         P.descripcion, 
         P.precio_compra, 
         P.precio_venta, 
         P.stock, 
         P.stock_minimo, 
         U.codigo as unidad_medida_codigo, 
         U.descripcion as unidad_medida_descripcion,
         M.codigo as marca_codigo,
         M.descripcion as marca_descripcion,
         C.codigo as categoria_codigo,
         C.descripcion as categoria_descripcion
         FROM PRODUCTO P
         INNER JOIN UNIDAD_MEDIDA U
         ON P.unidad_medida_id = U.id
         INNER JOIN marca M
         ON P.marca_id = M.id
         INNER JOIN CATEGORIA c ON
         P.categoria_id = C.id
         WHERE P.estado = 1
         ORDER BY P.codigo';

      $query = $this->conn->prepare($sql);
      $query->execute();
      $productos = $query->fetchAll(PDO::FETCH_ASSOC);
      $arrayFinal = array();

      /*foreach ($productos as $key => $producto) {
         $sql = 'SELECT codigo, descripcion FROM unidad_medida WHERE id = :id';
         $query = $this->conn->prepare($sql);
         $query->bindValue(':id', $producto['unidad_medida_id']);
         $query->execute();
         $columnas = $query->fetch(PDO::FETCH_ASSOC);
         $producto['unidad_medida_codigo'] = $columnas['codigo'];
         $producto['unidad_medida_descripcion'] = $columnas['descripcion'];

         $sql = 'SELECT codigo, descripcion FROM marca WHERE id = :id';
         $query = $this->conn->prepare($sql);
         $query->bindValue(':id', $producto['marca_id']);
         $query->execute();
         $columnas = $query->fetch(PDO::FETCH_ASSOC);
         $producto['marca_codigo'] = $columnas['codigo'];
         $producto['marca_descripcion'] = $columnas['descripcion'];

         $sql = 'SELECT codigo, descripcion FROM categoria WHERE id = :id';
         $query = $this->conn->prepare($sql);
         $query->bindValue(':id', $producto['categoria_id']);
         $query->execute();
         $columnas = $query->fetch(PDO::FETCH_ASSOC);
         $producto['categoria_codigo'] = $columnas['codigo'];
         $producto['categoria_descripcion'] = $columnas['descripcion'];

         $arrayFinal[] = $producto;
      }*/

      /*$sql = 'SELECT descripcion FROM marca WHERE id = :id';

      foreach ($arrayFinal as $key => $producto) {
         $query = $this->conn->prepare($sql);
         $query->bindValue(':id', $producto['marca_id']);
         $query->execute();
         $descripcion = $query->fetch(PDO::FETCH_ASSOC);
         $producto['marca_descripcion'] = $descripcion['descripcion'];
         echo $producto['marca_descripcion'];
      }

      $sql = 'SELECT descripcion FROM categoria WHERE id = :id';

      foreach ($arrayFinal as $producto) {
         $query = $this->conn->prepare($sql);
         $query->bindValue(':id', $producto['categoria_id']);
         $query->execute();
         $descripcion = $query->fetch(PDO::FETCH_ASSOC);
         $producto['categoria_descripcion'] = $descripcion['descripcion'];
         echo $producto['categoria_descripcion'];
      }*/

      //print_r($arrayFinal);
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
         unidad_medida_id,
         marca_id,
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
         return ['ERROR', 'No se pudo acceder al producto ingresado'];
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
         marca_id,
         unidad_medida_id,
         categoria_id
      ) VALUES (
         :codigo,
         :descripcion,
         :precio_compra,
         :precio_venta,
         :stock,
         :stock_minimo,
         :estado,
         :marca_id,
         :unidad_medida_id,
         :categoria_id
      )';

      try {
         $query = $this->conn->prepare($sql);

         $query->bindValue(':codigo', 'P');
         $query->bindValue(':descripcion', $datos['txtDescripcion']);
         $query->bindValue(':precio_compra', $datos['txtPrecioCompra']);
         $query->bindValue(':precio_venta', $datos['txtPrecioVenta']);
         $query->bindValue(':stock', $datos['txtStock']);
         $query->bindValue(':stock_minimo', $datos['txtStockMinimo']);
         $query->bindValue(':estado', 1);
         $query->bindValue(':marca_id', intval(substr(explode(' - ', $datos['txtMarca'])[0], 1)));
         $query->bindValue(':unidad_medida_id', intval(substr(explode(' - ', $datos['txtUnidadMedida'])[0], 1)));
         $query->bindValue(':categoria_id', intval(substr(explode(' - ', $datos['txtCategoria'])[0], 1)));

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
         $cadena = $this->conexion->arrayToJSONFormat(array('ERROR', 'No se pudo agregar el producto'));
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
         marca_id = :marca_id,
         unidad_medida_id = :unidad_medida_id,
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
               $query->bindValue(':marca_id', intval(substr(explode(' - ', $datos['txtMarca'])[0], 1)));
               $query->bindValue(':unidad_medida_id', intval(substr(explode(' - ', $datos['txtUnidadMedida'])[0], 1)));
               $query->bindValue(':categoria_id', intval(substr(explode(' - ', $datos['txtCategoria'])[0], 1)));

               $query->execute();
               $cadena = $this->conexion->arrayToJSONFormat(array('EXITO', '¡Producto actualizado con éxito!'));
               return $cadena;
            } else {
               $cadena = $this->conexion->arrayToJSONFormat(array('ERROR', $this->show($datos['txtCodigo'])[1]));
               return $cadena;
            }
         }
      } catch (PDOException $e) {
         $cadena = $this->conexion->arrayToJSONFormat(array('ERROR', 'No se pudo editar el producto'));
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
         $cadena = $this->conexion->arrayToJSONFormat(array('ERROR', 'No se pudo eliminar el producto'));
         return $cadena;
      }
   }
}
