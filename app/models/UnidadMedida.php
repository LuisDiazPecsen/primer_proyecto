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

      try {
         $query = $this->conn->prepare($sql);
         $query->bindValue(':codigo', $codigo);
         $query->execute();
         $unidadmedida = $query->fetchAll(PDO::FETCH_ASSOC);
         //print_r(count($unidadmedida));

         if (count($unidadmedida) > 0) {
            return ['EXITO', $unidadmedida];
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
         $query->bindValue(':descripcion', '%' . $_POST['descripcionUnidadMedida'] . '%');
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
      $sql = 'UPDATE unidad_medida SET
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
      $sql = 'DELETE FROM unidad_medida WHERE codigo = :codigo';

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
