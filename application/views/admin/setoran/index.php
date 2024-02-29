<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <!--  Row Daftar User -->
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>kas/setoran_add" class="btn btn-expat d-flex align-items-center">
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
                    <h5 class="card-title fw-semibold mb-4">Input Penukaran Bank</h5>
                    <table id="table_data" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Cabang</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Cabang</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
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


