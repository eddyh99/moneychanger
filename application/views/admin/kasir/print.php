<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Transaksi</title>

    <link rel="shortcut icon" type="image/png" href="<?= base_url()?>assets/img/favicon.png" />
	<link rel="stylesheet" href="<?= base_url()?>assets/css/styles.min.css" />

    <style>

        .text-monex {
            color: #263B80;
        }

        .logo-text {
            color: #263B80;
            font-size: 14px;
            font-weight: 800;
        }

        table, th, td {
            border-collapse:collapse;
            border: none;
            width: 100%;
            padding: 5px;
            color: #263B80;
        }

        @media print {
            @page {
                size: 80mm 250mm;
                margin: 2mm;
            }
            .print-transaksi {
                display: block;
                width: 100%;
                height: auto;
            }

        }

        @media screen {
            .print-transaksi {
                display: none;
                width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body>
        <!-- TABS :
        &nbsp; // Regular space
        &ensp; // Two spaces gap
        &emsp; // Four spaces gap -->

    <div class="print-transaksi">
        <div class="d-flex flex-column align-items-center justify-content-center">
            <img class="text-center pt-3 m-0" height="100" width="auto" src="<?= base_url()?>assets/img/printlogo.png" alt="logo">
            <span class="text-center logo-text">PEDAGANG VALUTA ASING/<br>Authorized Money Changer</span>
        </div>
        <div class="d-flex flex-column align-items-center justify-content-center mt-3">
            <span class="text-center text-monex text-uppercase"><?= $_SESSION['logged_user']['cabang']?></span>
            <span class="text-center text-monex">Jalan Wenara Wana No.2 Ubud - Gianyar</span>
            <span class="text-center text-monex fs-2">Telp.<?= $_SESSION['logged_user']['kontak']?></span>
        </div>
        <div>
            <span class="fs-6 text-monex">
                *********************************
            </span>    
        </div>
        <div>
            <h4 class="text-decoration-underline text-center text-monex">Telah kami beli dari</h4>
            <h4  class="text-decoration-underline text-center text-monex">We have bought from</h4>
        </div>
        <div class="d-flex flex-column justify-content-end mx-3">
            <span class="text-end"><?= date("d/m/Y"); ?></span>
            <span class="text-end"><?= date("h:i:s a"); ?></span>
        </div>
        <div class="mx-3 my-4">
            <span class="fs-2 text-monex"><b>Name</b>&emsp;&emsp;&emsp;&ensp;&nbsp;&nbsp;  : <?= $_SESSION['print_transaksi']['nama']?> </span>
            <br>
            <span class="fs-2 text-monex"><b>Address</b>&emsp;&emsp;&nbsp;&ensp; : <?= $_SESSION['print_transaksi']['alamat']?> </span>
            <br>
            <span class="fs-2 text-monex"><b>Nationality</b>&emsp;&nbsp;&nbsp; : <?= $_SESSION['print_transaksi']['nasionality']?></span>
            <br>
            <span class="fs-2 text-monex"><b>No.Passport</b>&ensp; : <?= $_SESSION['print_transaksi']['passpor']?> </span>
        </div>
        <div>
            <!-- <span class="fs-6 text-monex">
                -----------------------------
            </span>     -->
            <table>
                <thead>
                    <th>QUANTITY</th>
                    <th>PRICE</th>
                    <th class="text-end">SUB TOTAL</th>
                </thead>
                <tbody>
                    <!-- <tr>
                        <td>USD <br> 100</td>
                        <td >15,000.00</td>
                        <td class="text-end">538,033,000.00</td>
                    </tr> -->
                    <?php
                        $total = 0; 
                        foreach($_SESSION['print_transaksi']['detail'] as $dt){?>
                        <tr>
                            <td><?= $dt['currency']?> <br> <?= $dt['jumlah']?></td>
                            <td class="money-input">
                                <?php
                                   echo number_format($dt["rate"],2,".",",")
                                ?>
                            </td>
                            <td class="text-end">
                                <?php
                                   echo number_format($dt["rate"] * $dt['jumlah'],2,".",",");
                                   $total = $total + $dt["rate"] * $dt['jumlah'];
                                ?>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
                <tfoot>
                    <th>TOTAL</th>
                    <th>IDR</th>
                    <th class="text-end">
                        <?=  number_format($total,2,".",",")?>
                    </th>
                </tfoot>
            </table>
        </div>

   
        <div class="mx-3 mt-4">
            <h class="text-monex">Term and Condition: </h6>
            <ol>
                <li class="text-monex">
                    Kekurangan penerimaan uang tidak ditanggung setelah keluar kantor/Claim for shortage of cash after leaving out premises can not be considered
                </li>
            </ol>
            <!-- <span class="text-decoration-underline text-start text-monex"></span>
            <span  class="text-decoration-underline text-start text-monex"></span> -->
        </div>
        <div class="mt-3 mx-3 d-flex flex-column justify-content-end align-items-end">
            <span class="text-end text-monex fs-1">
                <?= $_SESSION['logged_user']['kecamatan']?>, 
                <?php 
                    $datenow = date("Y-m-d");
                    echo date('jS F Y', strtotime($datenow));
                ?>
            </span>
            <span class="text-end text-monex text-uppercase fs-1"><?= $_SESSION['logged_user']['cabang']?></span>
        </div>
        <div class="mx-3 d-flex justify-content-between">
            <div>
                <span class="text-monex" style="font-size:8px;">Guest Signature</span><br>
                <input type="text" style="width: 25mm;height: 15mm;">
            </div>
            <div>
                <span class="text-monex" style="font-size:8px;">Cashier <?= $_SESSION['logged_user']['nama']?></span><br>
                <input type="text" style="width: 25mm;height: 15mm;">
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="<?= base_url()?>assets/libs/printThis/printThis.js"></script>
    <script>
        $(`.print-transaksi`).printThis({
            afterPrint: redirectTranskasi,
            removeScripts: true, 
        })

        function redirectTranskasi(){
            window.location.replace("<?= base_url()?>transaksi");
        }

    </script>
</body>
</html>