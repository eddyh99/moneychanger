<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>laporan/add_penukaranrekap" class="btn btn-expat d-flex align-items-center">
                <i class="ti ti-plus fs-5 me-2"></i>
                <span>
                    Rekap Penukaran
                </span>
            </a>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-3">
            <input type="date" id="tgl" name="tgl" value="<?= @date_format(date_create($tgl), 'Y-m-d')?>" class="form-control" autocomplete="off">
        </div>
        <div class="col-3">
            <?php 
            if ($_SESSION["logged_user"]["role"]=="kasir"){?>
                <input type="hidden" name="cabang" id="cabang" value="<?=$_SESSION["logged_user"]["idcabang"]?>">
            <?php }else{?>
                <select id="cabang" class="form-select" name="cabang">
                    <?php
                    foreach ($cabang as $dt){
                    ?>
                        <option value="<?=$dt->id?>"><?=$dt->nama?></option>
                    <?php  
                        }
                    ?>
                </select>
            <?php }?>
        </div>
        <div class="col">
            <button id="lihat" class="btn btn-primary">Lihat</button>
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

                    <section id="printthis" class="col-12 col-lg-10 mx-auto">
                        <div class="row">
                            <div class="col-10 my-3  mx-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h2 class="fw-semibold mb-4 text-start" style="color: #000 !important;">Rekap Penukaran</h2>
                                    <h5>
                                        Tanggal <br>
                                        <span class="showtanggal">
                                            <?= @date_format(date_create($tgl), 'd-m-Y')?>
                                        </span>
                                    </h5>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="tambahrekap">
                            <div class="row">
                                <div class="col-10 mx-auto ">
                                    <table id="summarypenukaran" border="2" width="1400"  cellpadding="0" cellspacing="0" class="mx-auto">
                                        <!-- <tr>
                                            <td class="text-start">Penukaran 1</td>
                                            <td class="text-start">Rp.10.000</td>
                                            <td></td>
                                        </tr>                                            
                                        <tr>
                                            <td class="text-start">Penukaran 2</td>
                                            <td class="text-start">Rp.10.000</td>
                                            <td></td>
                                        </tr>                                            
                                        <tr>
                                            <td class="text-start td-pembelian">Pembelian 10-10-2023</td>
                                            <td></td>
                                            <td class="text-end">Rp 20.000.00</td>
                                        </tr>
                                        <tr>
                                            <td class="text-start td-pembelian">Pembelian 10-10-2023</td>
                                            <td></td>
                                            <td class="text-end td-pembelian">Rp 20.000.00</td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td class="text-start">Rp.20.0000</td>
                                            <td class="text-end">Rp.20.0000</td>
                                        </tr>
                                        <tr>
                                            <td>Keuntungan</td>
                                            <td></td>
                                            <td class="text-end">Rp.50.0000</td>
                                        </tr> -->
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10 mx-auto  d-flex justify-content-center">
                                <div id="loading" class="spinner-border d-none" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <!-- <div class="col-10 mx-auto d-flex justify-content-between">
                                <h5 class="text-end">
                                    Total keuntungan
                                </h5>
                                <h5 class="fw-bolder">Rp
                                    <span class="showkeuntungan">
                                        0
                                    </span>
                                </h5>
                            </div> -->
                        </div>
                      
                    </section>         

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


