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
                    <h5 class="card-title fw-semibold mb-4">Edit Rate Currency</h5>
                    <form id="editrate" action="<?= base_url()?>currency/editcurrency_process" method="POST">
                        <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Cabang</label>
                            <select name="currency" class="form-select editselect-currency" >
                                <option value="ARS" <?= ($result->currency == "ARS") ? 'selected' : "" ?>>ARS</option>                                    
                                <option value="AED" <?= ($result->currency == "AED") ? 'selected' : "" ?>>AED</option>
                                <option value="AUD" <?= ($result->currency == "AUD") ? 'selected' : "" ?>>AUD</option>
                                <option value="BDT" <?= ($result->currency == "BDT") ? 'selected' : "" ?>>BDT</option>
                                <option value="CAD" <?= ($result->currency == "CAD") ? 'selected' : "" ?>>CAD</option>
                                <option value="CLP" <?= ($result->currency == "CLP") ? 'selected' : "" ?>>CLP</option>
                                <option value="CNY" <?= ($result->currency == "CNY") ? 'selected' : "" ?>>CNY</option>
                                <option value="CZK" <?= ($result->currency == "CZK") ? 'selected' : "" ?>>CZK</option>
                                <option value="DKK" <?= ($result->currency == "DKK") ? 'selected' : "" ?>>DKK</option>
                                <option value="EGP" <?= ($result->currency == "EGP") ? 'selected' : "" ?>>EGP</option>
                                <option value="EUR" <?= ($result->currency == "EUR") ? 'selected' : "" ?>>EUR</option>
                                <option value="GBP" <?= ($result->currency == "GBP") ? 'selected' : "" ?>>GBP</option>
                                <option value="GEL" <?= ($result->currency == "GEL") ? 'selected' : "" ?>>GEL</option>
                                <option value="GHS" <?= ($result->currency == "GHS") ? 'selected' : "" ?>>GHS</option>
                                <option value="HKD" <?= ($result->currency == "HKD") ? 'selected' : "" ?>>HKD</option>
                                <option value="HRK" <?= ($result->currency == "HRK") ? 'selected' : "" ?>>HRK</option>
                                <option value="ILS" <?= ($result->currency == "ILS") ? 'selected' : "" ?>>ILS</option>
                                <option value="INR" <?= ($result->currency == "INR") ? 'selected' : "" ?>>INR</option>
                                <option value="JPY" <?= ($result->currency == "JPY") ? 'selected' : "" ?>>JPY</option>
                                <option value="KES" <?= ($result->currency == "KES") ? 'selected' : "" ?>>KES</option>
                                <option value="KRW" <?= ($result->currency == "KRW") ? 'selected' : "" ?>>KRW</option>
                                <option value="LKR" <?= ($result->currency == "LKR") ? 'selected' : "" ?>>LKR</option>
                                <option value="MAD" <?= ($result->currency == "MAD") ? 'selected' : "" ?>>MAD</option>
                                <option value="MXN" <?= ($result->currency == "MXN") ? 'selected' : "" ?>>MXN</option>
                                <option value="MYR" <?= ($result->currency == "MYR") ? 'selected' : "" ?>>MYR</option>
                                <option value="NGN" <?= ($result->currency == "NGN") ? 'selected' : "" ?>>NGN</option>
                                <option value="NOK" <?= ($result->currency == "NOK") ? 'selected' : "" ?>>NOK</option>
                                <option value="NPR" <?= ($result->currency == "NPR") ? 'selected' : "" ?>>NPR</option>
                                <option value="PEN" <?= ($result->currency == "PEN") ? 'selected' : "" ?>>PEN</option>
                                <option value="PHP" <?= ($result->currency == "PHP") ? 'selected' : "" ?>>PHP</option>
                                <option value="PKR" <?= ($result->currency == "PKR") ? 'selected' : "" ?>>PKR</option>
                                <option value="PLN" <?= ($result->currency == "PLN") ? 'selected' : "" ?>>PLN</option>
                                <option value="RON" <?= ($result->currency == "RON") ? 'selected' : "" ?>>RON</option>
                                <option value="SEK" <?= ($result->currency == "SEK") ? 'selected' : "" ?>>SEK</option>
                                <option value="SGD" <?= ($result->currency == "SGD") ? 'selected' : "" ?>>SGD</option>
                                <option value="THB" <?= ($result->currency == "THB") ? 'selected' : "" ?>>THB</option>
                                <option value="TRY" <?= ($result->currency == "TRY") ? 'selected' : "" ?>>TRY</option>
                                <option value="TZS" <?= ($result->currency == "TZS") ? 'selected' : "" ?>>TZS</option>
                                <option value="UAH" <?= ($result->currency == "UAH") ? 'selected' : "" ?>>UAH</option>
                                <option value="UGX" <?= ($result->currency == "UGX") ? 'selected' : "" ?>>UGX</option>
                                <option value="USD" <?= ($result->currency == "USD") ? 'selected' : "" ?>>USD</option>
                                <option value="VND" <?= ($result->currency == "VND") ? 'selected' : "" ?>>VND</option>
                                <option value="ZAR" <?= ($result->currency == "ZAR") ? 'selected' : "" ?>>ZAR</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="rate" class="form-label">Buy</label>
                            <input type="text" class="form-control money-input" value="<?= $result->rate?>" id="rate"  name="rate" placeholder="Masukkan rate Buy..." required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="rate_j" class="form-label">Sell</label>
                            <input type="text" class="form-control money-input"  value="<?= $result->rate_j?>" id="rate_j" name="rate_j" placeholder="Masukkan rate Sell ..." required autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-expat mt-3">Update Rate</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- MAIN CONTENT END -->

