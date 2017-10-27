<div class="row">
	<div class="col-md-12">
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
				<h3 class="box-title"><?= isset($head) ? $head : ''; ?></h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-3">
					<div class="small-box bg-green">
						<div class="inner">
							<h3>&nbsp;</h3>
							<p>Data Registrasi</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-stalker"></i>
						</div>
						<a href="#" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
					</div>
					</div>
					<div class="col-md-3">
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3>&nbsp;</h3>
							<p>Pendaftaran Diklat</p>
						</div>
						<div class="icon">
							<i class="ion ion-ios-list-outline"></i>
						</div>
						<a href="#" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
					</div>
					</div>
					<div class="col-md-3">
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3>&nbsp;</h3>
							<p>Informasi</p>
						</div>
						<div class="icon">
							<i class="ion ion-ios-paper"></i>
						</div>
						<a href="#" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
					</div>
					</div>
					<div class="col-md-3">
					<div class="small-box bg-red">
						<div class="inner">
							<h3>&nbsp;</h3>
							<p>Tanya Jawab</p>
						</div>
						<div class="icon">
							<i class="ion ion-android-mail"></i>
						</div>
						<a href="#" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
					</div>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
			
			<div class="box-footer">
				<div class="row">
					<div class="col-md-12">

					</div>
				</div>
			</div>
		</div>
	</div>
</div>