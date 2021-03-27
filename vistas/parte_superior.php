<!DOCTYPE html>
<?php
include 'loginSecurity.php';
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PROYECTO</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="vendor/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

    <!--CSS para reloj-->
    <link rel="stylesheet" href="reloj.css">
    
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo $_SESSION['privilegios']; ?> </sup></div>
      </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php"><i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading"> Almacen </div>

        <!-- Nav Item - Inventario -->
        <li class="nav-item">
            <a class="nav-link" href="inventario.php"><i class="fas fa-fw fa-chart-area"></i><span>Inventario</span></a>
        </li>

        <!-- Nav Item - Recibo -->
        <li class="nav-item">
            <a class="nav-link" href="recibo.php"><i class="fas fa-fw fa-table"></i><span>Recibo</span></a>
        </li>

        <!-- Nav Item - Embarque -->
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-fw fa-table"></i><span>Embarque</span></a>
        </li>

        <!-- Nav Item - Movimientos -->
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-fw fa-table"></i><span>Movimientos</span></a>
        </li>

        <?php
        if ($_SESSION['privilegios'] == 'Administrador') {
            echo '
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Configuraciones
        </div>

        <!-- Nav Item - Usuarios -->
        <li class="nav-item">
            <a class="nav-link" href="Usuario.php"><i class="fas fa-fw fa-chart-area"></i><span>Usuario</span></a>
        </li>
        
        <!-- Nav Item - Localidad -->
        <li class="nav-item">
            <a class="nav-link" href="localidad.php"><i class="fas fa-fw fa-table"></i><span>Ubicaciones</span></a>
        </li>
        
        <!-- Nav Item - Producto -->
        <li class="nav-item">
            <a class="nav-link" href="producto.php"><i class="fas fa-fw fa-table"></i><span>Producto</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">';
        }
        ?>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Topbar hora -->
            <form
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <div class="widget">
                        <div class="fecha">
                            <p id="diaSemana" class="diaSemana">Martes</p>
                            <p id="dia" class="dia">27</p>
                            <p>de </p>
                            <p id="mes" class="mes">Octubre</p>
                            <p>del </p>
                            <p id="year" class="year">2015</p>
                            <section class="hora">
                                <p id="horas" class="horas">11</p>
                                <p>:</p>
                                <p id="minutos" class="minutos">48</p>
                                <p>:</p>
                                <p id="segundos" class="segundos">12</p>
                                <p id="ampm" class="ampm">AM</p>
                            </section>
                        </div>
                    </div>
                </div>
            </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">  <?php echo $_SESSION['nombreUsuario']; ?></span>
                  <?php
                  if ($_SESSION['foto'] == '') {
                      echo '<img src="img/profileUser.svg" class="img-profile rounded-circle" >';
                  } else {
                      echo '<img src="' . $_SESSION['foto'] . '" class="img-profile rounded-circle">';
                  }
                  ?>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
