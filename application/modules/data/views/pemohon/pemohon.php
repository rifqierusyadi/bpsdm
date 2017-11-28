<div class="box-body box-profile">
	<img class="profile-user-img img-responsive img-circle" src="<?= base_url('asset/dist/img/avatar5.png'); ?>" alt="User profile picture">

	<h3 class="profile-username text-center"><?= $record->nama; ?></h3>

	<p class="text-muted text-center"><?= $record->nip; ?></p>

	<div class="row">
		<div class="col-md-6">
		<dl class="dl-horizontal">
			<dt>Instansi</dt>
			<dd><?= $record->instansi; ?></dd>
			<dt>Unit Kerja</dt>
			<dd><?= $record->unker; ?></dd>
			<dt>Satuan Kerja</dt>
			<dd><?= $record->satker; ?></dd>
			<dt>Jabatan</dt>
			<dd><?= $record->jabatan; ?></dd>
			<dt>Tingkat Jabatan</dt>
			<dd><?= eselon($record->eselon_id); ?></dd>
			<dt>Pangkat</dt>
			<dd><?= gol($record->pangkat_id); ?></dd>
			<dt>Pendidikan Akhir</dt>
			<dd><?= ktpu($record->ktpu_id); ?></dd>
			<dt>Jurusan</dt>
			<dd><?= $record->jurusan; ?></dd>
		</dl>
		</div>
		<div class="col-md-6">
		<dl class="dl-horizontal">
			<dt>Kategori Diklat</dt>
			<dd><?= kategori($record->kategori_id); ?></dd>
			<dt>Jenis Diklat</dt>
			<dd><?= jenis($record->jenis_id); ?></dd>
			<dt>Jenjang Diklat</dt>
			<dd><?= jenjang($record->jenjang_id); ?></dd>
			<dt>Diklat Yang Di Inginkan</dt>
			<dd><?= diklat($record->diklat_id); ?></dd>
			<dt>Periode Diklat</dt>
			<dd><?= $record->periode; ?></dd>
			<dt>Penyelenggara</dt>
			<dd><?= $record->penyelenggara; ?></dd>
			<dt>Syarat</dt>
			<dd><?= $record->syarat ? 'Terpenuhi' : 'Tidak Tepenuhi'; ?></dd>
			<dt>Pengelola Kepegawaian</dt>
			<dd><?= kepegawaian($record->pengelola_id); ?></dd>
		</dl>
		</div>
	</div>
	<div class="row">
	<form id="form" role="form" action="" method="post">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		<input type="hidden" name="id" value="<?= $record->id; ?>" />
		<input type="hidden" name="userid" value="<?= $record->user_id; ?>" />
		<div class="col-md-12">
		<div class="form-group <?php echo form_error('keterangan') ? 'has-error' : null; ?>">
			<?php
			echo form_label('Keterangan','keterangan');
			?>
			<textarea class='form-control' name='keterangan' id='keterangan'><?= set_value('keterangan'); ?></textarea>
			<?
			echo form_error('keterangan') ? form_error('keterangan', '<p class="help-block">','</p>') : '';
			?>
		</div>
		</div>
	</form>
	</div>

	<div class="row">
		<div class="col-md-6">
		<a href="" class="btn btn-success btn-block" onclick="setuju(<?= $record->id; ?>)"><b>Setujui</b></a>
		</div>
		<div class="col-md-6">
		<a href="" class="btn btn-danger btn-block" onclick="tolak(<?= $record->id; ?>)"><b>Tolak</b></a>
		</div>
	</div>
</div>
<!-- ./box-body -->
