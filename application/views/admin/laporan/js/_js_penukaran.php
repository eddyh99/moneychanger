<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" />
<style>
    tr { height: 50px; }
    #table_data tbody tr{
      cursor:pointer;
    }
    .show-calendar tr{
        height:10px;
    }
	.dt-button{
		height:35px;
		width:75px;
	}
</style>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.25/api/sum().js"></script>

<script>
  $('#tgl').daterangepicker({
    startDate: moment(),
    opens:'right',
    locale: {
      format: 'DD MMM YYYY'
    }
  });
var groupColumn = 1;
var table;
	table = $('#table_data').DataTable({
			"order": [[ 0, "asc" ]],
			// "columnDefs": [{
			// 	visible: false,
			// 	targets: groupColumn
			// }],
            "pageLength": 50,
            "dom": 'Bfrtip',
            "buttons": [
                'excel', 'pdf', 'print'
            ],
            "scrollX": true,
			"ajax": {
				"url": "<?=base_url()?>laporan/historypenukaran",
				"type": "POST",
				"data": {
				    tgl     : function(){console.log($("#tgl").val()); return $("#tgl").val()},
				    cabang 	: function(){return $("#cabang").val()}
				},
				"dataSrc":function (data){
						return data;
					  }
			},
			"drawCallback": function () {
    			var api = this.api();			
				var jumlah = api.column( 2, {filter:'applied'} ).data().sum();
				$( api.column( 2 ).footer() ).html(jumlah);

				// var last = null;

				// api.column(groupColumn, {filter:'applied'})
				// 	.data()
				// 	.each(function (group, i) {
				// 		if (last !== group) {
				// 			$(rows)
				// 				.eq(i)
				// 				.before(
				// 					'<tr class="group"><td colspan="3"><strong>' +
				// 						group +
				// 						'</strong></td></tr>'
				// 				);

				// 			last = group;
				// 		}
				// 	});				
    		},		
            "columns": [
				{ "data": "cabang"},
				//   { "data": "tanggal"},
				  { "data": "currency"},
                  { "data": "jumlah","render":$.fn.dataTable.render.number( ',', '.', 0, '' ),"className": 'dt-right' },
			]
	});
	
	$("#lihat").on("click",function(){
	    table.ajax.reload();
	})
</script>