<?php

class Conexion
{
   private $server = "localhost:3306"; // dirección del servidor (127.0.0.1)
   private $username = "root";
   private $password = "";
   private $conexion;

   public function __construct()
   {
      try {
         // PDO: clase que permite conectar a la BD
         $this->conexion = new PDO(
            "mysql:host=$this->server;dbname=album",
            $this->username,
            $this->password
         );

         //Activar características propias de la conexión, pasamos argumentos de error para que se activen los errores y puedan decir qué errores se están generando.
         // ATTR_ERRMODE, ERRMODE_EXCEPTION: Constantes. Datos que necesita attribute para mostrar errores
         $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         //echo "Conexión establecida";
      } catch (PDOException $error) {
         //echo "Conexión errónea<br/>" . $error;
      }
   }

   public function getConexion()
   {
      return $this->conexion;
   }
}
