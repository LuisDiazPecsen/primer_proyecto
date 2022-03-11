<!doctype html>
<html lang="es">

<head>
   <title>Registrarse</title>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="/primer_proyecto/styles.css">

</head>

<body>
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
         <div class="container-fluid">
            <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
               <!-- left column -->
               <div class="col-md-4">
                  <!-- jquery validation -->
                  <div class="card card-primary shadow-sm p-3 mb-5 bg-white rounded">
                     <div class="card-header">
                        <h3 class="card-title">Registrarse</h3>
                     </div>
                     <!-- /.card-header -->
                     <!-- form start -->
                     <form id="formRegister" action="/primer_proyecto/users/login" method="post">
                        <div class="card-body">
                           <div class="form-group">
                              <label for="txtUsername">Nombre de usuario</label>
                              <input type="text" name="txtUsername" class="form-control" id="txtUsername" placeholder="">
                           </div>
                           <div class="form-group">
                              <label for="txtPassword">Contraseña</label>
                              <input type="password" name="txtPassword" class="form-control" id="txtPassword" placeholder="">
                           </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-end">
                           <a href="/primer_proyecto/users/login" type="button" class="btn btn-secondary mx-md-2">Iniciar sesión</a>
                           <input type="submit" class="btn btn-primary" name="Register" value="Register">
                        </div>
                     </form>
                  </div>
                  <!-- /.card -->
               </div>
               <!--/.col (left) -->
               <!-- right column -->
               <!--/.col (right) -->
            </div>
            <!-- /.row -->
         </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->
   <!-- JQuery -->
   <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
   <!-- jquery-validation -->
   <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
   <!-- Bootstrap JavaScript Libraries -->
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   <script>
      $(function() {
         $("#formRegister").validate({
            rules: {
               txtUsername: {
                  required: true,
                  maxlength: 8
               },
               txtPassword: {
                  required: true
               }
            },
            messages: {
               txtUsername: "El nombre de usuario es obligatorio (máximo 8 caracteres).",
               txtPassword: "La contraseña es obligatoria."
            },
            errorElement: 'span'
         });
      });
   </script>
</body>

</html>