<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" />

<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.25/api/sum().js"></script>

<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


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


<script>
	$('#tgl').daterangepicker({
		startDate: moment(),
		opens:'right',
		locale: {
		format: 'DD MMM YYYY'
		}
	});

	function capitalizeFirstLetter(string) {
		return string.charAt(0).toUpperCase() + string.slice(1);
	}

var table;
	table = $('#table_penukaran_bank').DataTable({
			"order": [[ 0, "asc" ]],
            "pageLength": 50,
            "scrollX": true,
			"ajax": {
				"url": "<?=base_url()?>kas/getall_penukaran",
				"type": "POST",
				"data": {
				    tgl     : function(){return $("#tgl").val()},
				    cabang 	: function(){return $("#cabang").val()}
				},
				"dataSrc":function (data){
					console.log(data);
						return data;
					  }
			},
	
            "columns": [
				{ 
					data: null,
					"sortable": false, 
						render: function (data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{ "data": "cabang"},
				{ 
					data: null, "mRender": function(data, type, full, meta) {
						  return capitalizeFirstLetter(full.tipe);
					} 
				},
				{ 
					data: null, "mRender": function(data, type, full, meta) {
						return full.tanggal.slice(0, 10).split("-").reverse().join("-");
					} 
				},
					{ "data": "keterangan"},
                  { 
						data: null, "mRender": function(data, type, full, meta) {
							var btn_detail = `
								<div class="dropdown my-1">
									<button class="btn btn-success" type="button" data-bs-toggle="modal" onclick="showdetail(${full.id})" >
										<i class="ti ti-info-circle"></i> Update
									</button> 
									
								</div>`;
							return `${btn_detail}`;     
						
								
						} 
				  },
			]
	});
	
	$("#lihat").on("click",function(){
	    table.ajax.reload();
	})
   

	// Show Detail Modal
	function showdetail(id){
		$.ajax({
            url: "<?=base_url()?>kas/detail_penukaran/"+id,
            success: function (response) {
                // $("#resultmodal").html();
                $("#resultmodal").html(response);
				$('#updatepenukaran'+id).modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
	}

	// Show Jumlah Amount tambah penukaran
	function showJumlahAmount(e){
		var id = e.value;
		$('#btnjumlahamount').removeClass('disabled');
		$.ajax({
            url: "<?=base_url()?>kas/getall_amount/"+id,
            success: function (response) {
                // $("#resultmodal").html();
                $("#resultjumlahamount").html(response);
				// $('#jumlahamount').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
	}

	$(document).ready(function() {
        var max_taps = 30;
        var tap = 1;

		$("#tambahcurrency").click(function(e) {
            e.preventDefault();
            tap++;
			$('.wrapper-currency').append(`
				<div class="row mt-4">
					<hr>
					<div class="col-12 d-flex justify-content-end">
                        <i class="removecurrency ti ti-square-x  text-danger text-end" id="removecurrency" style="font-size: 26px; cursor: pointer;"></i>
                    </div>
					<div class="mb-3">
						<label for="address" class="form-label">Currency</label>
						<select class="currency-select2" id="currency${tap}" name="currency[]" required>
							<option value=""></option>
							<?php foreach($currency as $dt){?>
								<option value="<?= $dt->currency?>"><?= $dt->currency?></option>
							<?php }?>
						</select>
					</div>

					<div class="mb-3">
						<label for="amount" class="form-label">Amount</label>
						<input type="number" class="form-control" id="amount${tap}" name="amount[]" placeholder="Masukkan amount..." required autocomplete="off">
					</div>
				</div>
			
			`);
			renderSelect2();
		})

		$(".wrapper-currency").on("click", ".removecurrency", function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
            tap--;
        })
	})


	// Render Select2 After Append Currency & Amount
	function renderSelect2() {
		$('.cabang-select2').select2({
			placeholder: "Pilih Cabang",
			allowClear: true,
			theme: "bootstrap", 
			width: "100%"
		});
	
		$('.currency-select2').select2({
			placeholder: "Pilih Currency",
			allowClear: true,
			theme: "bootstrap", 
			width: "100%"
		});
	}

	renderSelect2();
</script>