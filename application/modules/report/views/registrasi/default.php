<!DOCTYPE html>
<html lang="en">
	<head>
		<title>BPSDM KALIMANTAN SELATAN</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?= base_url('asset/dist/css/print_fullpage.css'); ?>" />
		<link rel="stylesheet" href="<?= base_url('asset/plugins/tableexport/dist/css/tableexport.min.css'); ?>">
  		<link rel="stylesheet" href="<?= base_url('asset/plugins/pace/themes/blue/pace-theme-loading-bar.css'); ?>" />
	</head>
<body>
<div class="book">
    <div class="page">
	<div class="title">
            <div class="logo"><img src="<?php echo base_url('asset/dist/img/kalsel-114.png'); ?>" width="36px"></div>
            <div class="judul"><h3>DAFTAR REGISTER DIKLAT<br>BADAN PENGEMBANGAN SUMBER DAYA MANUSIA<br>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h3></div>
    </div>
	<!-- identitas -->
	<div class="pencarian" id="pencarian">
	<?php 
	$selected = set_value('pengelola_id');
	echo form_dropdown('pengelola_id', $pengelola, $selected, "class='form-control select2' name='pengelola_id' id='pengelola_id'");
	?>

	<?php 
	$selected = set_value('eselon_id');
	echo form_dropdown('eselon_id', $eselon, $selected, "class='form-control select2' name='eselon_id' id='eselon_id'");
	?>

	<?php 
	$selected = set_value('pangkat_id');
	echo form_dropdown('pangkat_id', $pangkat, $selected, "class='form-control select2' name='pangkat_id' id='pangkat_id'");
	?>

	<?php 
	$selected = set_value('ktpu_id');
	echo form_dropdown('ktpu_id', $ktpu, $selected, "class='form-control select2' name='ktpu_id' id='ktpu_id'");
	?>
	<button name="filter" id="filter">Cari</button> <button name="reset" id="reset" class="filter">Reset</button>
	<br>
	<br>
	</div>
	<div class="tabel" id="tabel">
	<table class="print" id="tableID">
		<thead>
		<tr>
			<th width="6px;">NO</th>
			<th>NIP</th>
			<th>Nama Lengkap</th>
			<th>Instansi</th>
			<th>Unit Kerja</th>
			<th>Satuan Kerja</th>
			<th>Jabatan</th>
			<th>Tingkat</th>
			<th>Gol</th>
			<th>Pendidikan</th>
		</tr>
		</thead>
		<tbody>
		<?php if($record): ?>
			<?php $i = 1; ?>
			<?php foreach($record as $row): ?>
			<tr>
			<td><?php echo number_format($i).'.'; ?></td>
			<td class="text" nowrap><?php echo $row->nip; ?></td>
			<td class="text"><?php echo $row->fullname; ?></td>
			<td class="text"><?php echo $row->instansi ? $row->instansi : '-'; ?></td>
			<td class="text"><?php echo $row->unker ? $row->unker : '-' ; ?></td>
			<td class="text"><?php echo $row->satker ? $row->satker : '-'; ?></td>
			<td class="text"><?php echo $row->jabatan ? $row->jabatan : '-'; ?></td>
			<td class="text"><?php echo eselon($row->eselon_id); ?></td>
			<td class="text"><?php echo gol($row->pangkat_id); ?></td>
			<td class="text"><?php echo ktpu($row->ktpu_id); ?></td>
			</tr>
			<?php ++$i; ?>
			<?php endforeach; ?>
		<?php endif; ?>
		</tbody>
	</table>
</div>
</div>
</div>
<script src="<?= base_url('asset/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/jquery.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/js-xlsx/xlsx.core.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/Blob.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/FileSaver.min.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/tableexport/dist/js/tableexport.js'); ?>"></script>
<script src="<?= base_url('asset/plugins/pace/pace.min.js'); ?>"></script>
<script type="text/javascript">
$("#filter").on('click', function(){
	var pengelola = $("#pengelola_id").val();
	var eselon = $("#eselon_id").val();
	var pangkat = $("#pangkat_id").val();
	var pendidikan = $("#ktpu_id").val();
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('report/registrasi/get_filter')?>",
				data: {
				   'pengelola': pengelola,
				   'eselon': eselon,
				   'pangkat': pangkat,
				   'pendidikan': pendidikan,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(msg){
					$('#tabel').html(msg);
				}
		});
});

$("#reset").on('click', function(){
	location.reload();
});
</script>
</body>
</html>