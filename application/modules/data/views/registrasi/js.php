<script>
$(function () {
	$('.select2').select2();
});

$(function () {
var key = $("#key").text();
var table;
var process = window.location.href+'/ajax_list';

$('#tableIDX').DataTable({
      processing:true,
      serverSide:true,
      ajax:{
            url: process,
            type: "POST",
            data : {tokensys:key}
      },
      paging: true,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: true,
      language: {
        lengthMenu: "Tampilkan _MENU_ Baris",
        zeroRecords: "Maaf - Data Tidak Ditemukan",
        info: "Lihat Halaman _PAGE_ Dari _PAGES_",
        infoEmpty: "Tidak Ada Data Tersedia",
        infoFiltered: "(filtered from _MAX_ total records)",
        paginate: {
            first:"Awal",
            last:"Akhir",
            next:"Lanjut",
            previous:"Sebelum"
            },
        search:"Pencarian:",
        },
	  	responsive: true,
        columnDefs: [
            { 
                targets:[ 0 ],
		    	orderable: false,
				responsivePriority: 1,
				class:'all'
			},
			{ 
                targets:[ 6 ],
                orderable: false,
				responsivePriority: 3,
				class:'all'
			},
			{ 
                targets:[ 7 ],
                orderable: false,
				responsivePriority: 4,
				class:'all'
            },
            { 
                targets:[ -1 ],
                orderable: false,
				responsivePriority: 2,
				class:'all'
            },
		]
    });
});

$(document).on('click', '#getUser', function(e){
		e.preventDefault();
		var uid = $(this).data('id'); // get id of clicked row
		$('#dynamic-content').html(''); // leave this div blank
		$('#modal-loader').show();      // load ajax loader on button click
	
		$.ajax({
			url: '<?php echo site_url('data/registrasi/get_profile'); ?>',
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
</script>