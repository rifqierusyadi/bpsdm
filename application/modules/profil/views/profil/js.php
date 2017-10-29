<script>
$(function () {
    $('.select2').select2();
	
	$('#tglahir').datepicker({
		format:'dd-mm-yyyy'
 	});
	
	$('#tglahir').inputmask('dd-mm-yyyy');
});
</script>