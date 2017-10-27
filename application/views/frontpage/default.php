<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BPSDM | Pemerintah Provinsi Kalimantan Selatan</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url('asset/bootstrap/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/plugins/datepicker/datepicker3.css'); ?>" />
	<link rel="stylesheet" href="<?= base_url('asset/plugins/select2/select2.min.css'); ?>" />
  <link rel="stylesheet" href="<?= base_url('asset/font-awesome/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/ionicons/css/ionicons.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/dist/css/AdminLTE.min.css'); ?>">
  <script src="<?= base_url('asset/plugins/pace/pace.min.js'); ?>"></script>
  <link rel="stylesheet" href="<?= base_url('asset/plugins/pace/themes/blue/pace-theme-flash.css'); ?>" />
  <style>body{background-color:whitesmoke;}a{text-decoration:none !important;}</style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <?= isset($style) ? $this->load->view($style) : ''; ?>
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> SIDA KALIBRASI
        </h2>
      </div>
      <!-- /.col -->
    </div>
    
    <!-- Table row -->
    <div class="row">
      <div class="col-md-12">
       <small class="pull-right"><a href="<?= site_url('login'); ?>" class="btn btn-primary btn-xs btn-flat"><i class="fa fa-sign-in"></i> Login</a></small>
      </div>
      <br>
      <br>
      <div class="col-md-3">
      <div class="callout callout-success">
        <a href="<?= site_url('home/dashboard'); ?>" class="btn btn-block btn-social btn-bitbucket"><i class="fa fa-home"></i> Beranda</a>
        <a href="<?= site_url('home/registrasi'); ?>" class="btn btn-block btn-social btn-bitbucket"><i class="fa fa-file-text"></i> Registrasi</a>
        <a href="#" class="btn btn-block btn-social btn-bitbucket"><i class="fa fa-check-square-o"></i> Syarat Ketentuan</a>
        <a href="<?= site_url('home/kontak'); ?>" class="btn btn-block btn-social btn-bitbucket"><i class="fa fa-envelope-o"></i> Kontak</a>


      </div>
      </div>
      <div class="col-md-9">
      <?= isset($content) ? $this->load->view($content) : ''; ?>
      </div>
      <!-- /.col -->
    </div>

    <div class="container" style="text-align:center !important;">
      <strong>Copyright &copy; 2017 <a href="#">BPSDM Provinsi Kalimantan Selatan</a>.</strong> All rights
      reserved.
    </div>
  </section>
  
  <!-- /.content -->
  
</div>

<!-- ./wrapper -->
<script src="<?= base_url('asset/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
<script src="<?= base_url('asset/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/fastclick/fastclick.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/input-mask/jquery.inputmask.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/input-mask/jquery.inputmask.date.extensions.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/select2/select2.full.min.js'); ?>"></script>
<?= isset($js) ? $this->load->view($js) : ''; ?>

</body>
</html>
