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
			<input type="hidden" name="jenis_idx" id="jenis_idx" value="<?= set_value('jenis_idx', $record->jenis_id) ?>" />
			
			<!-- box-body -->
			<div class="box-body">
				
				<div class="row">
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
						<div class="form-group <?php echo form_error('diklat') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Nama Diklat','diklat');
							$data = array('class'=>'form-control','name'=>'diklat','id'=>'diklat','type'=>'text','value'=>set_value('diklat', $record->diklat));
							echo form_input($data);
							echo form_error('diklat') ? form_error('diklat', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<?php if($detail): ?>
					<?php $x = 0; ?>
					<?php foreach($detail as $row): ?>
					<div class="col-md-12">
						<div class="field-wrapper">
							<div class="child">
							<div class="form-group <?php echo form_error('syarat') ? 'has-error' : null; ?>">
								<?php
									echo form_label('Syarat Diklat','syarat');
								?>
								<div class="input-group input-group">  
								  <?php
								  $data = array('class'=>'form-control','name'=>'syarat[]','id'=>'syarat','type'=>'text','value'=>set_value('syarat[]', $row->syarat));
								  echo form_input($data);
								  ?>
								  <?php if($x == 0): ?>
								  <div class="input-group-btn">
									<button class="btn btn-info btn-flat add-button" type="button"><i class="fa fa-plus"></i></button>
								  </div>
								  <?php else: ?>
								  <div class="input-group-btn">
									<button class="btn btn-danger btn-flat remove-button" type="button"><i class="fa fa-minus"></i></button>
								  </div>
								  <?php endif; ?>
								</div>
								<?php
								  echo form_error('syarat') ? form_error('syarat', '<p class="help-block">','</p>') : '';
								?>
							</div>
							</div>
						</div>
					</div>
					<?php $x++; ?>
					<?php endforeach; ?>
					<?php endif; ?>
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