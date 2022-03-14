<?php

require_once '../app/models/UnidadMedida.php';

class UnidadmedidaController
{
   private $unidadmedida;

   public function __construct()
   {
      $this->unidadmedida = new UnidadMedida();
   }

   public function index($resultado = null, $mensaje = null)
   {
      $cadena = $this->unidadmedida->index();
      echo $cadena;
   }

   public function store()
   {
      $cadena = $this->unidadmedida->store($_POST);
      echo $cadena;
   }

   public function update()
   {
      $cadena = $this->unidadmedida->update($_POST);
      echo $cadena;
   }

   public function destroy()
   {
      $params = json_decode(file_get_contents('php://input'), true);
      $cadena = $this->unidadmedida->destroy($params['codigo']);
      echo $cadena;
   }

   public function searchUnidadMedida()
   {
      if (isset($_POST['descripcionUnidadMedida'])) {
         $unidadesMedida = $this->unidadmedida->searchUnidadMedida($_POST['descripcionUnidadMedida']);

         if (count($unidadesMedida) != 0) {
?>
            <div class="list-group">
               <?php
               foreach ($unidadesMedida as $unidadMedida) {
               ?>
                  <a href="#" onClick="selectname_unidadMedida('<?php echo $unidadMedida['codigo'] . ' - ' . $unidadMedida['descripcion']; ?>');" class="list-group-item list-group-item-action"><?php echo $unidadMedida['descripcion'] ?></a>
               <?php
               }
               ?>
            </div>
<?php
         }
      }
   }
}
