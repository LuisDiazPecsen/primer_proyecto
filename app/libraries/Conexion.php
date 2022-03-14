<?php

class Conexion
{
   private $host = 'localhost:3306'; // dirección del servidor (127.0.0.1)
   private $username = 'root';
   private $password = '';
   private $dbname = 'primer_proyecto';
   private $conexion;

   public function __construct()
   {
      try {
         // PDO: clase que permite conectar a la BD
         $this->conexion = new PDO(
            "mysql:host=$this->host;dbname=$this->dbname",
            $this->username,
            $this->password
         );

         /*Activar características propias de la conexión, pasamos argumentos de error para que se activen los errores y puedan decir qué errores se están generando.*/
         // PDO::ATTR_ERRMODE para obtener informe de algún error al intentar conectar
         // PDO::ERRMODE_EXCEPTION para emitir excepciones al conectar a la Base de Datos
         $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         //echo "Conexión establecida";
      } catch (PDOException $error) {
         echo "Conexión errónea<br/>" . $error->getMessage();
      }
   }

   public function getConexion()
   {
      return $this->conexion;
   }

   public function arrayToJSONFormat($array)
   {
      if (isset($array) && count($array) != 0) {
         return json_encode($array);
      } else {
         return json_encode(array());
      }
   }
}
