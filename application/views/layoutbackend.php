<!-- header -->
<?php 
$this->load->view('templates/header') 

?>
<!-- end header -->

<!-- menu -->
<?php 
$this->load->view('templates/menu'); 
?>
<!-- end menu -->


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
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- /#wrapper -->
        <!-- footer -->

<!-- end footer -->
<?php $this->load->view('templates/footer') ?>
</body>

</html>
