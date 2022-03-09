<?php

class UnidadMedida
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
      $sql = 'SELECT * FROM unidad_medida ORDER BY codigo';

      $query = $this->conn->prepare($sql);
      $query->execute();
      $unidadesmedida = $query->fetchAll(PDO::FETCH_ASSOC);

      return $unidadesmedida;
   }

   public function show($codigo)
   {
      $sql = 'SELECT * FROM unidad_medida WHERE codigo = :codigo';

      $query = $this->conn->prepare($sql);
      $query->bindValue(':codigo', $codigo);
      $query->execute();
      $unidadesmedida = $query->fetchAll(PDO::FETCH_ASSOC);

      return $unidadesmedida;
   }

   public function store($datos)
   {
      $sql = 'INSERT INTO unidad_medida(
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
      $sql = 'UPDATE unidad_medida SET
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
      $sql = 'DELETE FROM unidad_medida WHERE codigo = :codigo';
      $query = $this->conn->prepare($sql);

      $query->bindValue(':codigo', $codigo);

      if ($query->execute()) {
         return true;
      } else {
         return false;
      }
   }
}
