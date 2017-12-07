<script>
$(function () {
	$('.select2').select2();
});

$("#proses").on('click', function(){
	var kategori = $("#kategori_id").val();
	var tahun = $("#tahun").val();
	if(kategori && tahun ){
		$.ajax({
				type: "POST",
				async: false,
				url : "<?php echo site_url('sarana/get_list')?>",
				data: {
				   'kategori': kategori,
				   'tahun': tahun,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function(msg){
					$('#list').html(msg);
				}
		});
	}else{
		alert('Silahkan pilih kategori ruang dan tahun terlebih dahulu');
	}
});

$('#modal-gambar').on('show.bs.modal', function (e) {
	var room = $(e.relatedTarget).attr('data-id');
	var url = "<?php echo base_url('filemanager/dialog.php?type=1&field_id=gambar&relative_url=3'); ?>";
	var newurl = url.replace('gambar','gambar'+room);
	var frame = '<iframe height="500" src="'+newurl+'" frameborder="0" style="overflow: scroll !important; overflow-x: hidden; overflow-y: scroll auto; min-width: 460px; width: 910px; "></iframe>';
    $(this).find('.frame').html(frame);
});
</script>