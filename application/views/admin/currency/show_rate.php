<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title?></title>
	<link rel="shortcut icon" type="image/png" href="<?= base_url()?>assets/img/favicon.png" />
	<link rel="stylesheet" href="<?= base_url()?>assets/css/styles.min.css" />
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" /> -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
	<link rel="stylesheet" href="<?= base_url()?>assets/css/custom.css">
    
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 mx-auto">
                <div class="wrap-rate d-flex justify-content-between mx-4">
                    <div class="currency">
                        <h3>Currency</h3>
                        <div>
                            <!-- <div class="flag">
                                <img src="<?= base_url()?>assets/flags_svg/usd.svg" width="100" alt="">
                            </div> -->
                            <?php foreach($rate as $dt){?>
                                <h3 class="namecurrency"><?= $dt->currency?></h3>
                                <?php }?>
                        </div>
                    </div>
                    <div class="rate d-flex">
                        <div class="buy me-5">
                            <h3>We Buy</h3>
                            <?php foreach($rate as $dt){?>
                                <h3><?= $dt->rate?></h3>
                            <?php }?>
                        </div>
                        <div class="sell">
                            <h3>We Sell</h3>
                            <?php foreach($rate as $dt){?>
                                <h3><?= $dt->rate_j?></h3>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 mx-auto">
            <div class="wrap-rate d-flex justify-content-between mx-4">
                    <div class="currency">
                        <h3>Currency</h3>
                        <div>
                            <!-- <div class="flag">
                                <img src="<?= base_url()?>assets/flags_svg/usd.svg" width="100" alt="">
                            </div> -->
                            <?php foreach($rate as $dt){?>
                                <h3 class="namecurrency"><?= $dt->currency?></h3>
                                <?php }?>
                        </div>
                    </div>
                    <div class="rate d-flex">
                        <div class="buy me-5">
                            <h3>We Buy</h3>
                            <?php foreach($rate as $dt){?>
                                <h3><?= $dt->rate?></h3>
                            <?php }?>
                        </div>
                        <div class="sell">
                            <h3>We Sell</h3>
                            <?php foreach($rate as $dt){?>
                                <h3><?= $dt->rate_j?></h3>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="<?= base_url()?>assets/js/sidebarmenu.js"></script>
    <script src="<?= base_url()?>assets/js/app.min.js"></script>
    <script src="<?= base_url()?>assets/js/dashboard.js"></script>
    <!-- <script src="<?= base_url()?>assets/libs/apexcharts/dist/apexcharts.min.js"></script> -->
    <script src="<?= base_url()?>assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="<?= base_url()?>assets/libs/printThis/printThis.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="<?= base_url()?>assets/js/script.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/1.8.2/autoNumeric.js"></script>
	<?php
		if (isset($extra)) {
			$this->load->view($extra);
		}
	?>
</body>
</html>