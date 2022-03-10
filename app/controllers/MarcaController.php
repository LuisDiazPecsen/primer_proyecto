<?php

require_once '../app/models/Marca.php';

class MarcaController
{
   private $marca;

   public function __construct()
   {
      $this->marca = new Marca();
   }

   private function viewIndex($marcas, $resultado, $mensaje)
   {
      $data = array(
         'index' => 'Inicio',
         'marca/index' => 'Marcas'
      );
      require_once '../app/views/marca/index.php';
   }

   public function index($resultado = null, $mensaje = null)
   {
      $marcas = $this->marca->index();

      $this->viewIndex($marcas, $resultado, $mensaje);
   }

   public function store()
   {
      $resultado = null;
      $mensaje = null;
      if (isset($_POST)) {
         $resultado = $this->marca->store($_POST);
         if ($resultado === true) {
            $mensaje = "¡Marca agregada con éxito!";
         } else {
            $mensaje = $resultado;
         }
      }
      $this->index($resultado, $mensaje);
   }

   public function update()
   {
      $resultado = null;
      $mensaje = null;
      if (isset($_POST)) {
         $resultado = $this->marca->update($_POST);
         print_r($resultado);
         if ($resultado === true) {
            $mensaje = "¡Marca actualizada con éxito!";
         } else {
            $mensaje = $resultado;
         }
      }
      $this->index($resultado, $mensaje);
   }

   public function destroy()
   {
      $resultado = null;
      $mensaje = null;
      if (isset($_GET['id'])) {
         $resultado = $this->marca->destroy($_GET['id']);
         if ($resultado === true) {
            $mensaje = "¡Marca eliminada con éxito!";
         } else {
            $mensaje = $resultado;
         }
      }
      echo $resultado;
      $this->index($resultado, $mensaje);
   }
}
