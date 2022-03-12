<?php
$titulo = "Productos";
require_once '../app/views/layouts/header.php';
?>
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Productos</h3>
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
            <button id="btnAgregarProducto" type="button" class="btn btn-success mb-sm-3" data-toggle="modal" data-target="#modalProducto"><i class='fas fa-plus'></i> Agregar producto</button>

            <!-- Modal -->
            <div class="modal fade" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="productoModalTitulo" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="productoModalTitulo"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form id="formProducto" action="" method="post">
                        <div id="modalBodyProducto" class="modal-body">
                           <div id="filaError">

                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-4">
                                 <label for="txtCodigo">Código</label>
                                 <input type="text" class="form-control" id="txtCodigo" name="txtCodigo" placeholder="P000">
                              </div>
                              <div class="form-group col-md-8">
                                 <label for="txtDescripcion">Descripción</label>
                                 <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" placeholder="Descripción de producto">
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="txtPrecioCompra">Precio de compra</label>
                                 <input type="text" class="form-control" id="txtPrecioCompra" name="txtPrecioCompra" placeholder="0.00">
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="txtPrecioVenta">Precio de venta</label>
                                 <input type="text" class="form-control" id="txtPrecioVenta" name="txtPrecioVenta" placeholder="0.00">
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-3">
                                 <label for="txtStock">Stock</label>
                                 <input type="text" class="form-control" id="txtStock" name="txtStock" placeholder="0">
                              </div>
                              <div class="form-group col-md-3">
                                 <label for="txtStockMinimo">Stock mínimo</label>
                                 <input type="text" class="form-control" id="txtStockMinimo" name="txtStockMinimo" placeholder="0">
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="txtUnidadMedida">Unidad de medida</label>
                                 <input type="text" class="form-control" id="txtUnidadMedida" name="txtUnidadMedida" placeholder="Buscar...">
                                 <a href="#" id="btnCambiarUnidadMedida" class="btn btn-warning" hidden>Cambiar</a>
                                 <span id="unidadMedidaList"></span>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="txtMarca">Marca</label>
                                 <input type="text" class="form-control" id="txtMarca" name="txtMarca" placeholder="Buscar...">
                                 <a href="#" id="btnCambiarMarca" class="btn btn-warning" hidden>Cambiar</a>
                                 <span id="marcaList"></span>
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="txtCategoria">Categoría</label>
                                 <input type="text" class="form-control" id="txtCategoria" name="txtCategoria" placeholder="Buscar...">
                                 <a href="#" id="btnCambiarCategoria" class="btn btn-warning" hidden>Cambiar</a>
                                 <span id="categoriaList"></span>
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
            <table id="productos_table" class="table table-striped table-bordered dt-responsive nowrap">
               <thead>
                  <tr>
                     <th>Código</th>
                     <th>Descripción</th>
                     <th>Precio de compra</th>
                     <th>Precio de venta</th>
                     <th>Stock</th>
                     <th>Stock mínimo</th>
                     <th>Unidad de medida</th>
                     <th>Marca</th>
                     <th>Categoría</th>
                     <th>Mantenimiento</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  foreach ($productos as $producto) {
                  ?>
                     <tr id="<?php echo $producto['codigo']; ?>">
                        <td><?php echo $producto['codigo']; ?></td>
                        <td><?php echo $producto['descripcion']; ?></td>
                        <td><?php echo $producto['precio_compra']; ?></td>
                        <td><?php echo $producto['precio_venta']; ?></td>
                        <td><?php echo $producto['stock']; ?></td>
                        <td><?php echo $producto['stock_minimo']; ?></td>
                        <td value="<?php echo $producto['UNIDAD_MEDIDA_codigo'] ?>"><?php echo $producto['UNIDAD_MEDIDA_descripcion']; ?></td>
                        <td value="<?php echo $producto['MARCA_codigo'] ?>"><?php echo $producto['MARCA_descripcion']; ?></td>
                        <td value="<?php echo $producto['CATEGORIA_id'] ?>"><?php echo $producto['CATEGORIA_descripcion']; ?></td>
                        <td>
                           <button type="submit" name="<?php echo $producto['codigo']; ?>" class="btn btn-warning editar" data-toggle="modal" data-target="#modalProducto" onclick="editar(this)"><i class='fas fa-edit'></i></button>
                           <a id="eliminar<?php echo $producto['codigo']; ?>" href="/primer_proyecto/producto/destroy?codigo=<?php echo $producto['codigo']; ?>" class="btn btn-danger eliminar"><i class='fas fa-trash-alt'></i></a>
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
                     <th>Precio de compra</th>
                     <th>Precio de venta</th>
                     <th>Stock</th>
                     <th>Stock mínimo</th>
                     <th>Unidad de medida</th>
                     <th>Marca</th>
                     <th>Categoría</th>
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



<?php
require_once '../app/views/layouts/footer.php';
?>

<script>
   const $btnAgregarProducto = document.getElementById("btnAgregarProducto");
   $btnAgregarProducto.onclick = function() {
      document.getElementById("formProducto").setAttribute('action', '/primer_proyecto/producto/store');
      document.getElementById("productoModalTitulo").innerHTML = "Agregar producto";
      let campos = [
         'txtCodigo',
         'txtDescripcion',
         'txtPrecioCompra',
         'txtPrecioVenta',
         'txtStock',
         'txtStockMinimo',
         'txtUnidadMedida',
         'txtMarca',
         'txtCategoria'
      ];
      campos.forEach(element => {
         document.getElementById(element).value = '';
      });
      vaciarListas();
      quitarAlerta();
      document.getElementById("btnAceptar").value = 'Registrar';
   }

   function editar(element) {
      document.getElementById("formProducto").setAttribute('action', '/primer_proyecto/producto/update');
      document.getElementById("productoModalTitulo").innerHTML = "Editar producto";
      $fila = document.getElementById(element.name);
      $columnas = $fila.children;
      console.log($columnas);
      var producto = {
         codigo: $columnas[0].innerHTML,
         descripcion: $columnas[1].innerHTML,
         precio_compra: $columnas[2].innerHTML,
         precio_venta: $columnas[3].innerHTML,
         stock: $columnas[4].innerHTML,
         stock_minimo: $columnas[5].innerHTML,
         unidad_medida: $columnas[6].getAttribute('value') + ' - ' + $columnas[6].innerHTML,
         marca: $columnas[7].getAttribute('value') + ' - ' + $columnas[7].innerHTML,
         categoria: $columnas[8].getAttribute('value') + ' - ' + $columnas[8].innerHTML
      }
      console.log(producto);
      quitarAlerta();
      document.getElementById("txtCodigo").value = producto.codigo;
      document.getElementById("txtDescripcion").value = producto.descripcion;
      document.getElementById("txtPrecioCompra").value = producto.precio_compra;
      document.getElementById("txtPrecioVenta").value = producto.precio_venta;
      document.getElementById("txtStock").value = producto.stock;
      document.getElementById("txtStockMinimo").value = producto.stock_minimo;

      const $txtUnidadMedida = document.getElementById('txtUnidadMedida');
      $txtUnidadMedida.readOnly = true;
      $txtUnidadMedida.value = producto.unidad_medida;
      document.getElementById('btnCambiarUnidadMedida').hidden = false;

      const $txtMarca = document.getElementById('txtMarca');
      $txtMarca.readOnly = true;
      $txtMarca.value = producto.marca;
      document.getElementById('btnCambiarMarca').hidden = false;

      const $txtCategoria = document.getElementById('txtCategoria');
      $txtCategoria.readOnly = true;
      $txtCategoria.value = producto.categoria;
      document.getElementById('btnCambiarCategoria').hidden = false;

      document.getElementById("btnAceptar").value = 'Actualizar';
   }
</script>

<!-- Autocomplete search bar -->
<script>
   const $txtUnidadMedida = document.getElementById('txtUnidadMedida');
   $txtUnidadMedida.onkeyup = function() {
      let descripcionUnidadMedida = this.value;
      if (descripcionUnidadMedida != '') {
         console.log(descripcionUnidadMedida);
         $.ajax({
            url: '/primer_proyecto/unidadmedida/searchUnidadMedida',
            method: 'POST',
            data: {
               descripcionUnidadMedida
            },
            success: function(data) {
               console.log(data);
               const $unidadMedidaList = document.getElementById('unidadMedidaList');
               $unidadMedidaList.hidden = false;
               $unidadMedidaList.innerHTML = data;
            }
         });
      } else {
         $('#unidadMedidaList').html('');
      }
   }

   const $txtMarca = document.getElementById('txtMarca');
   $txtMarca.onkeyup = function() {
      let descripcionMarca = this.value;
      if (descripcionMarca != '') {
         console.log(descripcionMarca);
         $.ajax({
            url: '/primer_proyecto/marca/searchMarca',
            method: 'POST',
            data: {
               descripcionMarca
            },
            success: function(data) {
               console.log(data);
               const $marcaList = document.getElementById('marcaList');
               $marcaList.hidden = false;
               $marcaList.innerHTML = data;
            }
         });
      } else {
         $('#marcaList').html('');
      }
   }

   const $txtCategoria = document.getElementById('txtCategoria');
   $txtCategoria.onkeyup = function() {
      let descripcionCategoria = this.value;
      if (descripcionCategoria != '') {
         console.log(descripcionCategoria);
         $.ajax({
            url: '/primer_proyecto/categoria/searchCategoria',
            method: 'POST',
            data: {
               descripcionCategoria
            },
            success: function(data) {
               console.log(data);
               const $categoriaList = document.getElementById('categoriaList');
               $categoriaList.hidden = false;
               $categoriaList.innerHTML = data;
            }
         });
      } else {
         $('#categoriaList').html('');
      }
   }

   const $btnCambiarUnidadMedida = document.getElementById('btnCambiarUnidadMedida');
   $btnCambiarUnidadMedida.onclick = function() {
      vaciarUnidadMedida();
   }

   const $btnCambiarMarca = document.getElementById('btnCambiarMarca');
   $btnCambiarMarca.onclick = function() {
      vaciarMarca();
   }

   const $btnCambiarCategoria = document.getElementById('btnCambiarCategoria');
   $btnCambiarCategoria.onclick = function() {
      vaciarCategoria();
   }

   function selectname_unidadMedida(selected_value) {
      const $txtUnidadMedida = document.getElementById('txtUnidadMedida');
      $txtUnidadMedida.readOnly = true;
      $txtUnidadMedida.value = selected_value;

      document.getElementById('unidadMedidaList').hidden = true;
      document.getElementById('btnCambiarUnidadMedida').hidden = false;
   }

   function selectname_marca(selected_value) {
      const $txtMarca = document.getElementById('txtMarca');
      $txtMarca.readOnly = true;
      $txtMarca.value = selected_value;

      document.getElementById('marcaList').hidden = true;
      document.getElementById('btnCambiarMarca').hidden = false;
   }

   function selectname_categoria(selected_value) {
      const $txtCategoria = document.getElementById('txtCategoria');
      $txtCategoria.readOnly = true;
      $txtCategoria.value = selected_value;

      document.getElementById('categoriaList').hidden = true;
      document.getElementById('btnCambiarCategoria').hidden = false;
   }

   function vaciarListas() {
      vaciarUnidadMedida();
      vaciarMarca();
      vaciarCategoria();
   }

   function vaciarUnidadMedida() {
      const $txtUnidadMedida = document.getElementById('txtUnidadMedida');
      $txtUnidadMedida.value = '';
      $txtUnidadMedida.readOnly = false;

      document.getElementById('btnCambiarUnidadMedida').hidden = true;
   }

   function vaciarMarca() {
      const $txtMarca = document.getElementById('txtMarca');
      $txtMarca.value = '';
      $txtMarca.readOnly = false;

      document.getElementById('btnCambiarMarca').hidden = true;
   }

   function vaciarCategoria() {
      const $txtCategoria = document.getElementById('txtCategoria');
      $txtCategoria.value = '';
      $txtCategoria.readOnly = false;

      document.getElementById('btnCambiarCategoria').hidden = true;
   }
</script>

<!-- jquery-validation -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

<script>
   function quitarAlerta() {
      if (document.getElementById('errorDiv')) {
         document.getElementById('filaError').removeChild(document.getElementById('errorDiv'));
      }
   }

   function validar() {
      var $inputsList = [];
      var errorList = [];
      const numeroDecimal = /^\d+(?:.\d+)?$/;

      $formProducto = document.getElementById('formProducto');
      $inputsList = $formProducto.getElementsByTagName('input');

      for (const $input of $inputsList) {
         switch ($input.name) {
            case 'txtDescripcion':
               if ($input.value == '') {
                  errorList.push('La descripción es obligatoria.');
               } else {
                  if ($input.value.length > 200) {
                     errorList.push('No puedes superar los 200 caracteres.');
                  }
               }
               break;
            case 'txtPrecioCompra':
               if ($input.value == '') {
                  errorList.push('El precio de compra es obligatorio.');
               } else {
                  if (!numeroDecimal.test($input.value)) {
                     console.log("NO VALIDO");
                     errorList.push('El precio de compra no es válido');
                  }
               }
               break;
            case 'txtPrecioVenta':
               if ($input.value == '') {
                  errorList.push('El precio de venta es obligatorio.');
               } else {
                  if (!numeroDecimal.test($input.value)) {
                     errorList.push('El precio de venta no es válido');
                  }
               }
               break;
            case 'txtStock':
               if ($input.value == '') {
                  errorList.push('El stock es obligatorio.');
               } else {
                  if (!numeroDecimal.test($input.value)) {
                     errorList.push('El stock no es válido');
                  }
               }
               break;
            case 'txtStockMinimo':
               if ($input.value == '') {
                  errorList.push('El stock mínimo es obligatorio.');
               } else {
                  if (!numeroDecimal.test($input.value)) {
                     errorList.push('El stock mínimo no es válido');
                  }
               }
               break;
            case 'txtMarca':
               if ($input.value == '') {
                  errorList.push('La marca es obligatoria.');
               } else {
                  if (!$input.readOnly) {
                     errorList.push('Debes seleccionar un elemento de la lista');
                  }
               }
               break;
            case 'txtUnidadMedida':
               if ($input.value == '') {
                  errorList.push('La unidad de medida es obligatoria.');
               } else {
                  if (!$input.readOnly) {
                     errorList.push('Debes seleccionar un elemento de la lista');
                  }
               }
               break;
            case 'txtCategoria':
               if ($input.value == '') {
                  errorList.push('La categoría es obligatoria.');
               } else {
                  if (!$input.readOnly) {
                     errorList.push('Debes seleccionar un elemento de la lista');
                  }
               }

               break;
            default:
               break;
         }
      }

      if (errorList.length != 0) {
         var summary = "";
         errorList.forEach(error => {
            summary += "<li>" + error + "</li>";
         });
         console.log(summary);

         quitarAlerta();

         const $errorDiv = document.createElement('div');
         $errorDiv.setAttribute('id', 'errorDiv');
         $errorDiv.setAttribute('class', 'alert alert-danger alert-dismissible fade show');
         $errorDiv.setAttribute('role', 'alert');
         const $ul = document.createElement('ul');
         $ul.setAttribute('id', 'listaErrores');
         const $button = document.createElement('button');
         $button.setAttribute('type', 'button');
         $button.setAttribute('class', 'close');
         $button.setAttribute('data-dismiss', 'alert');
         $button.setAttribute('aria-label', 'Close');
         const $span = document.createElement('span');
         $span.setAttribute('aria-hidden', 'true');
         $span.innerHTML = "&times;";
         $button.appendChild($span);
         $errorDiv.appendChild($ul);
         $errorDiv.appendChild($button);

         document.getElementById('filaError').appendChild($errorDiv);
         document.getElementById('listaErrores').innerHTML = summary;

         return false;
      } else {
         return true;
      }
   }

   document.getElementById('formProducto').onsubmit = function(event) {
      if (!validar()) {
         event.preventDefault();
      }
   }
</script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

<script>
   $('#productos_table').DataTable({
      responsive: true,
      autoWidth: false,
      language: {
         "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
      }
   });
</script>

</body>

</html>