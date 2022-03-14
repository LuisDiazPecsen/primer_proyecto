<?php
if (!isset($_SESSION)) {
   session_start();
}

if (!isset($_SESSION['username'])) {
   header('Location: /primer_proyecto/users/login');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Primer proyecto</title>

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
   </link>
   <!-- AdminLTE -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
   <!-- Bootstrap -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
   <!--link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"-->
   <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
   <!-- Validate -->
   <link rel="stylesheet" href="/primer_proyecto/styles.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed" id="body">
   <!-- Preloader -->
   <div id="contenedor_carga" style="visibility: hidden;">
      <div id="carga">
      </div>
   </div>
   <div class="wrapper">

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
         <!-- Left navbar links -->
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
               <a id="btnLBIndex" type="button" class="nav-link">Inicio</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
               <a id="btnLBProducto" type="button" class="nav-link">Productos</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
               <a id="btnLBMarca" type="button" class="nav-link btnMarca">Marcas</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
               <a id="btnLBCategoria" type="button" class="nav-link btnCategoria">Categorías</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
               <a id="btnLBUnidadMedida" type="button" class="nav-link btnUnidadMedida">Unidades de medida</a>
            </li>
         </ul>

         <!-- Right navbar links -->
         <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
               </a>
            </li>
         </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
         <!-- Brand Logo -->
         <a id="btnSBIndex" type="button" class="brand-link">
            <img src="/primer_proyecto/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Primer proyecto</span>
         </a>

         <!-- Sidebar -->
         <div class="sidebar d-flex align-content-between flex-wrap">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                     <a id="btnSBUsuario" type="button" class="nav-link">
                        <i class="nav-icon far fa-user-circle"></i>
                        <p>Usuario</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a id="btnSBProducto" type="button" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Productos</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a id="btnSBMarca" type="button" class="nav-link">
                        <i class='fas fa-tags'></i>
                        <p>Marcas</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a id="btnSBCategoria" type="button" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>Categorías</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a id="btnSBUnidadMedida" type="button" class="nav-link">
                        <i class="nav-icon fas fa-ruler"></i>
                        <p>Unidades de medida</p>
                     </a>
                  </li>
               </ul>
            </nav>
            <!-- /.sidebar-menu -->

            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                     <a href="/primer_proyecto/users/logout" class="nav-link">
                        <i class='fas fa-sign-out-alt'></i>
                        <p>Cerrar sesión</p>
                     </a>
                  </li>
            </nav>
         </div>
         <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                     <h1 class="m-0" id="tituloPagina"></h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                     <ol id="listaURL" class="breadcrumb float-sm-right">
                        <!--li class=" breadcrumb-item"><a href="#">Home</a></li-->
                        <!--li class="breadcrumb-item active">Dashboard v1</li-->
                     </ol>
                  </div><!-- /.col -->
               </div><!-- /.row -->
            </div><!-- /.container-fluid -->
         </div>
         <!-- /.content-header -->

         <!-- Main content -->
         <section class="content">
            <div class="container-fluid">