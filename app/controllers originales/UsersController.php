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
      $resultado = null;
      $mensaje = null;
      //print_r($_SESSION['username']);

      if (isset($_SESSION['username'])) {
         $passwordAntigua = $_POST['txtPasswordAntigua'];
         $passwordNueva = $_POST['txtPasswordNueva'];
         $resultado = $this->user->update($_SESSION['username'], $passwordAntigua, $passwordNueva);
         if ($resultado != null) {
            $mensaje = 'Se actualizó correctamente la contraseña';
         } else {
            $resultado = 'Se ha producido un error';
            $mensaje = '';
         }

         require_once '../app/views/users/user.php';
      } else {
         header("Location: /primer_proyecto/users/login.php");
      }
   }

   public function logout()
   {
      session_start();
      session_destroy();

      header('Location: /primer_proyecto/users/login');
   }

   public function user()
   {
      require_once '../app/views/users/user.php';
   }

   public function index()
   {
      require_once '../app/views/users/user.php';
   }
}
