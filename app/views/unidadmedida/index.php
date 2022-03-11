<?php
$titulo = "Unidades de medida";
require_once '../app/views/layouts/header.php';
?>
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Unidades de medida</h3>
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
            <button id="btnAgregarUnidadMedida" type="button" class="btn btn-success mb-sm-3" data-toggle="modal" data-target="#modalUnidadMedida"><i class='fas fa-plus'></i> Agregar unidad de medida</button>

            <!-- Modal -->
            <div class="modal fade" id="modalUnidadMedida" tabindex="-1" role="dialog" aria-labelledby="unidadmedidaModalTitulo" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="unidadmedidaModalTitulo"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form id="formUnidadMedida" action="" method="post">
                        <div class="modal-body">
                           <div class="form-row">
                              <div class="form-group col-md-4">
                                 <label for="txtCodigo">Código</label>
                                 <input type="text" class="form-control" id="txtCodigo" name="txtCodigo" placeholder="U000">
                              </div>
                              <div class="form-group col-md-8">
                                 <label for="txtDescripcion">Descripción</label>
                                 <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" placeholder="Descripción de unidad de medida">
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
            <table id="unidadesmedida_table" class="table table-striped table-bordered dt-responsive nowrap">
               <thead>
                  <tr>
                     <th>Código</th>
                     <th>Descripción</th>
                     <th>Mantenimiento</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  foreach ($unidadesmedida as $unidadmedida) {
                  ?>
                     <tr id="<?php echo $unidadmedida['codigo']; ?>">
                        <td><?php echo $unidadmedida['codigo']; ?></td>
                        <td><?php echo $unidadmedida['descripcion']; ?></td>
                        <td>
                           <button type="submit" name="<?php echo $unidadmedida['codigo']; ?>" class="btn btn-warning editar" data-toggle="modal" data-target="#modalUnidadMedida" onclick="editar(this)"><i class='fas fa-edit'></i></button>
                           <a id="eliminar<?php echo $unidadmedida['codigo']; ?>" href="/primer_proyecto/unidadmedida/destroy?codigo=<?php echo $unidadmedida['codigo']; ?>" class="btn btn-danger eliminar"><i class='fas fa-trash-alt'></i></a>
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
   const $btnAgregarUnidadMedida = document.getElementById("btnAgregarUnidadMedida");
   $btnAgregarUnidadMedida.onclick = function() {
      document.getElementById("formUnidadMedida").setAttribute('action', '/primer_proyecto/unidadmedida/store');
      document.getElementById("unidadmedidaModalTitulo").innerHTML = "Agregar unidad de medida";
      document.getElementById("txtCodigo").value = '';
      document.getElementById("txtDescripcion").value = '';
      document.getElementById("btnAceptar").value = 'Registrar';
   }

   function editar(element) {
      document.getElementById("formUnidadMedida").setAttribute('action', '/primer_proyecto/unidadmedida/update');
      document.getElementById("unidadmedidaModalTitulo").innerHTML = "Editar unidad de medida";
      $fila = document.getElementById(element.name);
      $columnas = $fila.children;
      console.log($columnas);
      var unidadmedida = {
         codigo: $columnas[0].innerHTML,
         descripcion: $columnas[1].innerHTML
      }
      console.log(unidadmedida);
      document.getElementById("txtCodigo").value = unidadmedida.codigo;
      document.getElementById("txtDescripcion").value = unidadmedida.descripcion;
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
      $("#formUnidadMedida").validate({
         rules: {
            txtCodigo: {
               required: true,
               rangelength: [4, 4]
            },
            txtDescripcion: {
               required: true,
               maxlength: 100
            }
         },
         messages: {
            txtCodigo: "El código de unidad de medida es obligatorio (U000).",
            txtDescripcion: "La descripción de unidad de medida es obligatoria."
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
   $('#unidadesmedida_table').DataTable({
      responsive: true,
      autoWidth: false,
      language: {
         "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
      }
   });
</script>

</body>

</html>