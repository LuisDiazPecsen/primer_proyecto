<?php
$titulo = "Marcas";
require_once '../app/views/layouts/header.php';
?>
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Marcas</h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <?php
            if (isset($resultado) && isset($mensaje)) {
               if ($resultado === true) {
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i> ' . $mensaje . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                  ';
               } else {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i> ' . $resultado . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
               }
            }
            ?>

            <!-- Button trigger modal -->
            <button id="btnAgregarMarca" type="button" class="btn btn-success mb-sm-3" data-toggle="modal" data-target="#modalMarca"><i class='fas fa-plus'></i> Agregar marca</button>

            <!-- Modal -->
            <div class="modal fade" id="modalMarca" tabindex="-1" role="dialog" aria-labelledby="marcaModalTitulo" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="marcaModalTitulo"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form id="formMarca" action="" method="post">
                        <div class="modal-body">
                           <div class="form-row">
                              <div class="form-group col-md-4">
                                 <label for="txtCodigo">Código</label>
                                 <input type="text" class="form-control" id="txtCodigo" name="txtCodigo" placeholder="M000">
                              </div>
                              <div class="form-group col-md-8">
                                 <label for="txtDescripcion">Descripción</label>
                                 <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" placeholder="Descripción de marca">
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                           <input id="btnAceptar" type="submit" class="btn btn-primary">
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <!-- Fin modal -->
            <table id="marcas_table" class="table table-striped table-bordered dt-responsive nowrap">
               <thead>
                  <tr>
                     <th>Código</th>
                     <th>Descripción</th>
                     <th>Mantenimiento</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  foreach ($marcas as $marca) {
                  ?>
                     <tr id="<?php echo $marca['codigo']; ?>">
                        <td><?php echo $marca['codigo']; ?></td>
                        <td><?php echo $marca['descripcion']; ?></td>
                        <td>
                           <button type="submit" name="<?php echo $marca['codigo']; ?>" class="btn btn-warning editar" data-toggle="modal" data-target="#modalMarca" onclick="editar(this)"><i class='fas fa-edit'></i></button>
                           <a id="eliminar<?php echo $marca['codigo']; ?>" href="/primer_proyecto/marca/destroy?codigo=<?php echo $marca['codigo']; ?>" class="btn btn-danger eliminar"><i class='fas fa-trash-alt'></i></a>
                        </td>
                     </tr>
                  <?php
                  }
                  ?>
               </tbody>
               <tfoot>
                  <tr>
                     <th>Código</th>
                     <th>Descripción</th>
                     <th>Mantenimiento</th>
                  </tr>
               </tfoot>
            </table>
         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.card -->
   </div>
   <!-- /.col -->
</div>
<!-- /.row -->

<script>
   const $btnAgregarMarca = document.getElementById("btnAgregarMarca");
   $btnAgregarMarca.onclick = function() {
      document.getElementById("formMarca").setAttribute('action', '/primer_proyecto/marca/store');
      document.getElementById("marcaModalTitulo").innerHTML = "Agregar marca";
      document.getElementById("txtCodigo").value = '';
      document.getElementById("txtDescripcion").value = '';
      document.getElementById("btnAceptar").value = 'Registrar';
   }

   function editar(element) {
      document.getElementById("formMarca").setAttribute('action', '/primer_proyecto/marca/update');
      document.getElementById("marcaModalTitulo").innerHTML = "Editar marca";
      $fila = document.getElementById(element.name);
      $columnas = $fila.children;
      console.log($columnas);
      var marca = {
         codigo: $columnas[0].innerHTML,
         descripcion: $columnas[1].innerHTML
      }
      console.log(marca);
      document.getElementById("txtCodigo").value = marca.codigo;
      document.getElementById("txtDescripcion").value = marca.descripcion;
      document.getElementById("btnAceptar").value = 'Actualizar';
   }

   /*const $grupoEditar = document.querySelectorAll(".editar");
   $grupoEditar.forEach(
      function(element, index) {
         element.onclick = editar(element);
      }
   );*/
</script>

<?php
require_once '../app/views/layouts/footer.php';
?>

<!-- jquery-validation -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

<script>
   $(function() {
      $("#formMarca").validate({
         rules: {
            txtCodigo: {
               required: true,
               maxlength: 4
            },
            txtDescripcion: {
               required: true,
               maxlength: 200
            }
         },
         messages: {
            txtCodigo: "El código de marca es obligatorio",
            txtDescripcion: "La descripción de marca es obligatoria."
         },
         errorElement: 'span'
      });
   });
</script>


<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

<script>
   $('#marcas_table').DataTable({
      responsive: true,
      autoWidth: false,
      language: {
         "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
      }
   });
</script>

</body>

</html>