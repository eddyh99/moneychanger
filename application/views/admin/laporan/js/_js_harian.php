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

var table;
	table = $('#table_data').DataTable({
			"order": [[ 0, "asc" ]],
            "pageLength": 50,
            "dom": 'Bfrtip',
            "buttons": [
                'excel', 'pdf', 'print'
            ],
            "scrollX": true,
			"ajax": {
				"url": "<?=base_url()?>transaksi/historyharian",
				"type": "POST",
				"data": {
				    tgl     : function(){console.log($("#tgl").val()); return $("#tgl").val()},
				    cabang 	: function(){return $("#cabang").val()}
				},
				"dataSrc":function (data){
						return data;
					  }
			},
			// "drawCallback": function () {
			// 	var api = this.api();
			// 	var total=api.column( 5,{filter:'applied'} ).data().sum();
			// 	$( api.column( 5 ).footer() ).html(
			// 		total.toLocaleString("en")
			// 	);
    		// },		
            "columns": [
				{ "data": "invoice_id"},
				{ 
					data: null, "mRender": function(data, type, full, meta) {
						var time = full.tanggal.slice(11, 19);
						var date = full.tanggal.slice(0, 10).split("-").reverse().join("-");
						return time + " | " + date; 
						// return full.tanggal.slice(0, 10).split("-").reverse().join("-");
					} 
				},
				{ "data": "currency"},
				{ 	
					data: null, 
					"mRender": function(data, type, full, meta) {
						var rate = parseFloat(full.rate); 
						return rate.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); 
						return full.jumlah;
					},
				},
				{ "data": "jumlah"},
				{ 	
					data: null, 
					"mRender": function(data, type, full, meta) {
						var subtotal = parseFloat(data.rate * data.jumlah); 
						return String(subtotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')); 
						// return subtotal;
					},
					"className": 'dt-right' 
				},
			],
			"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api();

				// Remove the formatting to get integer data for summation
				var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            	};

				rendered = api
					.cells( null, 5, { page: 'current'} )
					.render('display')
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );


				// Update footer
				$( api.column( 5 ).footer() ).html(
				 	rendered.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
				);

			}
	});
	
	$("#lihat").on("click",function(){
	    table.ajax.reload();
	})
</script>