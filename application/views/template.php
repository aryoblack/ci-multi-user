<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $this->session->userdata['title']; ?> | <?php echo  $this->session->userdata['username']; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/summernote/summernote-bs4.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/adminlte.min.css">
  <!-- Body style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/stylearyo.css">
    <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<?php 

$apl = $this->db->get("aplikasi")->row();
?>
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-default navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
   <!--  <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="#" class="nav-link">
          <div class="user-panel">
        <!-- <div class="image"> -->
          <img src="<?php echo base_url();?>assets/foto/user/<?php echo $this->session->userdata['image'];?>" class="img-circle" alt="User Image">
          <?php echo $this->session->userdata['full_name']; ?>
        </div>
      <!-- </div> -->
        
        </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('login/logout') ?>" role="button">
          <i class="fas fa-sign-out-alt" title="Sign Out" ></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('dashboard'); ?>" class="brand-link">
      <img src="<?php echo base_url();?>assets/foto/logo/<?php echo $apl->logo; ?>" alt="<?php echo $apl->title; ?>" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo  $apl->title; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url();?>assets/foto/user/<?php echo $this->session->userdata['image']; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $this->session->userdata['full_name']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      <?php
            // data main menu
      $idlevel  = $this->session->userdata['id_level'];
      $main_menu = $this->db->select('b.nama_menu,b.icon,b.link,b.id_menu');
      $main_menu =$this->db->join('tbl_menu b', 'a.id_menu=b.id_menu');
      $main_menu =$this->db->join('tbl_userlevel c', 'a.id_level=c.id_level' );
      $main_menu =$this->db->where('a.id_level',$idlevel);
      $main_menu =$this->db->where('a.view_level','Y');
      $main_menu =$this->db->get('tbl_akses_menu a');
      foreach ($main_menu->result() as $main) {
        $idlevel  = $this->session->userdata['id_level'];
        
        $sub_menu = $this->db->select('');
        $sub_menu = $this->db->join('tbl_submenu b','a.id_submenu=b.id_submenu');
        $sub_menu = $this->db->where('a.id_level', $idlevel);
        $sub_menu = $this->db->where('b.id_menu', $main->id_menu);
        $sub_menu = $this->db->where('a.view_level', 'Y');
        $sub_menu = $this->db->get('tbl_akses_submenu a');
       
        if ($sub_menu->num_rows() > 0) {
          $segmen   = $this->uri->segment(1);
          $submenu = $this->db->select('link');
          $submenu = $this->db->where('id_menu', $main->id_menu);
          $submenu = $this->db->where('link', $segmen);
          $submenu = $this->db->get('tbl_submenu');
          $link='';
          if ($submenu->num_rows() > 0) {
            $sub = $submenu->row();
            $link = $sub->link;
          }
        ?>
          <li class="nav-item has-treeview <?=$this->uri->segment(1) == $link ? 'menu-open' : '' ?>">

            <a href="<?=$main->link;?>" <?=$this->uri->segment(1) == $link ? 'class="nav-link active"' : 'class="nav-link"' ?> >
              <i class="nav-icon <?=$main->icon?>"></i>
              <p>
                <?php echo $main->nama_menu; ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php foreach ($sub_menu->result() as $sub): ?>
              <li class="nav-item">
                <a href="<?=$sub->link;?>"  <?=$this->uri->segment(1) == $sub->link ? 'class="nav-link active"' : 'class="nav-link"' ?> >
                  <i class="<?=$sub->icon;?> nav-icon"></i>
                  <p><?php echo $sub->nama_submenu; ?></p>
                </a>
              </li>
            <?php endforeach; ?>
            </ul>
          
          </li>
        <?php }else{ ?>
          <li class="nav-item">
            <a href="<?=$main->link;?>" <?=$this->uri->segment(1) == $main->link ? 'class="nav-link active"' : 'class="nav-link"' ?>>
              <i class="nav-icon fas <?=$main->icon?>"></i>
              <p>
                <?php echo $main->nama_menu; ?>
              </p>
            </a>
          </li>
          <?php } } ?>
            <li class="nav-item">
              <a href="<?=base_url('login/logout')?>" class="nav-link">
              <i class="nav-icon fas  fa-sign-out-alt text-bold"></i>
                <p>Sign out</p>
              </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header " style="opacity: 0.8; ">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4><?php echo ucfirst($this->uri->segment(1)); ?></h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $this->uri->segment(1); ?>">Home</a></li>
              <li class="breadcrumb-item active"><?php echo ucfirst($this->uri->segment(1)); ?></li>
            </ol>
          </div>
        </div>
      </div>
    </section>
<!-- page-wrapper -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php echo $contents; ?>
    </div>
    </section>
<!-- /# end page-wrapper -->

</div>

<?php 

$apl = $this->db->get("aplikasi")->row();
?>
<footer class="main-footer">
<strong>Copyright &copy; <?php echo $apl->tahun; ?> <a href="#"><?php  echo $apl->nama_owner; ?></a>.</strong>
All rights reserved.
<div class="float-right d-none d-sm-inline-block">
  <b>Version</b> <?php echo $apl->versi; ?>
</div>
</footer>
<!-- jQuery -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url();?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<!-- <script src="<?php echo base_url();?>assets/plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
<script src="<?php echo base_url();?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url();?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url();?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url();?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url();?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo base_url();?>assets/dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
