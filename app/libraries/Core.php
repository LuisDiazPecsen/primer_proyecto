<?php
/*
   * App Core Class
   * Crear URL y carga el controlador principal
   * Formato de URL - /controller/method/params
   */
class Core
{
   protected $currentController = 'MainController';
   protected $currentMethod = 'index';
   protected $params = [];

   public function __construct()
   {
      echo "CORE</br>";
      //print_r($this->getUrl());

      $url = $this->getUrl();

      // Encontrar el controlador del índice 0 de la URL
      if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
         // Si existe, asignarlo a currentController
         $this->currentController = ucwords($url[0]);
         unset($url[0]);
      }

      require_once '../app/controllers/' . $this->currentController . '.php';

      // Instanciar la clase del controlador
      $this->currentController = new $this->currentController;

      // Revisar la segunda parte de la URL
      if (isset($url[1])) {
         // Revisar si existe el método en el controlador
         if (method_exists($this->currentController, $url[1])) {
            $this->currentMethod = $url[1];
            unset($url[1]);
         }
      }

      // Obtener parámetros

      /*if ($url) {
         $this->params = array_values($url);
      } else {
         $this->params = [];
      }*/

      $this->params = $url ? array_values($url) : [];

      // Call a callback with array of params
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
   }

   public function getUrl()
   {
      $url = $_SERVER['REQUEST_URI'];
      $url = explode("/", $url);
      $url = end($url);
      $url = explode(".", $url);
      //$url = $url[0];

      return $url;

      /*if (isset($_GET['url'])) {
         $url = rtrim($_GET['url'], '/');
         $url = filter_var($url, FILTER_SANITIZE_URL);
         $url = explode('/', $url);
         return $url;
      }*/
   }
}
