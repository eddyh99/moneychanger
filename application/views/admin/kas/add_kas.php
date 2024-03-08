<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>kas" class="btn btn-outline-expat d-flex align-items-center">
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
                    <?php if (@isset($_SESSION["error"]) || @isset($_SESSION["error_validation"])) { ?>
                        <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="notif-login f-poppins"><?= @$_SESSION["error"] ?></span>
                            <span class="notif-login f-poppins"><?= @$_SESSION["error_validation"] ?></span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <h5 class="card-title fw-semibold mb-4">Tambah Kas</h5>
                    <form action="<?= base_url()?>kas/addkas_process" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <?php if($_SESSION['logged_user']['role'] == 'admin'){?>
                            <div class="mb-3">
                                <label for="cabang" class="form-label">Cabang</label>
                                <select class="cabang-select2" id="cabang" name="cabang" required>
                                    <option value=""></option>
                                    <?php foreach($cabang as $dt){?>
                                        <option value="<?= $dt->id?>"><?= $dt->nama?></option>
                                    <?php }?>
                                </select>
                            </div>
                        <?php }?>
                        <div class="mb-3">
                            <label for="nominal" class="form-label">Nominal</label>
                            <input type="text" class="form-control money-input" id="nominal" name="nominal" placeholder="Masukkan nominal kas..." required autocomplete="off">
                        </div>
                        <div class="mb-3 col-3">
                            <label for="jenis" class="form-label">Jenis Kas</label>
                            <select name="jenis" id="jenis" class="form-select">
                                <option value="Kas Awal">Kas Awal</option>
                                <option value="Kas Keluar">Kas Keluar</option>
                                <option value="Kas Masuk">Kas Masuk</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Enter keterangan..." required autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-expat mt-3">Simpan Kas</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->

