<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>staff" class="btn btn-outline-expat d-flex align-items-center">
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
                    <h5 class="card-title fw-semibold mb-4">Assign Staff</h5>
                    <form action="<?= base_url()?>staff/add_assignstaff_process" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="mb-3">
                            <label for="address" class="form-label">Username</label>
                            <select class="username-select2" id="username" name="username" required>
                                <option value=""></option>
                                <?php 
                                    foreach($user as $dt){
                                        if($dt->username != 'admin'){
                                ?>
                                    <option value="<?= $dt->username?>"><?= $dt->username?></option>
                                <?php 
                                        }    
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Cabang</label>
                            <select class="cabang-select2" id="cabang" name="cabang" required>
                                <option value=""></option>
                                <?php foreach($cabang as $dt){?>
                                    <option value="<?= $dt->id?>"><?= $dt->nama?></option>
                                <?php }?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-expat mt-3">Simpan Cabang</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->

