
<style>
    .tgl::-webkit-calendar-picker-indicator {
        padding-left: 150px !important;
    }
    
    input[type="date"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
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
                $("#loading").removeClass("d-block");
                $("#loading").addClass("d-none");
                
                let result = JSON.parse(response);
                let saldo = result.saldo;
                let totalpembelian = [];
                let tanggal = $("#tgl").val();
                $(".showtanggal").text(tanggal.split("-").reverse().join("-"));
                
                result.details.forEach((el, i) => {
                    let pembelian = Number(el.pembelian);
                    if (!totalpembelian.includes(pembelian)) {
                        totalpembelian.push(pembelian);
                    }

                    $(".tambahrekap").append(`
                        <div class="row mt-4">
                            <div class="col-10 mx-auto d-flex justify-content-between">
                                <h5>
                                    Pembelian ${el.tanggal.slice(0, 10).split("-").reverse().join("-")}
                                </h5>
                                <h5 class="fw-bolder">Rp
                                    <span class="showpembelian">
                                        ${pembelian.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}
                                    </span>
                                </h5>
                            </div>
                        </div>
                    `);  
                })

                let sumtotal = totalpembelian.reduce((partialSum, a) => partialSum + a, 0);
                let keuntungan = saldo - sumtotal;
                let newKeuntungan = keuntungan.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                if(keuntungan < 0){
                    $('.showkeuntungan').text("("+newKeuntungan.replace('-', '')+")");
                    $('.showkeuntungan').addClass('text-danger');
                }else{
                    $('.showkeuntungan').text(newKeuntungan)
                    $('.showkeuntungan').removeClass('text-danger');
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
            }
        });
    })


</script>