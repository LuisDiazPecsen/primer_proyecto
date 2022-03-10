<?php

require_once '../app/models/UnidadMedida.php';

class UnidadmedidaController
{
   private $unidadmedida;

   public function __construct()
   {
      $this->unidadmedida = new UnidadMedida();
   }

   private function viewIndex($unidadesmedida, $resultado, $mensaje)
   {
      $data = array(
         'index' => 'Inicio',
         'unidadmedida/index' => 'Unidades de medida'
      );
      require_once '../app/views/unidadmedida/index.php';
   }

   public function index($resultado = null, $mensaje = null)
   {
      $unidadesmedida = $this->unidadmedida->index();

      $this->viewIndex($unidadesmedida, $resultado, $mensaje);
   }

   public function store()
   {
      $resultado = null;
      $mensaje = null;
      if (isset($_POST)) {
         $resultado = $this->unidadmedida->store($_POST);
         if ($resultado === true) {
            $mensaje = "¡Unidad de medida agregada con éxito!";
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
         $resultado = $this->unidadmedida->update($_POST);
         print_r($resultado);
         if ($resultado === true) {
            $mensaje = "¡Unidad de medida actualizada con éxito!";
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
      if (isset($_GET['codigo'])) {
         $resultado = $this->unidadmedida->destroy($_GET['codigo']);
         if ($resultado === true) {
            $mensaje = "¡Unidad de medida eliminada con éxito!";
         } else {
            $mensaje = $resultado;
         }
      }
      echo $resultado;
      $this->index($resultado, $mensaje);
   }
}
