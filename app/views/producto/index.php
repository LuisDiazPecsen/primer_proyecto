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
            <table id="productos_table" class="table table-bordered table-striped">
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
                  </tr>
               </thead>
               <tbody>
                  <?php
                  foreach ($productos as $key => $producto) {
                  ?>
                     <tr>
                        <td><?php echo $producto['codigo']; ?></td>
                        <td><?php echo $producto['descripcion']; ?></td>
                        <td><?php echo $producto['precio_compra']; ?></td>
                        <td><?php echo $producto['precio_venta']; ?></td>
                        <td><?php echo $producto['stock']; ?></td>
                        <td><?php echo $producto['stock_minimo']; ?></td>
                        <td><?php echo $producto['UNIDAD_MEDIDA_descripcion']; ?></td>
                        <td><?php echo $producto['MARCA_descripcion']; ?></td>
                        <td><?php echo $producto['CATEGORIA_descripcion']; ?></td>
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



<!-- Page specific script -->
<script>
   $(function() {
      $("#productos_table").DataTable({
         "responsive": true,
         "lengthChange": false,
         "autoWidth": false,
         "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#productos_table_wrapper .col-md-6:eq(0)');

   });
</script>

<?php
require_once '../app/views/layouts/footer.php';
?>