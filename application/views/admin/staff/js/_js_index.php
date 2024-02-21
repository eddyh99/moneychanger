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

    var table_assignstaff = $('#table_list_assignstaff').DataTable({
		"scrollX": true,
		"ajax": {
			"url": "<?=base_url()?>staff/list_all_assignstaff",
			"type": "POST",
			"dataSrc":function (data){
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
			{ data: 'username' },
			{ data: 'nama' },
			{ data: 'cabang' },
			{ data: 'alamat' },
			{ 
                data: null, "mRender": function(data, type, full, meta) {
					var btnDelete = '<a href="<?=base_url()?>staff/delete?username='+encodeURI(btoa(full.username))+'&idcabang='+encodeURI(btoa(full.id))+'" class="del-data btn btn-danger my-1"><i class="ti ti-trash"></i></a>';
					
					return `${btnDelete}`;     
                
                        
                } 
            },
		],
	});


    $(document).ready(function() {
        $('.username-select2').select2({
            placeholder: "Pilih Username",
            allowClear: true,
            theme: "bootstrap", 
            width: "100%"
        });

        $('.cabang-select2').select2({
            placeholder: "Pilih Cabang",
            allowClear: true,
            theme: "bootstrap", 
            width: "100%"
        });
    })


</script>