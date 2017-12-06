<script>
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
	targets:[1], visible: false, class:'never'
	}
],
"order": [[ 1, 'asc' ]],
drawCallback: function ( settings ) {
	var api = this.api();
	var rows = api.rows( {page:'current'} ).nodes();
	var last=null;
	api.column(1, {page:'current'} ).data().each( function ( sekolah, i ) {
		if ( last !== sekolah ) {
			$(rows).eq( i ).before(
			'<tr class="bg-light-gray color-palette" ><td colspan="5"><b>'+sekolah+'</b></td></tr>'
			);
			last = sekolah;
		}
	});
	},
});
});
</script>