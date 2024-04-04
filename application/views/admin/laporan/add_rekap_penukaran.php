<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <!--  Row List User-->
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>laporan/penukaranrekap" class="btn btn-outline-expat d-flex align-items-center">
                <i class="ti ti-chevron-left fs-5 me-1"></i>
                <span>
                    Kembali
                </span>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card border-expat w-100">
                <div class="card-body">
                <?php if (@isset($_SESSION["error"])) { ?>
                        <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="notif-login f-poppins"><?= $_SESSION["error"] ?></span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <form action="<?= base_url()?>laporan/add_penukaranrekap_process" method="POST">
                        <div class="row col-8 mx-auto d-flex align-items-center">
                            <div class="col-12">
                                <h3 class="fw-semibold mb-4 text-center" style="color: #000 !important;">Add Rekap Penukaran Bank</h3>
                                <hr>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="penukaranbank" class="form-label">Tanggal Penukaran Bank</label>
                                <div class="form-control d-flex">
                                    <input type="date" class="w-100 border-0 cursor-pointer py-0 penukaranbank" name="penukaranbank" onchange="isitanggal();" autocomplete="off">
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="address" class="form-label">Cabang</label>
                                <select class="cabang-select2" id="cabang" name="cabang" onchange="isicabang();" required>
                                    <option value=""></option>
                                    <?php foreach($cabang as $dt){?>
                                        <option value="<?= $dt->id?>"><?= $dt->nama?></option>
                                    <?php }?>
                                </select>
                            </div>
                        
                        </div>
                        <div class="wrapper-append">
                            <div class="row col-8 mx-auto d-flex align-items-center">
                                <hr>
                                <div class="col-12 color-white">.</div>
                                <div class="mb-3 col-6">
                                    <label for="rekapharian" class="form-label">Rekap Harian</label>
                                    <div class="form-control d-flex">
                                        <input type="date" class="rekapharian w-100 border-0 cursor-pointer" name="rekapharian[]" onchange="get_pembelian(event, 1);" autocomplete="off" disabled>
                                    </div>
                                </div>
                                <div class="mt-3 col-5">
                                    <span class="fs-6">Rp <span class="showpembelian1">0</span></span>
                                </div>
                            </div>
                        </div>

                        <div class="row col-8 mx-auto my-3 d-flex align-items-center">
                            <div class="col-6 d-flex justify-content-end align-items-end">
                                <span class="fs-6">Keuntungan</span>
                            </div>
                            <div class="col-5 d-flex align-items-end">
                                <span class="fs-6">Rp <span class="showkeuntungan">0</span></span>
                            </div>
                        </div>
                 
                        <div class="col-8 d-flex justify-content-center mx-auto">
                            <a id="tambahrekap" class="btn btn-outline-expat disabled mt-3 mx-2 d-flex align-items-center"> <i class="ti ti-circle-plus fs-5 me-2"></i>Tambah Rekapan</a>
                            <a id="lihatkeuntungan" class="btn btn-info mt-3 mx-2 d-flex align-items-center"> <i class="ti ti-history fs-5 me-2"></i>Lihat Keuntungan</a>
                            <button type="submit" class="btn btn-expat mt-3 mx-2"><i class="ti ti-download fs-5 me-2"></i>Simpan Rekap Bank</button>
                        </div>
                    </form>
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


