<?php

class Users
{
   private $conexion;
   private $conn;

   public function __construct()
   {
      $this->conexion = new Conexion();
      $this->conn = $this->conexion->getConexion();
   }

   public function login($username, $password)
   {
      $sql = 'SELECT * FROM users WHERE username = :username AND password = md5(:password)';

      try {
         $query = $this->conn->prepare($sql);
         $query->bindValue(':username', $username);
         $query->bindValue(':password', $password);
         $query->execute();
         $users = $query->fetchAll(PDO::FETCH_ASSOC);

         if (count($users) == 1) {
            return [
               'username' => $users[0]['username'],
               'password' => $users[0]['password']
            ];
         } else {
            return null;
         }
      } catch (PDOException $e) {
         return null;
      }
   }

   public function register($username, $password)
   {
      $sql = 'INSERT INTO users(username, password) VALUES(:username, md5(:password))';

      try {
         $query = $this->conn->prepare($sql);
         $query->bindValue(':username', $username);
         $query->bindValue(':password', $password);
         $query->execute();
         return true;
      } catch (PDOException $e) {
         return null;
      }
   }

   public function update($username, $passwordAntigua, $passwordNueva)
   {
      if ($this->login($username, $passwordAntigua) == null) {
         return null;
      }

      $sql = 'UPDATE users SET
      password = md5(:passwordNueva)
      WHERE username = :username
      AND password = md5(:passwordAntigua)';

      try {
         $query = $this->conn->prepare($sql);
         $query->bindValue(':username', $username);
         $query->bindValue(':passwordAntigua', $passwordAntigua);
         $query->bindValue(':passwordNueva', $passwordNueva);
         $query->execute();
         return true;
      } catch (PDOException $e) {
         return null;
      }
   }
}
