<div class="row">
	<div class="col-md-12">
		<div class="box box-danger box-solid">
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
				<div id="message"></div>
				<div class="row">
					<div class="col-md-4">
							<div class="form-group <?php echo form_error('kategori_id') ? 'has-error' : null; ?>">
								<?php 
								echo form_label('Kategori Ruang','kategori_id');
								$selected = set_value('kategori_id', $record->kategori_id);
								$status = array(''=>'Pilih Salah Satu','1'=>'Ruang Pembelajaran Umum','2'=>'Ruang Pembelajaran Khusus','3'=>'Ruang Penunjang');
								echo form_dropdown('kategori_id', $status, $selected, "class='form-control select2' name='kategori_id' id='kategori_id'");
								echo form_error('kategori_id') ? form_error('kategori_id', '<p class="help-block">','</p>') : '';
								?>
							</div>
					</div>
					<div class="col-md-6">
							<div class="form-group <?php echo form_error('tahun') ? 'has-error' : null; ?>">
								<?php 
								echo form_label('Tahun','tahun');
								$selected = set_value('tahun', $record->tahun);
								$tahun = get_tahun('2016');
								echo form_dropdown('tahun', $tahun, $selected, "class='form-control select2' name='tahun' id='tahun'");
								echo form_error('tahun') ? form_error('tahun', '<p class="help-block">','</p>') : '';
								?>
							</div>
					</div>
					<div class="col-md-2">
						<div class="form-group <?php echo form_error('kategori_id') ? 'has-error' : null; ?>">
							<?php 
							echo form_label('&nbsp;');
							echo '<br><button class="btn btn-primary btn-block btn-flat btn-primary" id="proses" name="proses" type="button"><i class="fa fa-list-ul"></i> PROSES</button>';
							echo form_error('kategori_id') ? form_error('kategori_id', '<p class="help-block">','</p>') : '';
							?>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div id="list" name="list" class="list"></div>
				</div>
			</div>
			<!-- ./box-body -->
			<div class="box-footer">
				<button type="button" class="btn btn-sm btn-flat btn-info" onclick="saveout();"><i class="fa fa-save"></i> Simpan & Keluar</button>
				<button type="reset" class="btn btn-sm btn-flat btn-warning"><i class="fa fa-refresh"></i> Reset</button>
				<button type="button" class="btn btn-sm btn-flat btn-danger" onclick="back();"><i class="fa fa-close"></i> Keluar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<style type="text/css">
@media screen and (min-width: 460px) {
  #modal-gambar .modal-dialog  {width:940px;}
  #modal-tautan .modal-dialog  {width:940px;}
}
</style>
<div class="file-modal">
  <div class="modal fade" id="modal-gambar">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Pilih Gambar Sarana Prasarana</h4>
        </div>
        <div class="modal-body">
					<div class="frame">
          <iframe height="500" src="<?php echo base_url('filemanager/dialog.php?type=1&field_id=gambar&relative_url=3'); ?>" frameborder="0" style="overflow: scroll !important; overflow-x: hidden; overflow-y: scroll auto; min-width: 460px; width: 910px; "></iframe>
					</div>
				</div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</div><!-- /.example-modal -->