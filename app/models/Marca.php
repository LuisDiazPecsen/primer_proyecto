<?php

class Marca
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
         descripcion FROM marca WHERE estado = 1 ORDER BY codigo';

      $query = $this->conn->prepare($sql);
      $query->execute();
      $marcas = $query->fetchAll(PDO::FETCH_ASSOC);

      $cadena = $this->conexion->arrayToJSONFormat($marcas);
      return $cadena;
   }

   public function show($codigo)
   {
      $sql = 'SELECT codigo,
         descripcion FROM marca WHERE codigo = :codigo AND estado = 1';

      try {
         $query = $this->conn->prepare($sql);
         $query->bindValue(':codigo', $codigo);
         $query->execute();
         $marca = $query->fetch(PDO::FETCH_ASSOC);

         if ($marca != null) {
            return ['EXITO', $marca];
         } else {
            return ['ERROR', 'No existe la marca ingresada'];
         }
      } catch (PDOException $e) {
         return ['ERROR', $e];
      }
   }

   public function searchMarca($descripcionMarca)
   {
      $sql = 'SELECT * FROM marca WHERE descripcion LIKE :descripcion AND estado = 1 ORDER BY descripcion LIMIT 10';
      $marcas = null;
      try {
         $query = $this->conn->prepare($sql);
         $query->bindValue(':descripcion', '%' . $descripcionMarca . '%');
         $query->execute();
         $marcas = $query->fetchAll(PDO::FETCH_ASSOC);
         return $marcas;
      } catch (PDOException $e) {
         return $marcas;
      }
   }

   public function store($datos)
   {
      $sql = 'INSERT INTO marca(
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

         $query->bindValue(':codigo', 'M');
         $query->bindValue(':descripcion', isset($datos['txtDescripcion']) ? $datos['txtDescripcion'] : '');
         $query->bindValue(':estado', 1);

         $query->execute();

         $ultimoID = $this->conn->lastInsertId();

         $codigo = 'M' . $ultimoID;

         $sql = 'UPDATE marca SET
         codigo = :codigo
         WHERE id = :id';

         $query = null;
         $query = $this->conn->prepare($sql);
         $query->bindValue(':codigo', $codigo);
         $query->bindValue(':id', $ultimoID);
         $query->execute();

         $cadena = $this->conexion->arrayToJSONFormat(array('EXITO', '¡Marca agregada con éxito!'));
         return $cadena;
      } catch (PDOException $e) {
         $cadena = $this->conexion->arrayToJSONFormat(array('ERROR', $e->getMessage()));
         return $cadena;
      }
   }

   public function update($datos)
   {
      $sql = 'UPDATE marca SET
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
               $cadena = $this->conexion->arrayToJSONFormat(array('EXITO', '¡Marca actualizada con éxito!'));
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
      $sql = 'UPDATE marca SET
         estado = 0
         WHERE codigo = :codigo';

      try {
         if ($this->show($codigo)[0] == 'EXITO') {
            $codigo = $this->show($codigo)[1]['codigo'];
            $query = $this->conn->prepare($sql);

            $query->bindValue(':codigo', $codigo);

            $query->execute();
            $cadena = $this->conexion->arrayToJSONFormat(array('EXITO', '¡Marca eliminada con éxito!'));
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
