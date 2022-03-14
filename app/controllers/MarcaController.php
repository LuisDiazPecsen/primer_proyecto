<?php

require_once '../app/models/Marca.php';

class MarcaController
{
   private $marca;

   public function __construct()
   {
      $this->marca = new Marca();
   }

   public function index()
   {
      $cadena = $this->marca->index();
      echo $cadena;
   }

   public function store()
   {
      $cadena = $this->marca->store($_POST);
      echo $cadena;
   }

   public function update()
   {
      $cadena = $this->marca->update($_POST);
      echo $cadena;
   }

   public function destroy()
   {
      $params = json_decode(file_get_contents('php://input'), true);
      $cadena = $this->marca->destroy($params['codigo']);
      echo $cadena;
   }

   public function searchMarca()
   {
      if (isset($_POST['descripcionMarca'])) {
         $marcas = $this->marca->searchMarca($_POST['descripcionMarca']);

         if (count($marcas) != 0) {
?>
            <div class="list-group">
               <?php
               foreach ($marcas as $marca) {
               ?>
                  <a href="#" onClick="selectname_marca('<?php echo $marca['codigo'] . ' - ' . $marca['descripcion']; ?>');" class="list-group-item list-group-item-action"><?php echo $marca['descripcion'] ?></a>
               <?php
               }
               ?>
            </div>
<?php
         }
      }
   }
}
