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

      try {
         $query = $this->conn->prepare($sql);
         $query->bindValue(':id', $id);
         $query->execute();
         $categoria = $query->fetchAll(PDO::FETCH_ASSOC);
         //print_r(count($categoria));

         if (count($categoria) > 0) {
            return ['EXITO', $categoria];
         } else {
            return ['ERROR', 'No existe la categoría ingresada'];
         }
      } catch (PDOException $e) {
         return ['ERROR', $e];
      }
   }

   public function store($datos)
   {
      $sql = 'INSERT INTO categoria(
         descripcion
      ) VALUES (
         :descripcion
      )';

      try {
         $query = $this->conn->prepare($sql);

         $query->bindValue(':descripcion', isset($datos['txtDescripcion']) ? $datos['txtDescripcion'] : '');

         $query->execute();
         return true;
      } catch (PDOException $e) {
         return $e->getMessage();
      }
   }

   public function update($datos)
   {
      $sql = 'UPDATE categoria SET
         descripcion = :descripcion
         WHERE id = :id';

      try {
         if (isset($datos['txtId'])) {
            if ($this->show($datos['txtId'])[0] == 'EXITO') {
               $datos['txtId'] = $this->show($datos['txtId'])[1][0]['id'];
               $query = $this->conn->prepare($sql);

               $query->bindValue(':id', isset($datos['txtId']) ? $datos['txtId'] : '');
               $query->bindValue(':descripcion', isset($datos['txtDescripcion']) ? $datos['txtDescripcion'] : '');

               $query->execute();
               return true;
            } else {
               return $this->show($datos['txtId'])[1];
            }
         }
      } catch (PDOException $e) {
         return $e->getMessage();
      }
   }

   public function destroy($id)
   {
      $sql = 'DELETE FROM categoria WHERE id = :id';

      try {
         if ($this->show($id)[0] == 'EXITO') {
            $id = $this->show($id)[1][0]['id'];
            $query = $this->conn->prepare($sql);

            $query->bindValue(':id', $id);

            $query->execute();
            return true;
         } else {
            return $this->show($id)[1];
         }
      } catch (PDOException $e) {
         return $e->getMessage();
      }
   }
}
