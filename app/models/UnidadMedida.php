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
      $sql = 'SELECT codigo,
         descripcion FROM unidad_medida WHERE estado = 1 ORDER BY codigo';

      $query = $this->conn->prepare($sql);
      $query->execute();
      $unidadesMedida = $query->fetchAll(PDO::FETCH_ASSOC);

      $cadena = $this->conexion->arrayToJSONFormat($unidadesMedida);
      return $cadena;
   }

   public function show($codigo)
   {
      $sql = 'SELECT codigo,
         descripcion FROM unidad_medida WHERE codigo = :codigo AND estado = 1';

      try {
         $query = $this->conn->prepare($sql);
         $query->bindValue(':codigo', $codigo);
         $query->execute();
         $unidadMedida = $query->fetch(PDO::FETCH_ASSOC);

         if ($unidadMedida != null) {
            return ['EXITO', $unidadMedida];
         } else {
            return ['ERROR', 'No existe la unidad de medida ingresada'];
         }
      } catch (PDOException $e) {
         return ['ERROR', $e];
      }
   }

   public function searchUnidadMedida($descripcionUnidadMedida)
   {
      $sql = 'SELECT * FROM unidad_medida WHERE descripcion LIKE :descripcion ORDER BY descripcion LIMIT 10';
      $unidadesMedida = null;
      try {
         $query = $this->conn->prepare($sql);
         $query->bindValue(':descripcion', '%' . $descripcionUnidadMedida . '%');
         $query->execute();
         $unidadesMedida = $query->fetchAll(PDO::FETCH_ASSOC);
         return $unidadesMedida;
      } catch (PDOException $e) {
         return $unidadesMedida;
      }
   }

   public function store($datos)
   {
      $sql = 'INSERT INTO unidad_medida(
         id,
         codigo,
         descripcion,
         estado
      ) VALUES (
         :id,
         :codigo,
         :descripcion,
         :estado
      )';

      try {
         $query = $this->conn->prepare($sql);

         $query->bindValue(':id', ($this->conn->lastInsertId() == 0) ? 1 : null);
         $query->bindValue(':codigo', 'U');
         $query->bindValue(':descripcion', isset($datos['txtDescripcion']) ? $datos['txtDescripcion'] : '');
         $query->bindValue(':estado', 1);

         $query->execute();

         $this->conn = null;
         $this->conn = $this->conexion->getConexion();
         $ultimoID = $this->conn->lastInsertId();

         $codigo = 'U' . $ultimoID;

         $sql = 'UPDATE unidad_medida SET
         codigo = :codigo
         WHERE id = :id';

         $query = null;
         $query = $this->conn->prepare($sql);
         $query->bindValue(':codigo', $codigo);
         $query->bindValue(':id', $ultimoID);
         $query->execute();

         $cadena = $this->conexion->arrayToJSONFormat(array('EXITO', '¡Unidad de medida agregada con éxito!'));
         return $cadena;
      } catch (PDOException $e) {
         $cadena = $this->conexion->arrayToJSONFormat(array('ERROR', $e->getMessage()));
         return $cadena;
      }
   }

   public function update($datos)
   {
      $sql = 'UPDATE unidad_medida SET
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
               $cadena = $this->conexion->arrayToJSONFormat(array('EXITO', '¡Unidad de medida actualizada con éxito!'));
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
      $sql = 'UPDATE unidad_medida SET
         estado = 0
         WHERE codigo = :codigo';

      try {
         if ($this->show($codigo)[0] == 'EXITO') {
            $codigo = $this->show($codigo)[1]['codigo'];
            $query = $this->conn->prepare($sql);

            $query->bindValue(':codigo', $codigo);

            $query->execute();
            $cadena = $this->conexion->arrayToJSONFormat(array('EXITO', '¡Unidad de medida eliminada con éxito!'));
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
