<?php

require_once '../app/models/Users.php';

class UsersController
{
   private $user;

   public function __construct()
   {
      $this->user = new Users();
   }

   public function login()
   {
      session_start();
      $resultado = null;
      $mensaje = null;
      //print_r($_POST);

      if (isset($_SESSION['username'])) {
         header("Location: /primer_proyecto/index.php");
      }

      if (isset($_POST['Login'])) {
         $resultado = $this->user->login($_POST['txtUsername'], $_POST['txtPassword']);
         if ($resultado != null) {
            $_SESSION['username'] = $resultado['username'];
            header('Location: /primer_proyecto/index');
         } else {
            echo '<script>alert("Usuario y/o contraseña incorrectos")</script>';
         }
      }

      require_once '../app/views/users/login.php';
   }

   public function register()
   {
      session_start();
      $resultado = null;
      $mensaje = null;
      //print_r($_POST);

      if (isset($_SESSION['username'])) {
         header("Location: /primer_proyecto/index.php");
      }

      if (isset($_POST['Register'])) {
         $resultado = $this->user->register($_POST['txtUsername'], $_POST['txtPassword']);
         if ($resultado != null) {
            header('Location: /primer_proyecto/users/login');
         } else {
            echo '<script>alert("Se ha producido un error")</script>';
         }
      }

      require_once '../app/views/users/register.php';
   }

   public function update()
   {
      session_start();

      if (isset($_SESSION['username'])) {
         $passwordAntigua = $_POST['txtPasswordAntigua'];
         $passwordNueva = $_POST['txtPasswordNueva'];
         $cadena = $this->user->update($_SESSION['username'], $passwordAntigua, $passwordNueva);
         echo $cadena;
      } else {
         header("Location: /primer_proyecto/users/login.php");
      }
   }

   public function logout()
   {
      session_start();
      session_unset();
      session_destroy();

      header('Location: /primer_proyecto/users/login');
   }

   public function user()
   {
      session_start();
      if (isset($_SESSION)) {
         $cadena = $this->user->user($_SESSION['username']);
         echo $cadena;
      }
   }

   public function index()
   {
      require_once '../app/views/users/user.php';
   }
}
