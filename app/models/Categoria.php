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
      $sql = 'SELECT * FROM categoria ORDER BY id';

      $query = $this->conn->prepare($sql);
      $query->execute();
      $categorias = $query->fetchAll(PDO::FETCH_ASSOC);

      return $categorias;
   }

   public function show($id)
   {
      $sql = 'SELECT * FROM categoria WHERE id = :id';

      $query = $this->conn->prepare($sql);
      $query->bindValue(':id', $id);
      $query->execute();
      $categorias = $query->fetchAll(PDO::FETCH_ASSOC);

      return $categorias;
   }

   public function store($datos)
   {
      $sql = 'INSERT INTO categoria(
         id,
         descripcion
      ) VALUES (
         :id,
         :descripcion
      )';

      $query = $this->conn->prepare($sql);

      $query->bindValue(':id', $datos['id']);
      $query->bindValue(':descripcion', $datos['descripcion']);

      if ($query->execute()) {
         return true;
      } else {
         return false;
      }
   }

   public function update($datos)
   {
      $sql = 'UPDATE categoria SET
         descripcion = :descripcion
         WHERE id = :id';

      $query = $this->conn->prepare($sql);

      $query->bindValue(':id', $datos['id']);
      $query->bindValue(':descripcion', $datos['descripcion']);

      if ($query->execute()) {
         return true;
      } else {
         return false;
      }
   }

   public function delete($id)
   {
      $sql = 'DELETE FROM categoria WHERE id = :id';
      $query = $this->conn->prepare($sql);

      $query->bindValue(':id', $id);

      if ($query->execute()) {
         return true;
      } else {
         return false;
      }
   }
}
