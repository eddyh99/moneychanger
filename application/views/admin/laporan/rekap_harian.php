<!-- MAIN CONTENT START -->
<div class="container-fluid">
    <!--  Row Daftar User -->
    <form action="" method="POST">
            <div class="row my-4">
            <label class="col-form-label col-1">Tanggal</label>
            <div class="col-3">
                <input type="text" id="tgl" name="tgl" class="form-control" value="<?= $tgl?>" autocomplete="off">
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
            <div class="col"><button id="lihat" type="submit" class="btn btn-primary">Lihat</button></div>
        </div>
        </form>
    <!--  Row List User-->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card border-expat w-100">
                <div class="card-body">                    
                    <h3 class=" fw-semibold mb-4 text-center">Rekap Harian</h3>
                    <div class="row">
                        <div class="col-8 mx-auto">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8 mx-auto d-flex justify-content-between">
                            <h5>
                                Tanggal :
                            </h5>
                            <h5 class="fw-bolder">
                                <?= date_format(date_create($tgl), 'd-m-Y')?>
                            </h5>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-8 mx-auto d-flex justify-content-between">
                            <h5>
                                Total Penukaran Bank :
                            </h5>
                            <h5 class="fw-bolder">Rp
                                <?= number_format(@$saldo->total,2,".",",")?>
                            </h5>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-8 mx-auto d-flex justify-content-between">
                            <h5>
                                Total Transaksi Pembelian :
                            </h5>
                            <h5 class="fw-bolder">Rp
                                <?= number_format(@$pendapatan->beli,2,".",",")?>
                            </h5>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-8 mx-auto d-flex justify-content-between">
                            <h5>
                                Total Transaksi Penjualan :
                            </h5>
                            <h5 class="fw-bolder">Rp
                                <?= number_format(@$pendapatan->jual,2,".",",")?>
                            </h5>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-8 mx-auto d-flex justify-content-between">
                            <h5>
                                Modal Awal :
                            </h5>
                            <h5 class="fw-bolder">Rp
                                <?php 
                                    $kasawal = 0;
                                    foreach($kas as $dt){
                                        if($dt->jenis == 'Kas Awal'){
                                            $kasawal += $dt->nominal;
                                        }
                                    }
                                    echo number_format(@$kasawal,2,".",",");
                                ?>
                            </h5>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-8 mx-auto d-flex justify-content-between">
                            <div>
                                <h5>
                                    Kas Keluar :
                                </h5>
                                <?php 
                                    $kaskeluar = 0;
                                    foreach($kas as $dt){
                                        if($dt->jenis == 'Kas Keluar'){
                                            $kaskeluar += $dt->nominal;
                                        
                                ?>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="me-4">(<?= $dt->keterangan?>)</small>
                                        <span class="m-0 fs-4 text-end" style="display: inherit;">Rp <?= number_format($dt->nominal,2,".",",")?></span>
                                    </div>
                                <?php 
                                        }
                                    }
                                ?>
                            </div>
                            <div>
                                <h5 class="m-0 text-end fw-bolder">Rp <?= number_format($kaskeluar,2,".",",")?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-8 mx-auto d-flex justify-content-between">
                            <div>
                                <h5>
                                    Kas Masuk :
                                </h5>
                                <?php 
                                    $kasmasuk = 0;
                                    foreach($kas as $dt){
                                        if($dt->jenis == 'Kas Masuk'){
                                            $kasmasuk += $dt->nominal;
                                        
                                ?>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="me-4">(<?= $dt->keterangan?>)</small>
                                        <span class="m-0 fs-4 text-end" style="display: inherit;">Rp <?= number_format($dt->nominal,2,".",",")?></span>
                                    </div>
                                <?php 
                                        }
                                    }
                                ?>
                            </div>
                            <div>
                                <h5 class="m-0 text-end fw-bolder">Rp <?= number_format($kasmasuk,2,".",",")?></h5>
                            </div>
                        </div>
                    </div>
             
                    <div class="row mt-4">
                        <div class="col-8 mx-auto d-flex justify-content-between">
                            <button id="downloadpdf">Download PDF</button>
                        </div>
                    </div>
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


