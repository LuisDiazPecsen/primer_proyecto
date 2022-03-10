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
                        <div class="modal-body">
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
                                 <label for="txtUnidadMedida">Unida de medida</label>
                                 <input type="text" class="form-control" id="txtUnidadMedida" name="txtUnidadMedida" placeholder="U000">
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col-md-6">
                                 <label for="txtMarca">Marca</label>
                                 <input type="text" class="form-control" id="txtMarca" name="txtMarca" placeholder="M000">
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="txtCategoria">Categoría</label>
                                 <input type="text" class="form-control" id="txtCategoria" name="txtCategoria" placeholder="0">
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

<script>
   const $btnAgregarProducto = document.getElementById("btnAgregarProducto");
   $btnAgregarProducto.onclick = function() {
      document.getElementById("formProducto").setAttribute('action', '/primer_proyecto/producto/store');
      document.getElementById("productoModalTitulo").innerHTML = "Agregar producto";
      document.getElementById("txtCodigo").setAttribute('value', '');
      document.getElementById("txtDescripcion").setAttribute('value', '');
      document.getElementById("txtPrecioCompra").setAttribute('value', '');
      document.getElementById("txtPrecioVenta").setAttribute('value', '');
      document.getElementById("txtStock").setAttribute('value', '');
      document.getElementById("txtStockMinimo").setAttribute('value', '');
      document.getElementById("txtUnidadMedida").setAttribute('value', '');
      document.getElementById("txtMarca").setAttribute('value', '');
      document.getElementById("txtCategoria").setAttribute('value', '');
      document.getElementById("btnAceptar").setAttribute('value', 'Registrar');
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
         unidad_medida_codigo: $columnas[6].getAttribute('value'),
         marca_codigo: $columnas[7].getAttribute('value'),
         categoria_id: $columnas[8].getAttribute('value')
      }
      console.log(producto);
      document.getElementById("txtCodigo").value = producto.codigo;
      document.getElementById("txtDescripcion").value = producto.descripcion;
      document.getElementById("txtPrecioCompra").setAttribute('value', producto.precio_compra);
      document.getElementById("txtPrecioVenta").setAttribute('value', producto.precio_venta);
      document.getElementById("txtStock").setAttribute('value', producto.stock);
      document.getElementById("txtStockMinimo").setAttribute('value', producto.stock_minimo);
      document.getElementById("txtUnidadMedida").setAttribute('value', producto.unidad_medida_codigo);
      document.getElementById("txtMarca").setAttribute('value', producto.marca_codigo);
      document.getElementById("txtCategoria").setAttribute('value', producto.categoria_id);
      document.getElementById("btnAceptar").setAttribute('value', 'Actualizar');
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