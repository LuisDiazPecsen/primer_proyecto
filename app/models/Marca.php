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
      $sql = 'SELECT * FROM marca ORDER BY codigo';

      $query = $this->conn->prepare($sql);
      $query->execute();
      $marcas = $query->fetchAll(PDO::FETCH_ASSOC);

      return $marcas;
   }

   public function show($codigo)
   {
      $sql = 'SELECT * FROM marca WHERE codigo = :codigo';

      try {
         $query = $this->conn->prepare($sql);
         $query->bindValue(':codigo', $codigo);
         $query->execute();
         $marca = $query->fetchAll(PDO::FETCH_ASSOC);
         //print_r(count($marca));

         if (count($marca) > 0) {
            return ['EXITO', $marca];
         } else {
            return ['ERROR', 'No existe la marca ingresada'];
         }
      } catch (PDOException $e) {
         return ['ERROR', $e];
      }
   }

   public function store($datos)
   {
      $sql = 'INSERT INTO marca(
         codigo,
         descripcion
      ) VALUES (
         :codigo,
         :descripcion
      )';

      try {
         $query = $this->conn->prepare($sql);

         $query->bindValue(':codigo', isset($datos['txtCodigo']) ? $datos['txtCodigo'] : '');
         $query->bindValue(':descripcion', isset($datos['txtDescripcion']) ? $datos['txtDescripcion'] : '');

         $query->execute();
         return true;
      } catch (PDOException $e) {
         return $e->getMessage();
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
               $datos['txtCodigo'] = $this->show($datos['txtCodigo'])[1][0]['codigo'];
               $query = $this->conn->prepare($sql);

               $query->bindValue(':codigo', isset($datos['txtCodigo']) ? $datos['txtCodigo'] : '');
               $query->bindValue(':descripcion', isset($datos['txtDescripcion']) ? $datos['txtDescripcion'] : '');

               $query->execute();
               return true;
            } else {
               return $this->show($datos['txtCodigo'])[1];
            }
         }
      } catch (PDOException $e) {
         return $e->getMessage();
      }
   }

   public function destroy($codigo)
   {
      $sql = 'DELETE FROM marca WHERE codigo = :codigo';

      try {
         if ($this->show($codigo)[0] == 'EXITO') {
            $codigo = $this->show($codigo)[1][0]['codigo'];
            $query = $this->conn->prepare($sql);

            $query->bindValue(':codigo', $codigo);

            $query->execute();
            return true;
         } else {
            return $this->show($codigo)[1];
         }
      } catch (PDOException $e) {
         return $e->getMessage();
      }
   }
}
