<?php
$titulo = "Panel de usuario";
$data = array(
   'index' => 'Inicio',
   'users/user' => 'Panel de usuario'
);
require_once '../app/views/layouts/header.php';
?>
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Panel de usuario</h3>
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

            <form id="formUser" action="/primer_proyecto/users/update" method="post">
               <div class="form-group">
                  <label>Nombre de usuario</label></br>
                  <?php echo $_SESSION['username']; ?>
               </div>
               <div class="form-group">
                  <label for="txtPasswordAntigua">Contraseña antigua</label>
                  <input type="password" name="txtPasswordAntigua" class="form-control" id="txtPasswordAntigua" placeholder="">
               </div>
               <div class="form-group">
                  <label for="txtPasswordNueva">Nueva contraseña</label>
                  <input type="password" name="txtPasswordNueva" class="form-control" id="txtPasswordNueva" placeholder="">
               </div>
               <a href="/primer_proyecto/users/logout" type="button" class="btn btn-danger">Cerrar sesión</a>
               <input type="submit" class="btn btn-primary" value="Cambiar contraseña">
            </form>
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
<!-- jquery-validation -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

<script>
   $(function() {
      $("#formUser").validate({
         rules: {
            txtPasswordAntigua: {
               required: true
            },
            txtPasswordNueva: {
               required: true
            }
         },
         messages: {
            txtPasswordAntigua: "La contraseña antigua es obligatoria.",
            txtPasswordNueva: "La nueva contraseña es obligatoria."
         },
         errorElement: 'span'
      });
   });
</script>

</body>

</html>