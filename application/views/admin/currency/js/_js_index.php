<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    .th-cabang-address {
        width: 300px;
    }

</style>

<script>

    var table_assignstaff = $('#table_list_ratecurrency').DataTable({
		"scrollX": true,
		"ajax": {
			"url": "<?=base_url()?>currency/list_allrate",
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
			{ data: 'currency' },
			{data: 'rate', render: $.fn.dataTable.render.number(',', '.', 2) },
			{data: 'rate_j', render: $.fn.dataTable.render.number(',', '.', 2) },
			{ 
                data: null, "mRender": function(data, type, full, meta) {
                    button='<a href="<?=base_url()?>currency/edit_ratecurrency/'+encodeURI(btoa(full.currency))+'" class="btn btn-success mx-1 my-1"><i class="ti ti-pencil-minus fs-4"></i></a>'
					return button;     
                
                        
                } 
            },
		],
	});


    // DISABLED AND ENABLED EDIT RATE CURRENCY
    $('.editselect-currency').prop('disabled', true);
    $('#editrate').on('submit', function() {
        $('.editselect-currency').prop('disabled', false);
    });

</script>