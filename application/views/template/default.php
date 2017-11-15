<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= isset($title) ? $title : 'BPSDM Provinsi Kalimantan Selatan'; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url('asset/bootstrap/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/plugins/datatables/dataTables.bootstrap.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('asset/plugins/datatables/extensions/Responsive/css/responsive.bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/plugins/tableexport/dist/css/tableexport.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/plugins/datepicker/datepicker3.css'); ?>" />
	<link rel="stylesheet" href="<?= base_url('asset/plugins/select2/select2.min.css'); ?>" />
  <link rel="stylesheet" href="<?= base_url('asset/font-awesome/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/ionicons/css/ionicons.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/dist/css/AdminLTE.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/dist/css/skins/_all-skins.min.css'); ?>">
	<script src="<?= base_url('asset/plugins/pace/pace.min.js'); ?>"></script>
  <link rel="stylesheet" href="<?= base_url('asset/plugins/pace/themes/blue/pace-theme-flash.css'); ?>" />
  <?= isset($style) ? $this->load->view($style) : ''; ?>
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
	<style>body{font-size: 12px;}.nav-tabs-custom>.nav-tabs>li.active {border-top-color: #00a65a !important;}@media(min-width: 1024px){.main-header{top:0;left: 0;position: fixed;right: 0;z-index: 999;}.content-wrapper{padding-top:50px; padding-bottom:50px;}}.print{font-size: 9px;}.main-footer{bottom:0;left: 0;position: fixed;right: 0;z-index: 999;}.has-error .select2-selection {border: 1px solid #a94442;border-radius: 0px;}</style>
	
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="#" class="navbar-brand"><b></b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?= site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book"></i> Data<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?= site_url('data/registrasi'); ?>"><i class="fa fa-file-text-o"></i> Data Registrasi</a></li>
                <li><a href="<?= site_url('data/pemohon'); ?>"><i class="fa fa-file-text-o"></i> Data Permohonan Diklat</a></li>
              </ul>
            </li>
            <li><a href="<?= site_url('daftar'); ?>"><i class="fa fa-file-text"></i> Registrasi Diklat</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-database"></i> Data Master <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?= site_url('referensi/instansi'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Instansi</a></li>
                <li><a href="<?= site_url('referensi/pengelola'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Pengelola Kepegawaian</a></li>
                <li class="divider"></li>
                <li><a href="<?= site_url('referensi/pangkat'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Tingkat Golongan</a></li>
                <li><a href="<?= site_url('referensi/eselon'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Tingkat Jabatan</a></li>
                <li><a href="<?= site_url('referensi/ktpu'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Tingkat Pendidikan</a></li>
								<li class="divider"></li>
                <li><a href="<?= site_url('referensi/jenis'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Jenis Jabatan</a></li>
                <li><a href="<?= site_url('referensi/jenjang'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Jejang Jabatan</a></li>
                <li><a href="<?= site_url('referensi/diklat'); ?>"><i class="fa fa-plus-square-o"></i> Referensi Jenis Diklat</a></li>
              </ul>
            </li>
						<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-print"></i> Laporan <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?= site_url('report/#'); ?>" target="_BLANK"><i class="fa fa-file-text-o"></i> Laporan Registrasi</a></li>
              </ul>
            </li>
						<li><a href="<?= site_url('setting/informasi'); ?>"><i class="fa fa-feed"></i> Informasi</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> Tanya Jawab</a></li>
						<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i> Pengaturan <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?= site_url('setting/user'); ?>"><i class="fa fa-users"></i> Pengguna</a></li>
								<li><a href="<?= site_url('setting/log'); ?>"><i class="fa fa-tasks"></i> Log Aktifitas</a></li>
								<li><a href="<?= site_url('setting/backup'); ?>"><i class="fa fa-database"></i> Backup Database</a></li>
              </ul>
						</li>
            <li><a href="<?= site_url('logout'); ?>"><i class="fa fa-sign-out"></i> Keluar</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
						<!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= base_url('asset/dist/img/avatar5.png'); ?>" class="user-image" alt="User Image">
                <span class="hidden-xs">&nbsp;</span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="<?= base_url('asset/dist/img/avatar5.png'); ?>" class="img-circle" alt="User Image">
								  <p>
                    SIDA KALIBRASI
                    <small>Versi Lite 1.0 2017</small>
                  </p>
                </li>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?= site_url('setting/password/updated/'.$this->session->userdata('userID')); ?>" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Ganti Password</a>
                  </div>
									<div class="pull-right">
                    <a href="<?= site_url('logout') ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Log Out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>SIDA KALIBRASI<small>LITE 1.0</small></h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <?= isset($content) ? $this->load->view($content) : ''; ?>
      </section>
      <!-- /.content -->
    </div>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> Lite 1.0
      </div>
      <strong>Copyright &copy; 2017 <a href="#">BPSDM Provinsi Kalimantan Selatan</a>.</strong> All rights
      reserved.
    </div>
  </footer>
</div>
<!-- ./wrapper -->
<script src="<?= base_url('asset/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
<script src="<?= base_url('asset/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/fastclick/fastclick.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/jquery.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datatables/extensions/Responsive/js/responsive.bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/js-xlsx/xlsx.core.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/Blob.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/FileSaver.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/dist/js/tableexport.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/input-mask/jquery.inputmask.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/input-mask/jquery.inputmask.date.extensions.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/select2/select2.full.min.js'); ?>"></script>
<script src="<?= base_url('asset/app.js'); ?>"></script>
<?= isset($js) ? $this->load->view($js) : ''; ?>

</body>
</html>
