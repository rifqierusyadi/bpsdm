<script>
$(function () {
	$('.select2').select2();
});

$(document).on('click', '#getUser', function(e){
		e.preventDefault();
		var uid = $(this).data('id'); // get id of clicked row
		$('#dynamic-content').html(''); // leave this div blank
		$('#modal-loader').show();      // load ajax loader on button click
	
		$.ajax({
			url: '<?php echo site_url('data/pemohon/get_profile'); ?>',
			type: 'POST',
			data: {
				   'nip': uid,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			dataType: 'html'
		})
		.done(function(data){
			console.log(data); 
			$('#dynamic-content').html(''); // blank before load.
			$('#dynamic-content').html(data); // load here
			$('#modal-loader').hide(); // hide loader  
		})
		.fail(function(){
			$('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
});

$(document).on('click', '#getDiklat', function(e){
		e.preventDefault();
		var uid = $(this).data('id'); // get id of clicked row
		$('#dynamic-diklat').html(''); // leave this div blank
		$('#diklat-loader').show();      // load ajax loader on button click
	
		$.ajax({
			url: '<?php echo site_url('data/pemohon/get_diklat'); ?>',
			type: 'POST',
			data: {
				   'id': uid,
				   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			},
			dataType: 'html'
		})
		.done(function(data){
			console.log(data); 
			$('#dynamic-diklat').html(''); // blank before load.
			$('#dynamic-diklat').html(data); // load here
			$('#diklat-loader').hide(); // hide loader  
		})
		.fail(function(){
			$('#dynamic-diklat').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#diklat-loader').hide();
		});
});

function setuju(id)
{
    // ajax adding data to database
    $.ajax({
        url : "<?= site_url('data/pemohon/approve') ?>/"+id,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
				$('#diklat-modal').modal('hide');
				$('#form')[0].reset(); // reset form on modals
                reload_table();
			}
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			alert('Ada Kesalahan Dalam Proses Penyimpanan');
			$('#form')[0].reset(); // reset form on modals
        }
    });
}

function tolak(id)
{
    // ajax adding data to database
    $.ajax({
        url : "<?= site_url('data/pemohon/reject') ?>/"+id,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
				$('#view-modal').modal('hide');
				$('#form')[0].reset(); // reset form on modals
                reload_table();
			}
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			alert('Ada Kesalahan Dalam Proses Penyimpanan');
			$('#form')[0].reset(); // reset form on modals
        }
    });
}

function verify(id)
{
    // ajax adding data to database
    $.ajax({
        url : "<?= site_url('data/pemohon/verify') ?>/"+id,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
				$('#diklat-modal').modal('hide');
				$('#form')[0].reset(); // reset form on modals
                reload_table();
			}
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			alert('Ada Kesalahan Dalam Proses Penyimpanan');
			$('#form')[0].reset(); // reset form on modals
        }
    });
}
</script>