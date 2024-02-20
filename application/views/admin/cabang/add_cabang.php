<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>cabang" class="btn btn-outline-expat d-flex align-items-center">
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
                    <h5 class="card-title fw-semibold mb-4">Tambah Cabang</h5>
                    <form action="<?= base_url()?>cabang/addcabang_process" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Cabang</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama cabang..." required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Cabang</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan alamat..." required autocomplete="off">
                        </div>
                        <div class="mb-4">
                            <label for="contact" class="form-label">Kontak</label>
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Masukkan kontak..." required autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-expat mt-3">Simpan Cabang</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->

