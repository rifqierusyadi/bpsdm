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
						<div class="user-block">
						<img class="img-circle img-bordered-sm" src="<?= base_url('asset/dist/img/avatar5.png'); ?>" alt="user image">
						  <span class="username">
							<a href="#"><?= identitas($this->session->userdata('userID'))->nama; ?></a>
						  </span>
						<span class="description"><?= identitas($this->session->userdata('userID'))->nip; ?></span>
						</div>
					<br>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('jenis_id') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Jenis Jabatan','jenis_id');
							$selected = set_value('jenis_id', $record->jenis_id);
							echo form_dropdown('jenis_id', $jenis, $selected, "class='form-control select2' name='jenis_id' id='jenis_id'");
							echo form_error('jenis_id') ? form_error('jenis_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('jenjang_id') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Jenjang Jabatan','jenjang_id');
							echo form_dropdown('jenjang_id', array(''=>'Pilih Jenjang Jabatan'), '', "class='form-control select2' name='jenjang_id' id='jenjang_id'");
							echo form_error('jenjang_id') ? form_error('jenjang_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('diklat_id') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Jenis Diklat','diklat_id');
							echo form_dropdown('diklat_id', array(''=>'Pilih Diklat Jabatan'), '', "class='form-control select2' name='diklat_id' id='diklat_id'");
							echo form_error('diklat_id') ? form_error('diklat_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('periode') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Periode Diklat','periode');
							$selected = set_value('periode', $record->periode);
							echo form_dropdown('periode', $periode, $selected, "class='form-control select2' name='periode' id='periode'");
							echo form_error('periode') ? form_error('periode', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('penyelenggara') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Lokasi Penyelengara','penyelenggara');
							$data = array('class'=>'form-control','name'=>'penyelenggara','id'=>'penyelenggara','type'=>'text','value'=>set_value('penyelenggara', $record->penyelenggara));
							echo form_input($data);
							echo form_error('penyelenggara') ? form_error('penyelenggara', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div id="persyaratan"></div>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
			<div class="box-footer">
				<button type="button" class="btn btn-sm btn-flat btn-success" onclick="savecheck()"><i class="fa fa-save"></i> Simpan</button>
				<button type="button" class="btn btn-sm btn-flat btn-info" onclick="savecheckout();"><i class="fa fa-save"></i> Simpan & Keluar</button>
				<button type="reset" class="btn btn-sm btn-flat btn-warning"><i class="fa fa-refresh"></i> Reset</button>
				<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="back();"><i class="fa fa-close"></i> Keluar</button>
			</div>
			</form>
		</div>
	</div>
</div>