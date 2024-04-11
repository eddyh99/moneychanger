
<style>
    .tgl::-webkit-calendar-picker-indicator {
        padding-left: 150px !important;
    }
    
    input[type="date"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
    }

    table {
        max-width: 100%;
        max-height: 100%;
    }

    table th,
    table td {
        padding: .625em;
        /* text-align: center; */
        font-size: 16px;
    }

    .td-pembelian {
        padding-left: 100px; 
    }


</style>


<script>

    $("#lihat").on("click", function(){
        $("#loading").addClass("d-block");
        $("#loading").removeClass("d-none");
        $.ajax({
            url: "<?=base_url()?>laporan/addingrekapan",
            type: "POST",
            data: {
                tgl: $("#tgl").val(),
                cabang_id: $("#cabang").val()
            },
            success: function (response) {
                $("tr").remove();
                $("#loading").removeClass("d-block");
                $("#loading").addClass("d-none");
                let result = JSON.parse(response);
                let saldopenukaran = result.saldo;
                let pembelian = result.details;
                let totalpembelian = [];
                let totalsaldo = 0 
                let tanggal = $("#tgl").val();
                $(".showtanggal").text(tanggal.split("-").reverse().join("-"));

                saldopenukaran.forEach((el, i) => {
                    let lastsaldo = Number(el.total);
                    totalsaldo += lastsaldo;
                    
                    $("#summarypenukaran").append(`
                        <tr>
                            <td class="text-start">Penukaran ${el.keterangan}</td>
                            <td class="text-start">Rp ${lastsaldo.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}</td>
                            <td></td>
                        </tr>                                            

                    `);
                });


                pembelian.forEach((el, i) => {
                    let lastpembelian = Number(el.pembelian);
                    if (!totalpembelian.includes(lastpembelian)) {
                        totalpembelian.push(lastpembelian);
                    }
                    
                    $("#summarypenukaran").append(`
                        
                        <tr>
                            <td class="text-start td-pembelian">Pembelian ${el.tanggal.slice(0, 10).split("-").reverse().join("-")}</td>
                            <td></td>
                            <td class="text-end">Rp ${lastpembelian.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}</td>
                        </tr>                                            

                    `);
                });

                let jumlahpembelian = totalpembelian.reduce((partialSum, a) => partialSum + a, 0);
                let keuntungan = totalsaldo - jumlahpembelian;
                 let newKeuntungan = keuntungan.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');


                $("#summarypenukaran").append(`
                    <tr>
                        <td class="fw-bolder">Total</td>
                        <td class="text-start fw-semibold">Rp ${totalsaldo.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}</td>
                        <td class="text-end fw-semibold">Rp ${jumlahpembelian.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}</td>
                    </tr>                                           
                `);

               if(keuntungan < 0){
                   $("#summarypenukaran").append(`
                       <tr>
                           <td class="fw-bolder">Keuntungan</td>
                           <td></td>
                           <td class="text-end text-danger fw-bolder">Rp (${keuntungan.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')})</td>
                       </tr>                                           
                   `);
               }else{
                    $("#summarypenukaran").append(`
                       <tr>
                           <td class="fw-bolder">Keuntungan</td>
                           <td></td>
                           <td class="text-end fw-bolder">Rp ${keuntungan.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}</td>
                       </tr>                                           
                   `);
               }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
            }
        });
    })


</script>