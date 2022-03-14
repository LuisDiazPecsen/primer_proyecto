<?php

require_once '../app/models/Categoria.php';

class CategoriaController
{
   private $categoria;

   public function __construct()
   {
      $this->categoria = new Categoria();
   }

   private function viewIndex($categorias, $resultado, $mensaje)
   {
      $data = array(
         'index' => 'Inicio',
         'categoria/index' => 'Categorías'
      );
      require_once '../app/views/categoria/index.php';
   }

   public function index($resultado = null, $mensaje = null)
   {
      $categorias = $this->categoria->index();

      $this->viewIndex($categorias, $resultado, $mensaje);
   }

   public function store()
   {
      $resultado = null;
      $mensaje = null;
      if (isset($_POST)) {
         $resultado = $this->categoria->store($_POST);
         if ($resultado === true) {
            $mensaje = "¡Categoría agregada con éxito!";
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
         $resultado = $this->categoria->update($_POST);
         if ($resultado === true) {
            $mensaje = "¡Categoría actualizada con éxito!";
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
         $resultado = $this->categoria->destroy($_GET['codigo']);
         if ($resultado === true) {
            $mensaje = "¡Categoría eliminada con éxito!";
         } else {
            $mensaje = $resultado;
         }
      }
      echo $resultado;
      $this->index($resultado, $mensaje);
   }

   public function searchCategoria()
   {
      if (isset($_POST['descripcionCategoria'])) {
         $categorias = $this->categoria->searchCategoria($_POST['descripcionCategoria']);

         if (count($categorias) != 0) {
?>
            <div class="list-group">
               <?php
               foreach ($categorias as $categoria) {
               ?>
                  <a href="#" onClick="selectname_categoria('<?php echo $categoria['id'] . ' - ' . $categoria['descripcion']; ?>');" class="list-group-item list-group-item-action"><?php echo $categoria['descripcion'] ?></a>
               <?php
               }
               ?>
            </div>
<?php
         }
      }
   }
}
