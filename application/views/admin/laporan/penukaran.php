<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <!--  Row Daftar User -->
    <div class="row my-4">
		<label class="col-form-label col-1">Tanggal</label>
		<div class="col-3">
			<input type="text" id="tgl" name="tgl" class="form-control">
		</div>
		<div class="col-2">
			<select id="cabang" class="form-select" name="cabang">
				<option value="all">Semua Cabang</option>
				<?php
				foreach ($cabang as $dt){
				?>
				<option value="<?=$dt->id?>"><?=$dt->nama?></option>
				<?php  
					}
				?>
			</select>
		</div>
		<div class="col"><button id="lihat" class="btn btn-primary">Lihat</button></div>
    </div>
    <!--  Row List User-->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card border-expat w-100">
                <div class="card-body">                    
                    <h5 class="card-title fw-semibold mb-4">Ringkasan Penukaran</h5>
					<table id="table_data" class="mt-3 table table-striped nowrap" width="100%">
						<thead>
							<tr>
								<th>Cabang</th>
								<th>Tanggal</th>
								<th>Currency</th>
								<th>Jumlah</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th>Total</th>
							</tr>
						</tfoot>
					</table>
				</div>
            </div>
        </div>
    </div>
</div>
<!-- MAIN CONTENT END -->

<!-- SWEET ALERT START -->
<?php if(isset($_SESSION["success"])) { ?>
    <script>
        setTimeout(function() {
            Swal.fire({
                html: '<?= $_SESSION['success'] ?>',
                position: 'top',
                timer: 3000,
                showCloseButton: true,
                showConfirmButton: false,
                icon: 'success',
                timer: 2000,
                timerProgressBar: true,
            });
        }, 100);
    </script>
<?php } ?>
<!-- SWEET ALERT END -->


