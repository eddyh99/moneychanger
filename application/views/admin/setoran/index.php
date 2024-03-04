<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <!--  Row Daftar User -->
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>kas/add_setoran" class="btn btn-expat d-flex align-items-center">
                <i class="ti ti-plus fs-5 me-2"></i>
                <span>
                    Tambah Penukaran
                </span>
            </a>
        </div>
    </div>

	<div class="row my-4">
		<label class="col-form-label col-1">Tanggal</label>
		<div class="col-3">
			<input type="text" id="tgl" name="tgl" class="form-control">
		</div>
		<div class="col-3">
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
                    <!-- <div class="row d-flex justify-content-start align-items-start form-group mb-3">
                        <div class="col-3">
                            <label class="text-start d-block mb-2">Cabang</label>
                            <select id="tipeticket" name="tipeticket" class="form-select">
                                <option value="all">Semua Cabang</option>
                                <option value="1">Ubud</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label class="text-start d-block mb-2">Range Tanggal</label>
                            <input type="text" id="tanggal" name="tanggal" class="form-control" value="" autocomplete="off">
                        </div>
                    </div>
                    <div class="row form-group mb-5">
                        <div class="col text-start">
                            <button id="lihat" class="btn btn-warning">
                                <i class="ti ti-filter fs-5 me-1"></i>
                                Filter
                            </button>
                        </div>
                    </div> -->
                    <h5 class="card-title fw-semibold mb-4">Penukaran Bank</h5>
                    <table id="table_penukaran_bank" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Cabang</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Cabang</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MAIN CONTENT END -->
<div id="resultmodal">

</div>
<!-- <div class="modal fade" id="updatepenukaran5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Penukaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-start">
                    <form class="w-100" action="<?= base_url()?>kas/update_penukaran_process" method="POST">
                            <?php  foreach($detail as $dt){?>
                                
                                <div class="mb-5">
                                    <div class="mb-3">
                                        <label for="currency" class="form-label">Currency</label>
                                        <input type="text" class="form-control w-100" id="currency" name="currency" value="<?= $dt->currency?>" required autocomplete="off" readonly>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="rate" class="form-label">Rate</label>
                                        <input type="text" class="form-control w-100 money-input" id="rate" name="rate" value="<?php echo ($dt->rate != '0.00') ? $dt->rate : '' ?>" placeholder="Masukkan rate ..." required autocomplete="off" >
                                    </div>
                                </div>
                                <hr>
                                
                            <?php }?>
                        <button type="submit" class="btn btn-expat mt-3">Update Penukaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->

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


