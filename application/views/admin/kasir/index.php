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
                    <h5 class="card-title fw-semibold mb-4">Cabang: <span class="text-decoration-underline">Money Changer Canggu</span></h5>
                    <form action="<?= base_url()?>kas/addkas_process" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
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
                                <div class="mb-3">
                                    <label for="name" class="form-label">Currency</label>
                                    <select name="currency" id="currency" class="form-select select-currency-withdraw">
                                        <option value="">--Select Currency--</option>  
                                        <?php foreach($currency as $dt){
                                            if(
                                                $dt->currency == 'USD' || $dt->currency == 'AUD' || $dt->currency == 'GBP' ||
                                                $dt->currency == 'RMB' || $dt->currency == 'EUR' || $dt->currency == 'JPY'  
                                            ){  
                                        ?>
                                            <option value="<?= $dt->currency?>" rate="<?= $dt->rate?>"><?= $dt->currency?></option>                                                                    
                                        <?php 
                                            }
                                        }?>

                                        <?php foreach($currency as $dt){
                                            if(
                                                $dt->currency != 'USD' && $dt->currency != 'AUD' && $dt->currency != 'GBP' &&
                                                $dt->currency != 'RMB' && $dt->currency != 'EUR' && $dt->currency != 'JPY'  
                                            ){  
                                        ?>
                                            <option value="<?= $dt->currency?>" rate="<?= $dt->rate?>"><?= $dt->currency?></option>                                                                    
                                        <?php 
                                            }
                                        }?>

                                        
                                        <!-- <option value="USD">USD</option>                                  
                                        <option value="EUR">EUR</option>
                                        <option value="JPY">JPY</option>
                                        <option value="AUD">AUD</option>
                                        <option value="GBP">GBP</option>
                                        <option value="ARS">ARS</option>                                    
                                        <option value="AED">AED</option>
                                        <option value="BDT">BDT</option>
                                        <option value="CAD">CAD</option>
                                        <option value="CLP">CLP</option>
                                        <option value="CNY">CNY</option>
                                        <option value="CZK">CZK</option>
                                        <option value="DKK">DKK</option>
                                        <option value="EGP">EGP</option>
                                        <option value="GEL">GEL</option>
                                        <option value="GHS">GHS</option>
                                        <option value="HKD">HKD</option>
                                        <option value="HRK">HRK</option>
                                        <option value="ILS">ILS</option>
                                        <option value="INR">INR</option>
                                        <option value="KES">KES</option>
                                        <option value="KRW">KRW</option>
                                        <option value="LKR">LKR</option>
                                        <option value="MAD">MAD</option>
                                        <option value="MXN">MXN</option>
                                        <option value="MYR">MYR</option>
                                        <option value="NGN">NGN</option>
                                        <option value="NOK">NOK</option>
                                        <option value="NPR">NPR</option>
                                        <option value="PEN">PEN</option>
                                        <option value="PHP">PHP</option>
                                        <option value="PKR">PKR</option>
                                        <option value="PLN">PLN</option>
                                        <option value="RON">RON</option>
                                        <option value="SEK">SEK</option>
                                        <option value="SGD">SGD</option>
                                        <option value="THB">THB</option>
                                        <option value="TRY">TRY</option>
                                        <option value="TZS">TZS</option>
                                        <option value="UAH">UAH</option>
                                        <option value="UGX">UGX</option>
                                        <option value="VND">VND</option>
                                        <option value="ZAR">ZAR</option> -->
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="lembar" class="form-label">Lembar</label>
                                    <input type="number" class="form-control" id="lembar" name="lembar" placeholder="Masukkan jumlah lembar..." required autocomplete="off">
                                </div>
                                <!-- <div class="mb-3">
                                    <label for="rate" class="form-label">Rate Currency <small>(readonly)</small></label>
                                    <input type="text" class="form-control money-input" id="rate" name="rate" placeholder="Rate ..." required autocomplete="off" readonly>
                                </div> -->
                            </div>
                            <div class="col-6">
                                <div class="mb-3 w-100 bg-warning" style="height: 10px"></div>
                                <div class="mb-3 pt-1 d-flex flex-column justify-content-center align-items-center">
                                    <div>
                                        <h5 class="text-center">Rate:</h4>
                                        <h2 class="text-center">Rp. <span id="ratesummary" class="money-input">0</span></h1>
                                    </div>
                                    <div class="pt-4">
                                        <h5 class="text-center">Total Amount:</h4>
                                        <h1 class="text-center">Rp. <span id="amountsummary" class="money-input">0</span></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-expat mt-3">Simpan Transaksi</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->

