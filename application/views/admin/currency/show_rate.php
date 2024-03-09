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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="<?= base_url()?>assets/css/custom.css">
    
</head>
<body class="bg-black">
    <div class="container-fluid" >
        <div class="row">
            <h1 class="text-center pt-3  fw-bolder text-uppercase text-white"><?= $_SESSION['logged_user']['cabang']?></h1>
            <h1 class="text-center pt-3 pb-5 fw-bolder fst-italic text-white">Authorized Money Changer</h1>
         
            <!-- Slider main container -->
            <div class="swiper d-none">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <div class="row mx-2">
                            <div class="col-6 mx-auto">
                                <table class="w-100">
                                    <thead>
                                        <tr>
                                            <th>Currency</th>
                                            <th>Buy</th>
                                            <th>Sell</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($slide1 as $dt){
                                        ?>
                                            <tr>
                                                <td class="d-flex align-items-center">
                                                    <img src="<?= base_url()?>assets/flags_svg/<?= $dt->flag?>.svg" height="70" class="me-2" alt="" >
                                                    <?= $dt->currency?>
                                                </td>
                                                <td><?= number_format(@$dt->rate,2,".",",")?></td>

                                                <?php if($dt->rate_j == 0.00){?>
                                                    <td>-</td>
                                                <?php }else{?>
                                                    <td>
                                                        <?=  number_format(@$dt->rate_j,2,".",",") ?>    
                                                    </td>
                                                <?php }?>
                                            </tr>
                                        <?php 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6 mx-auto">
                                <table class="w-100">
                                    <thead>
                                        <tr>
                                            <th>Currency</th>
                                            <th>Buy</th>
                                            <th>Sell</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($slide2 as $dt){
                                        ?>
                                            <tr>
                                                <td class="d-flex align-items-center">
                                                    <img src="<?= base_url()?>assets/flags_svg/<?= $dt->flag?>.svg" height="70" class="me-2" alt="" >
                                                    <?= $dt->currency?>
                                                </td>
                                                <td><?= number_format(@$dt->rate,2,".",",")?></td>

                                                <?php if($dt->rate_j == 0.00){?>
                                                    <td>-</td>
                                                <?php }else{?>
                                                    <td>
                                                        <?=  number_format(@$dt->rate_j,2,".",",") ?>    
                                                    </td>
                                                <?php }?>
                                            </tr>
                                        <?php 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="row mx-2">
                            <div class="col-6 mx-auto">
                                <table class="w-100">
                                    <thead>
                                        <tr>
                                            <th>Currency</th>
                                            <th>Buy</th>
                                            <th>Sell</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($slide3 as $dt){
                                        ?>
                                            <tr>
                                                <td class="d-flex align-items-center fw-bolder">
                                                    <img src="<?= base_url()?>assets/flags_svg/<?= $dt->flag?>.svg" height="70" class="me-2" alt="" >
                                                    <?= $dt->currency?>
                                                </td>
                                                <td><?= number_format(@$dt->rate,2,".",",")?></td>
                                                <td><?= number_format(@$dt->rate_j,2,".",",")?></td>
                                            </tr>
                                        <?php 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6 mx-auto">
                                <table class="w-100">
                                    <thead>
                                        <tr>
                                            <th>Currency</th>
                                            <th>Buy</th>
                                            <th>Sell</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($slide4 as $dt){      
                                        ?>
                                            <tr>
                                                <td class="d-flex align-items-center fw-bolder">
                                                    <img src="<?= base_url()?>assets/flags_svg/<?= $dt->flag?>.svg" height="70" class="me-2" alt="" >
                                                    <?= $dt->currency?>
                                                </td>
                                                <td><?= number_format(@$dt->rate,2,".",",")?></td>
                                                <td><?= number_format(@$dt->rate_j,2,".",",")?></td>
                                            </tr>
                                        <?php 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
               <!-- If we need scrollbar -->
                <div class="swiper-scrollbar"></div>
            </div> 

            <div class="swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <div>
                            <div class="grid-container">
                                <div class="grid-container-header">
                                    <h3>Currency</h3>
                                    <h3>Buy</h3>
                                    <h3>Sell</h3>
                                </div>
                                <div class="grid-container-header">
                                    <h3>Currency</h3>
                                    <h3>Buy</h3>
                                    <h3>Sell</h3>
                                </div>
                                <div class="grid-container-header">
                                    <h3>Currency</h3>
                                    <h3>Buy</h3>
                                    <h3>Sell</h3>
                                </div>
                            </div>
                            <ul class="grid-container-body" id="showcurrency">
                                <?php foreach($final as $dt){?>
                                    <li>
                                        <div class="grid-container-data">
                                            <span class="d-flex align-items-center fw-bolder">
                                                <img src="<?= base_url()?>assets/flags_svg/<?= $dt->flag?>.svg" height="70" class="me-2" alt="" >
                                                <?= $dt->currency?>
                                            </span>

                                            <?php if($dt->rate == 0.00){?>
                                                <span>-</span>
                                            <?php }else{?>
                                                <span><?= number_format(@$dt->rate,2,".",",")?></span>
                                            <?php }?>

                                            <?php if($dt->rate_j == 0.00){?>
                                                <span>-</span>
                                            <?php }else{?>
                                                <span><?= number_format(@$dt->rate_j,2,".",",")?></span>
                                            <?php }?>


                                        </div>
                                    </li>
                                <?php }?>

                            </ul>
                        </div>
                    </div>

                    <?php if($final_last != null){?>
                    <div class="swiper-slide">
                        <div>
                            <div class="grid-container">
                                <div class="grid-container-header">
                                    <h3>Currency</h3>
                                    <h3>Buy</h3>
                                    <h3>Sell</h3>
                                </div>
                                <div class="grid-container-header">
                                    <h3>Currency</h3>
                                    <h3>Buy</h3>
                                    <h3>Sell</h3>
                                </div>
                                <div class="grid-container-header">
                                    <h3>Currency</h3>
                                    <h3>Buy</h3>
                                    <h3>Sell</h3>
                                </div>
                            </div>
                            <ul class="grid-container-body" id="example">
                                <?php foreach(@$final_last as $dt){?>
                                    <li>
                                        <div class="grid-container-data">
                                            <span class="d-flex align-items-center fw-bolder">
                                                <img src="<?= base_url()?>assets/flags_svg/<?= $dt->flag?>.svg" height="70" class="me-2" alt="" >
                                                <?= $dt->currency?>
                                            </span>

                                            <?php if($dt->rate == 0.00){?>
                                                <span>-</span>
                                            <?php }else{?>
                                                <span><?= number_format(@$dt->rate,2,".",",")?></span>
                                            <?php }?>

                                            <?php if($dt->rate_j == 0.00){?>
                                                <span>-</span>
                                            <?php }else{?>
                                                <span><?= number_format(@$dt->rate_j,2,".",",")?></span>
                                            <?php }?>


                                        </div>
                                    </li>
                                <?php }?>

                            </ul>
                        </div>
                    </div>
                    <?php }?>
                </div>
               <!-- If we need scrollbar -->
                <div class="swiper-scrollbar"></div>
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
	<?php
		if (isset($extra)) {
			$this->load->view($extra);
		}
	?>

    <script>
        new Sortable(document.getElementById('showcurrency'), {
           
        });
    </script>


</body>
</html>