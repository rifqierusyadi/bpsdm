<?php if($record): ?>
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
<?php else: ?>
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
	<tr>
		<td colspan="10">Data Tidak Ditemukan</td>
	</tr>
</tbody>
</table>
<?php endif; ?>