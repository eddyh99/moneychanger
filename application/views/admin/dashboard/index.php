<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <div class="row">
   
  

        <div class="col-6">
            <div class="card bg-white-subtle shadow-lg">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="dash-preview rounded text-bg-primary d-flex align-items-center justify-content-center">
                            <i class="ti ti-building-store fs-12"></i>
                        </div>
                        <div class="ms-auto text-primary d-flex align-items-center">
                            <span class="fs-8 fw-bold">10</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4">
                        <h3 class="mb-0 fw-semibold fs-7">Total Outlets</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6">
            <div class="card bg-white-subtle shadow-lg">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="dash-preview rounded text-bg-danger d-flex align-items-center justify-content-center">
                            <i class="ti ti-currency-dollar fs-12"></i>
                        </div>
                        <div class="ms-auto text-danger d-flex align-items-center">
                            <span class="fs-8 fw-bold text-danger">100JT</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4">
                        <h3 class="mb-0 fw-semibold fs-7">Monthly Transaction</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card bg-white-subtle shadow-lg">
                <div class="card-body p-4">
                    <div id="omzetBulananChart" style="height: 370px; width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card bg-white-subtle shadow-lg">
                <div class="card-body p-4">
                    <div id="chartNationality" style="height: 370px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
<!-- MAIN CONTENT END -->


<!-- SWEET ALERT START -->
<script>
<?php if(isset($_SESSION["success_login"])) { ?>
    setTimeout(function() {
        Swal.fire({
            html: '<?= $_SESSION['success_login'] ?>',
            position: 'top',
            timer: 3000,
            showCloseButton: true,
            showConfirmButton: false,
            icon: 'info',
            timer: 2000,
            timerProgressBar: true,
        });
    }, 100);
<?php } ?>
</script>
<!-- SWEET ALERT END -->


