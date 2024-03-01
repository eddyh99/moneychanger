<?php require('list_negara.php'); ?>
<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <!-- <a href="<?= base_url()?>kas" class="btn btn-outline-expat d-flex align-items-center">
                <i class="ti ti-chevron-left fs-5 me-1"></i>
                <span>
                    Kembali
                </span>
            </a> -->
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

                    <div class="modal fade" id="jenisTransaksi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="jenisTransaksiLabel" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header d-flex align-items-center justify-content-center">
                                    <h4 class="modal-title text-center" id="myLargeModalLabel">
                                        Pilih Jenis Transaksi
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex justify-content-evenly select-jenis-transaksi">
                                        <label id="labelbeli" for="beli" class="pilih-jenis-transaksi bg-monex text-white">
                                            <input type="radio" name="jenis" value="beli" id="beli" checked="checked">
                                            <span>Buy</span>
                                        </label>
                                        <label id="labeljual" for="jual">
                                            <input type="radio" name="jenis" value="jual" id="jual">
                                            <span>Sell</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn bg-primary-subtle text-primary  waves-effect text-start" data-bs-dismiss="modal">
                                        Simpan Jenis Transaksi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="d-flex justify-content-between">
                        <h5 class="card-title fw-semibold mb-4">Cabang: <span class="text-decoration-underline text-uppercase"><?= $_SESSION['logged_user']['cabang']?></span></h5>
                        <button type="button" class="btn mb-1 d-flex justify-content-center align-items-center bg-primary-subtle text-primary px-4 fs-4 ">
                            <i class="ti ti-info-circle fs-6  me-2"></i>
                            <span class="preview-jenis-transaksi  fs-5">
                                Buy
                            </span>
                        </button>
                    </div>
                    <form action="<?= base_url()?>transaksi/transaksi_process" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" id="jenistransaksi" name="jenistransaksi" value="beli">
                        <div class="row pt-2 mb-5">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="customer" class="form-label">Customer</label>
                                    <input type="text" class="form-control" id="customer" name="customer" placeholder="Masukkan nama customer..." required autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat..." required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="country" class="form-label">Negara</label>
                                    <select class="country-select2" id="country" name="country" required>
                                        <?php 
                                            foreach($list_negara as $dt){
                                        ?>
                                            <option value="<?= $dt['name']?>"><?= $dt['name']?></option>
                                        <?php 
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="passpor" class="form-label">Passpor</label>
                                    <input type="text" class="form-control" id="passpor" name="passpor" placeholder="Masukkan passpor..." required autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3 w-100 bg-primary" style="height: 10px"></div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 w-100 bg-warning" style="height: 10px"></div>
                            </div>

                            <div class="wrapper-currency">
                            
                                <div class="row">
                                <!-- <i class="ti ti-square-x text-danger text-end align-self-end" style="font-size: 26px;"></i> -->
                                    <div class="col-6 my-4">
                                        <div class="mb-3">
                                            <input type="hidden" name="rate[]" id="rate1">
                                            <label for="name" class="form-label">Currency</label>
                                            <select name="currency[]" class="currency form-select select-currency-withdraw" onchange="showRate(this, 1)">
                                                <option value="">--Select Currency--</option>  
                                                <?php foreach($currency as $dt){
                                                    if(
                                                        $dt->currency == 'USD' || $dt->currency == 'AUD' || $dt->currency == 'GBP' ||
                                                        $dt->currency == 'RMB' || $dt->currency == 'EUR' || $dt->currency == 'JPY'  
                                                    ){  
                                                ?>
                                                    <option value="<?= $dt->currency?>-<?= $dt->rate?>" data-rate="<?= $dt->rate?>" data-ratejual="<?= $dt->rate_j?>" ><?= $dt->currency?></option>                                                                    
                                                <?php 
                                                    }
                                                }?>
        
                                                <?php foreach($currency as $dt){
                                                    if(
                                                        $dt->currency != 'USD' && $dt->currency != 'AUD' && $dt->currency != 'GBP' &&
                                                        $dt->currency != 'RMB' && $dt->currency != 'EUR' && $dt->currency != 'JPY'  
                                                    ){  
                                                ?>
                                                    <option value="<?= $dt->currency?>-<?= $dt->rate?>" data-rate="<?= $dt->rate?>" data-ratejual="<?= $dt->rate_j?>" ><?= $dt->currency?></option>                                                                    
                                                <?php 
                                                    }
                                                }?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lembar" class="form-label">Amount</label>
                                            <input type="number" class="form-control" id="lembar1" onblur="lembarCalc(this, 1)" name="lembar[]" placeholder="Masukkan amount..." required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-6 my-4">
                                        <div class="mb-3 pt-1 d-flex flex-column justify-content-center align-items-center">
                                         
                                            <div>
                                                <h6 class="text-center">Rate IDR:</h6>
                                                <h4 class="text-center">Rp. <span id="ratesummary1" class="money-input">0</span></h4>
                                            </div>
                                            <div class="pt-4">
                                                <h6 class="text-center">Total Amount IDR:</h6>
                                                <h3 class="text-center">Rp. <span id="amountsummary1" class="money-input">0</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-center mx-3">
                            <a id="tambahcurrency" class="btn btn-outline-expat mt-3 mx-2 d-flex align-items-center"> <i class="ti ti-circle-plus fs-5 me-2"></i>Tambah Currency</a>
                            <button type="submit" class="btn btn-expat mt-3 mx-2"><i class="ti ti-download fs-5 me-2"></i>Simpan Transaksi</button>
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

