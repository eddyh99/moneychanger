
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>   
var table;
	table = $('#table_list_kas').DataTable({
		"scrollX": true,
		"ajax": {
			"url": "<?=base_url()?>kas/list_allkastoday",
			"type": "POST",
			"data": {
				cabang : function(){return $("#cabang").val()},
			},
			"dataSrc":function (data){
				console.log(data);
				return data;							
			}
		},
		"columns": [
			{ 	data: null,
				"sortable": false, 
					render: function (data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1;
				}
			},
			{ 
                data: null, 
                "sortable": false, 
                render: function (data, type, row, meta) {
                    return row.tanggal.split("-").reverse().join("-");
                }
            },
			{ data: 'jenis' },
			{ data: 'keterangan' },
			{ 
				data: "nominal", 
				"render":$.fn.dataTable.render.number( ',', '.', 0, '' )
			},
		],
	});

	$("#lihat").on("click",function(){
	    table.ajax.reload();
	})

    $('#tanggal').daterangepicker({
        startDate: moment(),
        endDate: moment(),
        opens: 'right',
        locale: {
            format: 'DD MMM YYYY'
        },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().add(-1, 'days'), moment().add(-1, 'days'),],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
        }
    });


	$(document).ready(function() {
		$('.cabang-select2').select2({
			placeholder: "Pilih Cabang",
			allowClear: true,
			theme: "bootstrap", 
			width: "100%"
		});
	
	});
</script>