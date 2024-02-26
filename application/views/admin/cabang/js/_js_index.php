<style>
    .th-cabang-address {
        width: 300px;
    }

</style>

<script>

    var table_outlet = $('#table_list_cabang').DataTable({
		"scrollX": true,
		"ajax": {
			"url": "<?=base_url()?>cabang/list_allcabang",
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
			{ data: 'nama' },
			{ data: 'kecamatan' },
			{ data: 'alamat' },
			{ data: 'kontak' },
			{ 
                data: null, "mRender": function(data, type, full, meta) {
                    var btnEdit ='<a href="<?=base_url()?>cabang/edit_cabang/'+encodeURI(btoa(full.id))+'" class="btn btn-success mx-1 my-1"><i class="ti ti-pencil-minus fs-4"></i></a>'
					var btnDelete = '<a href="<?=base_url()?>cabang/delete/'+encodeURI(btoa(full.id))+'" class="del-data btn btn-danger my-1"><i class="ti ti-trash"></i></a>';
					
					return `${btnEdit} ${btnDelete}`;     
                
                        
                } 
            },
		],
	});


</script>