<div class="row">
	<div class="col-md-12">
    <?php if($this->session->flashdata('flashconfirm')): ?>
		<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <i class="icon fa fa-check"></i> Sukses! <?php echo $this->session->flashdata('flashconfirm'); ?>.
		</div>
		<?php endif; ?>
		<?php if($this->session->flashdata('flasherror')): ?>
		<div class="alert alert-danger alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <i class="icon fa fa-info"></i> Perhatian! <?php echo $this->session->flashdata('flasherror'); ?>.
		</div>
		<?php endif; ?>
		<div class="box box-success box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?= isset($head) ? $head : ''; ?></h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<form id="formID" role="form" action="<?= site_url('home/registrasi/register'); ?>" method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<!-- box-body -->
			<div class="box-body">
				<div class="row">
                    <div class="col-md-12">
						<div class="form-group <?php echo form_error('nip') ? 'has-error' : null; ?>">
							<?php
							echo form_label('NIP','nip');
							$data = array('class'=>'form-control','name'=>'nip','id'=>'nip','type'=>'text','value'=>set_value('nip'));
							echo form_input($data);
							echo form_error('nip') ? form_error('nip', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>    
                    <div class="col-md-12">
						<div class="form-group <?php echo form_error('fullname') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Nama Lengkap','fullname');
							$data = array('class'=>'form-control','name'=>'fullname','id'=>'fullname','type'=>'text','value'=>set_value('fullname'));
							echo form_input($data);
							echo form_error('fullname') ? form_error('fullname', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('email') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Email','email');
							$data = array('class'=>'form-control','name'=>'email','id'=>'email','type'=>'email','value'=>set_value('email'));
							echo form_input($data);
							echo form_error('email') ? form_error('email', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('password') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Password','password');
							$data = array('class'=>'form-control','name'=>'password','id'=>'password','type'=>'password','value'=>set_value('password'));
							echo form_input($data);
							echo form_error('password') ? form_error('password', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('repassword') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Ulangi Password','repassword');
							$data = array('class'=>'form-control','name'=>'repassword','id'=>'repassword','type'=>'password','value'=>set_value('repassword'));
							echo form_input($data);
							echo form_error('repassword') ? form_error('repassword', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('telpon') ? 'has-error' : null; ?>">
							<?php
							echo form_label('Telpon','telpon');
							$data = array('class'=>'form-control','name'=>'telpon','id'=>'telpon','type'=>'text','value'=>set_value('telpon'));
							echo form_input($data);
							echo form_error('telpon') ? form_error('telpon', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group <?php echo form_error('pengelola') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('Wilayah Pengelola Kepegawaian','pengelola');
							$selected = set_value('pengelola');
							echo form_dropdown('pengelola', $pengelola, $selected, "class='form-control select2' name='pengelola' id='pengelola'");
							echo form_error('pengelola') ? form_error('pengelola', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
				</div>
			</div>
			<!-- ./box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-sm btn-flat btn-success"><i class="fa fa-save"></i> Daftar</button>
				<button type="reset" class="btn btn-sm btn-flat btn-warning"><i class="fa fa-refresh"></i> Reset</button>
			</div>
			</form>
		</div>
	</div>
</div>