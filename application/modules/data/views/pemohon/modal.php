<div class="box-body box-profile">
	<img class="profile-user-img img-responsive img-circle" src="<?= base_url('asset/dist/img/avatar5.png'); ?>" alt="User profile picture">

	<h3 class="profile-username text-center"><?= $record->nama; ?></h3>

	<p class="text-muted text-center"><?= $record->nip; ?></p>

	<ul class="list-group list-group-unbordered">
		<li class="list-group-item">
			<b>TEMPAT LAHIR</b> <a class="pull-right"><?= $record->tmlahir; ?></a>
		</li>
		<li class="list-group-item">
			<b>TANGGAL LAHIR</b> <a class="pull-right"><?= $record->tglahir; ?></a>
		</li>
		<li class="list-group-item">
			<b>JENIS KELAMIN</b> <a class="pull-right"><?= sex($record->sex); ?></a>
		</li>
		<li class="list-group-item">
			<b>AGAMA</b> <a class="pull-right"><?= agama($record->agama_id); ?></a>
		</li>
		<li class="list-group-item">
			<b>ALAMAT DOMISILI</b> <a class="pull-right"><?= $record->alamat; ?></a>
		</li>
		<li class="list-group-item">
			<b>TELPON/HP</b> <a class="pull-right"><?= $record->telpon; ?></a>
		</li>
		<li class="list-group-item">
			<b>INSTANSI</b> <a class="pull-right"><?= $record->instansi; ?></a>
		</li>
		<li class="list-group-item">
			<b>UNIT KERJA</b> <a class="pull-right"><?= $record->unker; ?></a>
		</li>
		<li class="list-group-item">
			<b>SATUAN KERJA</b> <a class="pull-right"><?= $record->satker; ?></a>
		</li>
		<li class="list-group-item">
			<b>PANGKAT</b> <a class="pull-right"><?= gol($record->pangkat_id); ?></a>
		</li>
		<li class="list-group-item">
			<b>JABATAN</b> <a class="pull-right"><?= $record->jabatan; ?></a>
		</li>
		<li class="list-group-item">
			<b>TINGKAT JABATAN</b> <a class="pull-right"><?= eselon($record->eselon_id); ?></a>
		</li>
		<li class="list-group-item">
			<b>PENDIDIKAN AKHIR</b> <a class="pull-right"><?= ktpu($record->ktpu_id); ?></a>
		</li>
		<li class="list-group-item">
			<b>JURUSAN</b> <a class="pull-right"><?= $record->jurusan; ?></a>
		</li>
	</ul>

	<a href="#" class="btn btn-primary btn-block"><b>Verifikasi</b></a>
</div>
<!-- ./box-body -->
