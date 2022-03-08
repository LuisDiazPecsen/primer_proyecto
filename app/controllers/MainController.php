<?php
class MainController
{
   public function __construct()
   {
   }

   public function index()
   {
      echo "MAINCONTROLLER</br>";
      require_once '../app/views/index.php';
   }

   public function about()
   {
   }
}
