<?php
class MainController
{
   public function __construct()
   {
   }

   public function index()
   {
      //echo "MAINCONTROLLER</br>";
      $data = array(
         'index' => 'Inicio'
      );
      require_once '../app/views/index.php';
   }

   public function about()
   {
      $cadena = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Et molestias minus nulla nihil rerum, officia suscipit vitae provident quae eos? Ipsum dolore voluptatum dolorum ipsa soluta ab similique magni nam.';
      $cadena = json_encode($cadena);
      echo $cadena;
   }
}
