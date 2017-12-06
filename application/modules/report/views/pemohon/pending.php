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
            <div class="judul"><h3>DAFTAR PEMOHON DIKLAT YANG BELUM DI PROSES/DITOLAK<br>BADAN PENGEMBANGAN SUMBER DAYA MANUSIA<br>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h3></div>
    </div>
	<!-- identitas -->
	<div class="tabel">
	<table class="print" id="tableID">
		<thead>
		<tr>
			<th width="6px;">NO</th>
			<th>Kode</th>
			<th>NIP</th>
			<th>Nama Lengkap</th>
			<th>Instansi</th>
			<th>Unit Kerja</th>
			<th>Satuan Kerja</th>
			<th>Diklat</th>
			<th>Jenjang</th>
			<th>Periode</th>
			<th>Keterangan</th>
		</tr>
		</thead>
		<tbody>
		<?php if($record): ?>
			<?php $i = 1; ?>
			<?php foreach($record as $row): ?>
			<tr>
			<td><?php echo number_format($i).'.'; ?></td>
			<td class="text" nowrap><?php echo $row->kode; ?></td>
			<td class="text" nowrap><?php echo $row->nip; ?></td>
			<td class="text"><?php echo $row->nama; ?></td>
			<td class="text"><?php echo $row->instansi; ?></td>
			<td class="text"><?php echo $row->unker; ?></td>
			<td class="text"><?php echo $row->satker; ?></td>
			<td class="text"><?php echo kategori($row->kategori_id); ?></td>
			<td class="text"><?php echo jenjang($row->jenjang_id); ?></td>
			<td class="text"><?php echo $row->periode; ?></td>
			<td class="text"><?php echo $row->keterangan ? $row->keterangan : '-'; ?></td>
			</tr>
			<?php ++$i; ?>
			<?php endforeach; ?>
		<?php endif; ?>
		</tbody>
	</table>
</div>
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