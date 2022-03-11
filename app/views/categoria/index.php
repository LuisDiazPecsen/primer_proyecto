<?php
$titulo = "Categorías";
require_once '../app/views/layouts/header.php';
?>
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Categorías</h3>
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
            <button id="btnAgregarCategoria" type="button" class="btn btn-success mb-sm-3" data-toggle="modal" data-target="#modalCategoria"><i class='fas fa-plus'></i> Agregar categoría</button>

            <!-- Modal -->
            <div class="modal fade" id="modalCategoria" tabindex="-1" role="dialog" aria-labelledby="categoriaModalTitulo" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="categoriaModalTitulo"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form id="formCategoria" action="" method="post">
                        <div class="modal-body">
                           <div class="form-row" id="rowCodigo">
                              <div class="form-group col-md-12">
                                 <label for="txtId">ID</label>
                                 <input type="text" class="form-control" id="txtId" name="txtId" placeholder="0">
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-12">
                                 <label for="txtDescripcion">Descripción</label>
                                 <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" placeholder="Descripción de categoría">
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
            <table id="categorias_table" class="table table-striped table-bordered dt-responsive nowrap">
               <thead>
                  <tr>
                     <th>Código</th>
                     <th>Descripción</th>
                     <th>Mantenimiento</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  foreach ($categorias as $categoria) {
                  ?>
                     <tr id="<?php echo $categoria['id']; ?>">
                        <td><?php echo $categoria['id']; ?></td>
                        <td><?php echo $categoria['descripcion']; ?></td>
                        <td>
                           <button type="submit" name="<?php echo $categoria['id']; ?>" class="btn btn-warning editar" data-toggle="modal" data-target="#modalCategoria" onclick="editar(this)"><i class='fas fa-edit'></i></button>
                           <a id="eliminar<?php echo $categoria['id']; ?>" href="/primer_proyecto/categoria/destroy?id=<?php echo $categoria['id']; ?>" class="btn btn-danger eliminar"><i class='fas fa-trash-alt'></i></a>
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
   document.getElementById("rowCodigo").style.display = 'none';


   const $btnAgregarCategoria = document.getElementById("btnAgregarCategoria");
   $btnAgregarCategoria.onclick = function() {
      document.getElementById("rowCodigo").style.display = 'none';
      document.getElementById("formCategoria").setAttribute('action', '/primer_proyecto/categoria/store');
      document.getElementById("categoriaModalTitulo").innerHTML = "Agregar categoría";
      document.getElementById("txtId").value = '';
      document.getElementById("txtDescripcion").value = '';
      document.getElementById("btnAceptar").value = 'Registrar';
   }

   function editar(element) {
      document.getElementById("rowCodigo").style.display = 'none';
      document.getElementById("formCategoria").setAttribute('action', '/primer_proyecto/categoria/update');
      document.getElementById("categoriaModalTitulo").innerHTML = "Editar categoría";
      $fila = document.getElementById(element.name);
      $columnas = $fila.children;
      console.log($columnas);
      var categoria = {
         id: $columnas[0].innerHTML,
         descripcion: $columnas[1].innerHTML
      }
      console.log(categoria);
      document.getElementById("txtId").value = categoria.id;
      document.getElementById("txtDescripcion").value = categoria.descripcion;
      document.getElementById("btnAceptar").value = 'Actualizar';
   }

   /*function enviarDatosCategoria($btnAceptar, categoria) {
      that = this;
      if ($btnAceptar.value = 'Actualizar') {
         $btnAceptar.onclick = function clickActualizar(categoria = that.categoria) {
            categoriaEditar = {
               "txtId": categoria.id,
               "txtDescripcion": document.getElementById("txtDescripcion").value
            }
            /*$.post('/primer_proyecto/categoria/update', categoriaEditar, function(data) {
               console.log('Procesamiento finalizado', data);
            });*/
   /*$.ajax({
      url: "/primer_proyecto/categoria/update",
      method: "POST",
      data: categoriaEditar
   })*/

   //function siguiente() {
   /*var xhttp;

   if (window.XMLHttpRequest)
      xhttp = new XMLHttpRequest();
   else
      xhttp = new ActiveXObject("Microsoft.XMLHTTP");

   xhttp.onreadystatechange = function() {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
         window.open("/primer_proyecto/categoria/update");
      }
   }

   xhttp.open("POST", "/primer_proyecto/categoria/update");
   xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
   xhttp.send("data =" + JSON.stringify(categoriaEditar));
   //}

   };
   }
   else {
      $btnAceptar.onclick = function() {
         $.post('/primer_proyecto/categoria/store', {
            "txtDescripcion": document.getElementById("txtDescripcion").value
         }, function(data) {
            console.log('Procesamiento finalizado', data);
         })
      }
   }
   }*/

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
      $("#formCategoria").validate({
         rules: {
            txtDescripcion: {
               required: true,
               maxlength: 100
            }
         },
         messages: {
            txtDescripcion: "La descripción de categoría es obligatoria."
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
   $('#categorias_table').DataTable({
      responsive: true,
      autoWidth: false,
      language: {
         "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
      }
   });
</script>

</body>

</html>