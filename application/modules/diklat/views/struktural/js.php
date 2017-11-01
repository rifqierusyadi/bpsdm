<script>
$(function (){
	$('.select2').select2();
});

$("#jenis_id").change(function(){
    var jenis_id = $("#jenis_id").val();
    if(jenis_id){
        $.ajax({
            type: "POST",
            async: false,
            url : "<?php echo site_url('diklat/struktural/get_jenjang')?>",
            data: {
            'jenis_id': jenis_id,
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function(msg){
            $('#jenjang_id').html(msg);
            }
        });
    }
});

$("#jenjang_id").change(function(){
    var jenis_id = $("#jenis_id").val();
    var jenjang_id = $("#jenjang_id").val();
    //alert(jenjang_id)
    if(jenjang_id){
        $.ajax({
            type: "POST",
            async: false,
            url : "<?php echo site_url('diklat/struktural/get_diklat')?>",
            data: {
            'jenis_id': jenis_id,
            'jenjang_id': jenjang_id,
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function(msg){
            $('#diklat_id').html(msg);
            }
        });
    }
});

$("#diklat_id").change(function(){
	var diklat_id = $('#diklat_id').val();
    $.ajax({
		type: "POST",
		async: false,
		url : "<?php echo site_url('diklat/struktural/get_syarat'); ?>",
		data: {
		'diklat_id': diklat_id,
		'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
		},
		success: function(msg){
			$('#persyaratan').html(msg);
		}
	});
});

// function savecheck(){
//     var cek = $('input:checkbox:not(":checked")').length;
//     alert(cek);
// }
</script>