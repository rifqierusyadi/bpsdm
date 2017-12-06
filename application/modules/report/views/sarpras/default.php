<!DOCTYPE html>
<html lang="en">
	<head>
		<title>LAPORAN SARANA DAN PRASARANA</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?= base_url('asset/dist/css/print_fullpage.css'); ?>" />
		<link rel="stylesheet" href="<?= base_url('asset/plugins/tableexport/dist/css/tableexport.min.css'); ?>">
  		<link rel="stylesheet" href="<?= base_url('asset/plugins/pace/themes/blue/pace-theme-loading-bar.css'); ?>" />
	</head>
<body onload="window.print();">
<div class="book">
    <div class="page">
	<div class="title">
            <div class="logo"><img src="<?php echo base_url('asset/dist/img/kalsel-114.png'); ?>" width="36px"></div>
            <div class="judul"><h3><?= $head; ?><br><?= kategori($record->kategori_id); ?><br><?= sekolah($record->users_id); ?><br>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h3></div>
    </div>
	<!-- identitas -->
	<div class="tabel">
	<table class="print" id="tableID">
		<thead>
		<tr>
			<th width="6px;">NO</th>
			<th>RUANG</th>
			<th>JENIS</th>
			<th width="40px;">RASIO</th>
			<th>DESKRIPSI</th>
			<th width="40px">TAHUN</th>
		</tr>
		</thead>
		<tbody>
		<?php if($list): ?>
			<?php $i = 1; ?>
			<?php foreach($list as $row): ?>
			<tr>
			<td><?php echo number_format($i).'.'; ?></td>
			<td class="text"><?php echo ruang($row->ruang_id); ?></td>
			<td class="text"><?php echo $row->jenis; ?></td>
			<td class="text right"><?php echo $row->rasio; ?></td>
			<td class="text"><?php echo $row->deskripsi; ?></td>
			<td class="text center"><?php echo $row->tahun; ?></td>
			</tr>
			<?php ++$i; ?>
			<?php endforeach; ?>
		<?php endif; ?>
		</tbody>
	</table>
</div>
	<div class="break"></div>
		<h3>Lampiran Gambar</h3>
		<table class="print" id="tableID">
		<thead>
		<tr>
			<th width="6px;">NO</th>
			<th>RUANG</th>
			<th>JENIS</th>
			<th>GAMBAR</th>
		</tr>
		</thead>
		<tbody>
		<?php if($list): ?>
			<?php $i = 1; ?>
			<?php foreach($list as $row): ?>
			<tr>
			<td><?php echo number_format($i).'.'; ?></td>
			<td class="text"><?php echo ruang($row->ruang_id); ?></td>
			<td class="text"><?php echo $row->jenis; ?></td>
			<td class="text center"><img src="<?= $row->gambar; ?>" width="200px" height="200px" style="border: 1px solid #000;"></td>
			</tr>
			<?php ++$i; ?>
			<?php endforeach; ?>
		<?php endif; ?>
		</tbody>
	</table>
	<p><?php //echo '<img src="'.site_url('report/pangkat/barcode/0123456789').'">'; ?></p>
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
// $(function () {
// e = $("#tableID").tableExport({
//         bootstrap: true,
//         formats: ["xlsx"],
//         position: "top",
//         fileName: "DAFTAR NOMINATIF PANGKAT-<?php echo $head; ?>",
//     });
// });
</script>
</body>
</html>