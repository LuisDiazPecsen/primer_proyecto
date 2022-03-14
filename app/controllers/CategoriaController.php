<?php

require_once '../app/models/Categoria.php';

class CategoriaController
{
   private $categoria;

   public function __construct()
   {
      $this->categoria = new Categoria();
   }

   public function index()
   {
      $cadena = $this->categoria->index();
      echo $cadena;
   }

   public function store()
   {
      $cadena = $this->categoria->store($_POST);
      echo $cadena;
   }

   public function update()
   {
      $cadena = $this->categoria->update($_POST);
      echo $cadena;
   }

   public function destroy()
   {
      $params = json_decode(file_get_contents('php://input'), true);
      $cadena = $this->categoria->destroy($params['codigo']);
      echo $cadena;
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
                  <a href="#" onClick="selectname_categoria('<?php echo $categoria['codigo'] . ' - ' . $categoria['descripcion']; ?>');" class="list-group-item list-group-item-action"><?php echo $categoria['descripcion'] ?></a>
               <?php
               }
               ?>
            </div>
<?php
         }
      }
   }
}
