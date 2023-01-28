<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>CC | Admin</title>
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3 -->
<!--<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/fontawesome-free/css/all.min.css">-->
<!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
 <!--<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.css">-->
    <!-- Theme style -->
 <link rel="stylesheet" href="<?PHP echo base_url();?>assets/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/_all-skins.min.css">

    <!-- DATATABLES -->
 <link rel="stylesheet"  href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-select.min.css">



  <script src="https://kit.fontawesome.com/74a6435741.js" crossorigin="anonymous"></script>

  </head>

<body class="hold-transition skin-blue sidebar-mini">
  <!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>

<!-- Your customer chat code -->
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="280144326139427"
  theme_color="#0084ff"
  logged_in_greeting="Hola! deseas compartir algún sistema o descargar ?"
  logged_out_greeting="Hola! deseas compartir algún sistema o descargar ?">
</div>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="escritorio.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>CC</b> A</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CC</b> ADMIN</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li class="dropdown user user-menu">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
<img src="<?php echo base_url()?>imagenes1/<?php echo $_SESSION['imagen'];?>" class="user-image" alt="User Image">
  <span class="hidden-xs"><?php echo $_SESSION['nombre_usuario'];?></span>
              

              
            </a>
            <ul class="dropdown-menu">
         
              <li class="user-header">
    <img src="<?php echo base_url()?>imagenes1/<?php echo $_SESSION['imagen'];?>" class="user-image" alt="User Image">
                <p>
                <?php echo $_SESSION['nombre_usuario'];?>
                <small>Sistema de desarrollo</small>
                </p>
              </li>
            
              <li class="user-footer">

                <!--<div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>-->

                <div class="pull-right">
                  <a href="<?php echo base_url()?>index.php/acceso/cerrar" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>


          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
<div class="user-panel">
        <div class="pull-left image">
   <img src="<?php echo base_url()?>imagenes1/<?php echo $_SESSION['imagen'];?>" class="img-circle" style="width: 50px; height: 50px;" alt="User Image">  

        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['nombre_usuario']; ?></p>
          <a href="#"> 
            <i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu tree" data-widget="tree">

        
      <li class="header">MENÚ DE NAVEGACIÓN</li>


  <li><a href="<?php echo base_url()?>index.php/acceso/escritorio"><i class="fa  fa-dashboard"></i> <span>Escritorio</span></a></li>
      <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Acceso</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>index.php/usuario/usuario"><i class="fa fa-circle-o"></i> Usuarios</a></li>
            <li><a href="<?php echo base_url()?>index.php/acceso/tipousuario"><i class="fa fa-circle-o"></i> Tipo Usuario</a></li>

          </ul>
      </li>

      <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Departamento</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>index.php/departamento/index"><i class="fa fa-circle-o"></i> Departamento</a></li>            
          </ul>
      </li>

          <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Asistencias</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>index.php/asistencia/index"><i class="fa fa-circle-o"></i> Asistencia</a></li>
            <li><a href="<?php echo base_url()?>index.php/reporte/index"><i class="fa fa-circle-o"></i> Reportes</a></li>
           
          </ul>
      </li>


    <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Horarios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>index.php/horarios/index"><i class="fa fa-circle-o"></i> horario</a></li>
         
           
          </ul>
      </li>


      

  
      <li><a href="https://www.youtube.com/watch?v=44Jgnt56gso&t=30s"><i class="fa fa-question-circle"></i> <span>Ayuda</span><small class="label pull-right bg-yellow">PDF</small></a></li>
     <!-- <li><a href="https://www.compartiendocodigos.net/"><i class="fa  fa-exclamation-circle"></i> <span>Acerca de</span><small class="label pull-right bg-yellow">ComCod</small></a></li> -->  
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


  

