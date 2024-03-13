<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <!--  Row Daftar User -->
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>kas/add_kas" class="btn btn-expat d-flex align-items-center">
                <i class="ti ti-plus fs-5 me-2"></i>
                <span>
                    Tambah Kas
                </span>
            </a>
        </div>
    </div>
    <!--  Row List User-->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card border-expat w-100">
                <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Laporan Kas</h5>
                <?php if ($_SESSION["logged_user"]["role"]=="admin"){?>

                        <div class="row my-4">
                            <label class="col-form-label">Cabang</label>
                            <div class="col-3">
                                    <select id="cabang" class="form-select" name="cabang">
                                        <?php
                                        foreach ($cabang as $dt){
                                        ?>
                                            <option value="<?=$dt->id?>"><?=$dt->nama?></option>
                                        <?php  
                                            }
                                        ?>
                                    </select>
                            </div>
                            <div class="col"><button id="lihat" type="submit" class="btn btn-primary">Lihat</button></div>
                        </div>
                    <?php }?>
                   
                    <table id="table_list_kas" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jenis</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jenis</th>
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


