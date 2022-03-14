<?php

class Categoria
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
         descripcion FROM categoria WHERE estado = 1 ORDER BY codigo';

      $query = $this->conn->prepare($sql);
      $query->execute();
      $marcas = $query->fetchAll(PDO::FETCH_ASSOC);

      $cadena = $this->conexion->arrayToJSONFormat($marcas);
      return $cadena;
   }

   public function show($codigo)
   {
      $sql = 'SELECT codigo,
         descripcion FROM categoria WHERE codigo = :codigo AND estado = 1';

      try {
         $query = $this->conn->prepare($sql);
         $query->bindValue(':codigo', $codigo);
         $query->execute();
         $marca = $query->fetch(PDO::FETCH_ASSOC);

         if ($marca != null) {
            return ['EXITO', $marca];
         } else {
            return ['ERROR', 'No existe la categoría ingresada'];
         }
      } catch (PDOException $e) {
         return ['ERROR', 'No se pudo acceder a la categoría ingresada'];
      }
   }

   public function searchCategoria($descripcionCategoria)
   {
      $sql = 'SELECT * FROM categoria WHERE descripcion LIKE :descripcion ORDER BY descripcion LIMIT 10';
      $categorias = null;
      try {
         $query = $this->conn->prepare($sql);
         $query->bindValue(':descripcion', '%' . $descripcionCategoria . '%');
         $query->execute();
         $categorias = $query->fetchAll(PDO::FETCH_ASSOC);
         return $categorias;
      } catch (PDOException $e) {
         return $categorias;
      }
   }

   public function store($datos)
   {
      $sql = 'INSERT INTO categoria(
         codigo,
         descripcion,
         estado
      ) VALUES (
         :codigo,
         :descripcion,
         :estado
      )';

      try {
         $query = $this->conn->prepare($sql);

         $query->bindValue(':codigo', 'C');
         $query->bindValue(':descripcion', isset($datos['txtDescripcion']) ? $datos['txtDescripcion'] : '');
         $query->bindValue(':estado', 1);

         $query->execute();

         $ultimoID = $this->conn->lastInsertId();

         $codigo = 'C' . $ultimoID;

         $sql = 'UPDATE categoria SET
         codigo = :codigo
         WHERE id = :id';

         $query = null;
         $query = $this->conn->prepare($sql);
         $query->bindValue(':codigo', $codigo);
         $query->bindValue(':id', $ultimoID);
         $query->execute();

         $cadena = $this->conexion->arrayToJSONFormat(array('EXITO', '¡Categoría agregada con éxito!'));
         return $cadena;
      } catch (PDOException $e) {
         $cadena = $this->conexion->arrayToJSONFormat(array('ERROR', 'No se puedo agregar la categoría'));
         return $cadena;
      }
   }

   public function update($datos)
   {
      $sql = 'UPDATE categoria SET
         descripcion = :descripcion
         WHERE codigo = :codigo';

      try {
         if (isset($datos['txtCodigo'])) {
            if ($this->show($datos['txtCodigo'])[0] == 'EXITO') {
               $datos['txtCodigo'] = $this->show($datos['txtCodigo'])[1]['codigo'];
               $query = $this->conn->prepare($sql);

               $query->bindValue(':codigo', isset($datos['txtCodigo']) ? $datos['txtCodigo'] : '');
               $query->bindValue(':descripcion', isset($datos['txtDescripcion']) ? $datos['txtDescripcion'] : '');

               $query->execute();
               $cadena = $this->conexion->arrayToJSONFormat(array('EXITO', '¡Categoría actualizada con éxito!'));
               return $cadena;
            } else {
               $cadena = $this->conexion->arrayToJSONFormat(array('ERROR', $this->show($datos['txtCodigo'])[1]));
               return $cadena;
            }
         }
      } catch (PDOException $e) {
         $cadena = $this->conexion->arrayToJSONFormat(array('ERROR', 'No se puedo editar la categoría'));
         return $cadena;
      }
   }

   public function destroy($codigo)
   {
      $sql = 'UPDATE categoria SET
         estado = 0
         WHERE codigo = :codigo';

      try {
         if ($this->show($codigo)[0] == 'EXITO') {
            $codigo = $this->show($codigo)[1]['codigo'];
            $query = $this->conn->prepare($sql);

            $query->bindValue(':codigo', $codigo);

            $query->execute();
            $cadena = $this->conexion->arrayToJSONFormat(array('EXITO', '¡Categoría eliminada con éxito!'));
            return $cadena;
         } else {
            $cadena = $this->conexion->arrayToJSONFormat(array('ERROR', $this->show($codigo)[1]));
            return $cadena;
         }
      } catch (PDOException $e) {
         $cadena = $this->conexion->arrayToJSONFormat(array('ERROR', 'No se pudo eliminar la categoría'));
         return $cadena;
      }
   }
}
