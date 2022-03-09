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

      $query = $this->conn->prepare($sql);
      $query->bindValue(':codigo', $codigo);
      $query->execute();
      $marcas = $query->fetchAll(PDO::FETCH_ASSOC);

      return $marcas;
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

      $query = $this->conn->prepare($sql);

      $query->bindValue(':codigo', $datos['codigo']);
      $query->bindValue(':descripcion', $datos['descripcion']);

      if ($query->execute()) {
         return true;
      } else {
         return false;
      }
   }

   public function update($datos)
   {
      $sql = 'UPDATE marca SET
         descripcion = :descripcion
         WHERE codigo = :codigo';

      $query = $this->conn->prepare($sql);

      $query->bindValue(':codigo', $datos['codigo']);
      $query->bindValue(':descripcion', $datos['descripcion']);

      if ($query->execute()) {
         return true;
      } else {
         return false;
      }
   }

   public function delete($codigo)
   {
      $sql = 'DELETE FROM marca WHERE codigo = :codigo';
      $query = $this->conn->prepare($sql);

      $query->bindValue(':codigo', $codigo);

      if ($query->execute()) {
         return true;
      } else {
         return false;
      }
   }
}
