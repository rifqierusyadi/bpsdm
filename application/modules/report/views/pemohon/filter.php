<?php if($record): ?>
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
<?php else: ?>
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
		<tr>
			<td colspan="11">Data Tidak Ditemukan</td>
		</tr>
		</tbody>
	</table>
<?php endif; ?>