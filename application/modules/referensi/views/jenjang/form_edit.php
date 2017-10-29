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
			<input type="hidden" name="kategori_idx" id="kategori_idx" value="<?= set_value('kategori_idx', $record->kategori_id); ?>" />
			
			<!-- box-body -->
			<div class="box-body">
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('kategori_id') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Kategori Jabatan','kategori_id');
							$selected = set_value('kategori_id', $record->kategori_id);
							$kategori = array(''=>'Pilih Salah Satu', '1'=>'Struktural','2'=>'Fungsional');
							echo form_dropdown('kategori_id', $kategori, $selected, "class='form-control select2' name='kategori_id' id='kategori_id'");
							echo form_error('kategori_id') ? form_error('eselon_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('jenis_id') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Jenis Jabatan','jenis_id');
							echo form_dropdown('jenis_id', array(''=>'Pilih Jenis Jabatan'), '', "class='form-control select2' name='jenis_id' id='jenis_id'");
							echo form_error('jenis_id') ? form_error('jenis_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
					<div class="form-group <?php echo form_error('jenjang') ? 'has-error' : null; ?>">
						<?php
						echo form_label('Jenjang Jabatan','jenjang');
						$data = array('class'=>'form-control','name'=>'jenjang','id'=>'jenjang','type'=>'text','value'=>set_value('jenjang', $record->jenjang));
						echo form_input($data);
						echo form_error('jenjang') ? form_error('jenjang', '<p class="help-block">','</p>') : '';
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