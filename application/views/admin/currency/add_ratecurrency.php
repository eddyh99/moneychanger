<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-lg-12 d-flex align-items-strech">
            <a href="<?= base_url()?>currency/rate_currency" class="btn btn-outline-expat d-flex align-items-center">
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
                    <h5 class="card-title fw-semibold mb-4">Tambah Rate Currency</h5>
                    <form action="<?= base_url()?>currency/addcurrency_process" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">Currency</label>
                            <select name="currency" class="form-select select-currency-withdraw">
                                <option value="ARS">ARS</option>                                    
                                <option value="AED">AED</option>
                                <option value="AUD">AUD</option>
                                <option value="BDT">BDT</option>
                                <option value="CAD">CAD</option>
                                <option value="CLP">CLP</option>
                                <option value="CNY">CNY</option>
                                <option value="CZK">CZK</option>
                                <option value="DKK">DKK</option>
                                <option value="EGP">EGP</option>
                                <option value="EUR">EUR</option>
                                <option value="GBP">GBP</option>
                                <option value="GEL">GEL</option>
                                <option value="GHS">GHS</option>
                                <option value="HKD">HKD</option>
                                <option value="HRK">HRK</option>
                                <option value="IDR">IDR</option>
                                <option value="ILS">ILS</option>
                                <option value="INR">INR</option>
                                <option value="JPY">JPY</option>
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
                                <option value="USD">USD</option>
                                <option value="VND">VND</option>
                                <option value="ZAR">ZAR</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="rate" class="form-label">Buy</label>
                            <input type="text" class="form-control money-input" id="rate" name="rate" placeholder="Masukkan rate Buy ..." required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="rate_j" class="form-label">Sell</label>
                            <input type="text" class="form-control money-input" id="rate_j" name="rate_j" placeholder="Masukkan rate Sell ..." required autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-expat mt-3">Simpan Rate</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->

