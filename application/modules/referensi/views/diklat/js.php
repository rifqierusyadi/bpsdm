<script>
$(function () {
 $('.select2').select2();
});

var key = $("#key").text();
var table;

$(function () {
var process = window.location.href+'/ajax_list';
table = $('#tableIDX').DataTable({
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
                targets:[ 0 ],orderable: false,responsivePriority: 1
            },
            { 
                targets:[ -1 ],orderable: false,responsivePriority: 2
            },
            { 
                targets:[ 1 ], visible: false, class:'never'
            },
        ],
		"order": [[ 1, 'asc' ]],
        drawCallback: function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
            if ( last !== group ) {
            $(rows).eq( i ).before(
            '<tr class="bg-gray color-palette disabled"><td colspan="4"><b>'+group+'</b></td></tr>'
            );

            last = group;
            }
            });
        }
    });
});

$("#jenis_id").change(function(){
    var jenis_id = $("#jenis_id").val();
    if(jenis_id){
        $.ajax({
            type: "POST",
            async: false,
            url : "<?php echo site_url('referensi/diklat/get_jenjang')?>",
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

//function add button
$(function(){
	var maxField = 20; //Input fields increment limitation
    var addButton = $('.add-button'); //Add button selector
    var wrapper = $('.field-wrapper'); //Input field wrapper
	var fieldHTML = $('#hidden-template').html();
	
	var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
	
    $(wrapper).on('click', '.remove-button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).closest('.child').remove(); //Remove field html
		//$(wrapper).find('.parent').remove();
        x--; //Decrement field counter
    });
});
</script>
<script id="hidden-template" type="text/x-custom-template">
	<div class="child">
	<div class="form-group <?php echo form_error('syarat') ? 'has-error' : null; ?>">
		<div class="input-group input-group">  
		  <?php
		  $data = array('class'=>'form-control','name'=>'syarat[]','id'=>'syarat','type'=>'text','value'=>set_value('syarat[]'));
		  echo form_input($data);
		  ?>
		  <div class="input-group-btn">
			<button class="btn btn-danger btn-flat remove-button" type="button"><i class="fa fa-minus"></i></button>
		  </div>
		</div>
		<?php
		  echo form_error('syarat') ? form_error('syarat', '<p class="help-block">','</p>') : '';
		?>
	</div>
	</div>
</script>