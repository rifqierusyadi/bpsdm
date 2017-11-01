<div class="row">
	<div class="col-md-12">
		<div id="message"></div>
		<div class="box box-primary box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?= isset($head) ? $head : ''; ?></h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<form id="formID" role="form" action="" method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('nip') ? 'has-error' : null; ?>">
							<?php
							echo form_label('NIP','nip');
							$data = array('class'=>'form-control','name'=>'nip','id'=>'nip','type'=>'text','value'=>set_value('nip', $record->nip));
							echo form_input($data);
							echo form_error('nip') ? form_error('nip', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('nama') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Nama Lengkap','nama');
							$data = array('class'=>'form-control','name'=>'nama','id'=>'nama','type'=>'text','value'=>set_value('nama', $record->nama));
							echo form_input($data);
							echo form_error('nama') ? form_error('nama', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('tmlahir') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Tempat Lahir','tmlahir');
							$data = array('class'=>'form-control','name'=>'tmlahir','id'=>'tmlahir','type'=>'text','value'=>set_value('tmlahir', $record->tmlahir));
							echo form_input($data);
							echo form_error('tmlahir') ? form_error('tmlahir', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('tglahir') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Tanggal Lahir','tglahir');
							$data = array('class'=>'form-control','name'=>'tglahir','id'=>'tglahir','type'=>'text','value'=>set_value('tglahir', ddmmyyyy($record->tglahir)));
							echo form_input($data);
							echo form_error('tglahir') ? form_error('tglahir', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('sex') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Jenis Kelamin','sex');
							$selected = set_value('sex', $record->sex);
							$sex = array(''=>'Pilih Jenis Kelamin','1'=>'LAKI-LAKI','2'=>'PEREMPUAN');
							echo form_dropdown('sex', $sex, $selected, "class='form-control select2' name='sex' id='sex'");
							echo form_error('sex') ? form_error('sex', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('alamat') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Alamat Domisili','alamat');
							$data = array('class'=>'form-control','name'=>'alamat','id'=>'alamat','type'=>'alamat','value'=>set_value('alamat', $record->alamat));
							echo form_input($data);
							echo form_error('alamat') ? form_error('alamat', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('telpon') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Telpon','telpon');
							$data = array('class'=>'form-control','name'=>'telpon','id'=>'telpon','type'=>'telpon','value'=>set_value('telpon', $record->telpon));
							echo form_input($data);
							echo form_error('telpon') ? form_error('telpon', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('instansi') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Instansi Pemerintah','instansi');
							$data = array('class'=>'form-control','name'=>'instansi','id'=>'instansi','type'=>'text','value'=>set_value('instansi', $record->instansi));
							echo form_input($data);
							echo form_error('instansi') ? form_error('instansi', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('unker') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Unit Kerja','unker');
							$data = array('class'=>'form-control','name'=>'unker','id'=>'unker','type'=>'text','value'=>set_value('unker', $record->unker));
							echo form_input($data);
							echo form_error('unker') ? form_error('unker', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('satker') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Satuan Kerja','satker');
							$data = array('class'=>'form-control','name'=>'satker','id'=>'satker','type'=>'text','value'=>set_value('satker', $record->satker));
							echo form_input($data);
							echo form_error('satker') ? form_error('satker', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('jenis_id') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Kategori Jabatan','jenis_id');
							$selected = set_value('jenis_id', $record->jenis_id);
							$jenis = array(''=>'Pilih Salah Satu','1'=>'STRUKTURAL','2'=>'FUNGSIONAL');
							echo form_dropdown('jenis_id', $jenis, $selected, "class='form-control select2' name='jenis_id' id='jenis_id'");
							echo form_error('jenis_id') ? form_error('jenis_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('jabatan') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Jabatan','jabatan');
							$data = array('class'=>'form-control','name'=>'jabatan','id'=>'jabatan','type'=>'text','value'=>set_value('jabatan', $record->jabatan));
							echo form_input($data);
							echo form_error('jabatan') ? form_error('jabatan', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('eselon_id') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Tingkat Jabatan','eselon_id');
							$selected = set_value('eselon_id', $record->eselon_id);
							echo form_dropdown('eselon_id', $eselon, $selected, "class='form-control select2' name='eselon_id' id='eselon_id'");
							echo form_error('eselon_id') ? form_error('eselon_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('pangkat_id') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Golongan Pangkat','pangkat_id');
							$selected = set_value('pangkat_id', $record->pangkat_id);
							echo form_dropdown('pangkat_id', $pangkat, $selected, "class='form-control select2' name='pangkat_id' id='pangkat_id'");
							echo form_error('pangkat_id') ? form_error('pangkat_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('ktpu_id') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Tingkat Pendidikan Akhir','ktpu_id');
							$selected = set_value('ktpu_id', $record->ktpu_id);
							echo form_dropdown('ktpu_id', $ktpu, $selected, "class='form-control select2' name='ktpu_id' id='ktpu_id'");
							echo form_error('ktpu_id') ? form_error('ktpu_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('jurusan') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Jurusan','jurusan');
							$data = array('class'=>'form-control','name'=>'jurusan','id'=>'jurusan','type'=>'text','value'=>set_value('jurusan', $record->jurusan));
							echo form_input($data);
							echo form_error('jurusan') ? form_error('jurusan', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
			<div class="box-footer">
				<button type="button" class="btn btn-sm btn-flat btn-success" onclick="save()"><i class="fa fa-save"></i> Simpan</button>
				<button type="button" class="btn btn-sm btn-flat btn-info" onclick="saveout();"><i class="fa fa-save"></i> Simpan & Keluar</button>
				<button type="reset" class="btn btn-sm btn-flat btn-warning"><i class="fa fa-refresh"></i> Reset</button>
				<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="back();"><i class="fa fa-close"></i> Keluar</button>
			</div>
			</form>
		</div>
	</div>
</div>