
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>

    
    $('#table_list_kas').DataTable({
		"scrollX": true,
		"ajax": {
			"url": "<?=base_url()?>kas/list_allkastoday",
			"type": "POST",
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
</script>