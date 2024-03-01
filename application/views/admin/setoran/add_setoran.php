<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>kas/penukaran" class="btn btn-outline-expat d-flex align-items-center">
                <i class="ti ti-chevron-left fs-5 me-1"></i>
                <span>
                    Kembali
                </span>
            </a>
        </div>
    </div>
    <!--  Row Daftar User Agent -->
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
                    <h5 class="card-title fw-semibold mb-4">Tambah Penukaran</h5>
                    <form action="<?= base_url()?>kas/add_setoran_process" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="mb-3">
                            <label for="address" class="form-label">Cabang</label>
                            <select class="cabang-select2" id="cabang" name="cabang" onchange="showJumlahAmount(this)" required>
                                <option value=""></option>
                                <?php foreach($cabang as $dt){?>
                                    <option value="<?= $dt->id?>"><?= $dt->nama?></option>
                                <?php }?>
                            </select>
                        </div>

                        <div class="mb-5">
                            <button id="btnjumlahamount" class="btn btn-success disabled" type="button" data-bs-toggle="modal" data-bs-target="#jumlahamount">
                                <i class="ti ti-currency-dollar fs-5"></i>
                                Jumlah Amount
                            </button>
                        </div>

                        <div class="wrapper-currency">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Currency</label>
                                    <select class="currency-select2" id="currency1" name="currency[]" required>
                                        <option value=""></option>
                                        <?php foreach($currency as $dt){?>
                                            <option value="<?= $dt->currency?>"><?= $dt->currency?></option>
                                        <?php }?>
                                    </select>
                                </div>
        
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" class="form-control" id="amount1" onblur="amountCalc(this, 1)" name="amount[]" placeholder="Masukkan amount..." required autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mx-3">
                            <a id="tambahcurrency" class="btn btn-outline-expat mt-3 mx-2 d-flex align-items-center"> <i class="ti ti-circle-plus fs-5 me-2"></i>Tambah Currency</a>
                            <button type="submit" class="btn btn-expat mt-3 mx-2"><i class="ti ti-download fs-5 me-2"></i>Simpan Penukaran</button>
                        </div>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->

<div id="resultjumlahamount">

</div>
