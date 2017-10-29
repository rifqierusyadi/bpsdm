<span id="key" style="display: none;"><?= $this->security->get_csrf_hash(); ?></span>
<div class="row">
	<div class="col-md-3">
		<!-- Profile Image -->
		  
        <div class="box box-primary">
        <div class="box-body box-profile">
			  <a href="#" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-user"></i> Perbaharui Data</a>
			  <a href="#" class="btn btn-info btn-flat btn-sm"><i class="fa fa-image"></i> Upload Photo&nbsp;&nbsp;&nbsp;&nbsp;</a>
			  <br><br>
              <img class="profile-user-img img-responsive img-circle" src="<?= base_url('asset/dist/img/avatar5.png'); ?>" alt="User profile picture">
              <h3 class="profile-username text-center"><?= biodata($id) ? biodata($id)['nama'] : '-'; ?></h3>
              <p class="text-muted text-center">
							<?= biodata($id) ? biodata($id)['nip'] : '-'; ?><br>
							<?= biodata($id) ? biodata($id)['tmlahir'] : '-'; ?>, <?= biodata($id) ? ddmmyyyy(biodata($id)['tglahir']) : '-'; ?>
			  </p>
			  <hr>
			  <strong><i class="fa fa-tag margin-r-5"></i> PANGKAT</strong>
				<p class="text-muted">
				<?= biodata($id) ? biodata($id)['pangkat_id'] : '-'; ?>
				</p>
			  <hr>
			  <strong><i class="fa fa-bank margin-r-5"></i> JABATAN</strong>
				<p class="text-muted">
				<?= biodata($id) ? biodata($id)['jabatan'] : '-'; ?>
				</p>
			  <hr>
			  <strong><i class="fa fa-graduation-cap margin-r-5"></i> PENDIDIKAN</strong>
				<p class="text-muted">
				<?= biodata($id) ? biodata($id)['ktpu_id'] : '-'; ?>
				</p>
			  <hr>
			  <strong><i class="fa fa-map-marker margin-r-5"></i> KONTAK</strong>
				<p class="text-muted">
				<?= biodata($id) ? biodata($id)['alamat'] : '-'; ?> <br> <?= biodata($id) ? biodata($id)['telpon'] : '-'; ?>
				</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	</div>
	
	<div class="col-md-9">
		<?php if($this->session->flashdata('flashconfirm')): ?>
		<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <i class="icon fa fa-check"></i> Sukses! <?php echo $this->session->flashdata('flashconfirm'); ?>.
		</div>
		<?php endif; ?>
		<?php if($this->session->flashdata('flasherror')): ?>
		<div class="alert alert-info alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <i class="icon fa fa-info"></i> Perhatian! <?php echo $this->session->flashdata('flasherror'); ?>.
		</div>
		<?php endif; ?>
		<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">REGISTRASI DIKLAT</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
								<div class="col-md-4">
									<div class="small-box bg-aqua">
										<div class="inner">
											<h3>DIKLAT</h3>
											<p>STRUKTURAL</p>
										</div>
										<div class="icon">
											<i class="ion ion-ios-book-outline"></i>
										</div>
									<a href="<?= site_url('struktural'); ?>" class="small-box-footer">Daftar Diklat <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>

								<div class="col-md-4">
									<div class="small-box bg-yellow">
										<div class="inner">
											<h3>DIKLAT</h3>
											<p>FUNGSIONAL</p>
										</div>
										<div class="icon">
											<i class="ion ion-ios-book-outline"></i>
										</div>
									<a href="<?= site_url('fungsional'); ?>" class="small-box-footer">Daftar Diklat <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>

								<div class="col-md-4">
									<div class="small-box bg-green">
										<div class="inner">
											<h3>DIKLAT</h3>
											<p>TEKNIS</p>
										</div>
										<div class="icon">
											<i class="ion ion-ios-book-outline"></i>
										</div>
									<a href="<?= site_url('teknis'); ?>" class="small-box-footer">Daftar Diklat <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>
						</div>
		</div>
		
		<!-- Custom Tabs -->
        <!-- nav-tabs-custom -->
	</div>
</div>