<!-- DATE PICKER -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    .rekapharian::-webkit-calendar-picker-indicator {
        padding-left: 150px !important;
    }
    
    input[type="date"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
    }

</style>

<script>

    var totalpembelian = [];
    var cabang_flag = false;
    var tglpenukaran_flag = false;
    var tgl;
    var saldo;

    function isitanggal(){
        tglpenukaran_flag = true;
        if(tglpenukaran_flag == true && cabang_flag == true){
            $(".rekapharian").removeAttr('disabled');
            $("#tambahrekap").removeClass('disabled');

            let mdata = {
                tgl:  $('.penukaranbank').val(),
                cabang: $('#cabang').find(":selected").val()
            }

            console.log(mdata);
            $.ajax({
                url: "<?=base_url()?>laporan/get_saldo_penukaran",
                type: "POST",
                data: mdata,
                success: function (response) {
                    let result = JSON.parse(response);
                    saldo = Number(result.total);     
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                }
            });
        }
    }
    
    function isicabang(){
        cabang_flag = true;
        console.log($('.penukaranbank').val());
        if(tglpenukaran_flag == true && cabang_flag == true){
            $(".rekapharian").removeAttr('disabled');
            $("#tambahrekap").removeClass('disabled');


            let mdata = {
                tgl:  $('.penukaranbank').val(),
                cabang: $('#cabang').find(":selected").val()
            }

            $.ajax({
                url: "<?=base_url()?>laporan/get_saldo_penukaran",
                type: "POST",
                data: mdata,
                success: function (response) {
                    let result = JSON.parse(response);
                    saldo = Number(result.total);
                    console.log(saldo);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                }
            });

        }
    }

    function get_pembelian(e, number){

        let tgl = e.target.value;
        let cabang = $('#cabang').find(":selected").val();

        let mdata = {
            tgl: tgl,
            cabang: cabang
        }
        
        $.ajax({
            url: "<?=base_url()?>laporan/get_pembelian",
            type: "POST",
            data: mdata,
            success: function (response) {
                let result = JSON.parse(response);
                let pembelian = Number(result.beli);
                if (!totalpembelian.includes(pembelian)) {
                    totalpembelian.push(pembelian);
                }
                console.log(totalpembelian);
                $('.showpembelian'+number).text(pembelian.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
            }
        });
    }

    $("#lihatkeuntungan").on("click", function(){
        let sumtotal = totalpembelian.reduce((partialSum, a) => partialSum + a, 0);
        let keuntungan = saldo - sumtotal;
        let newKeuntungan = keuntungan.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        if(keuntungan < 0){
            $('.showkeuntungan').text("("+newKeuntungan.replace('-', '')+")");
            $('.showkeuntungan').addClass('text-danger');
        }else{
            $('.showkeuntungan').text(keuntungan.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'))
            $('.showkeuntungan').removeClass('text-danger');
        }
    });

    $("#rekapharian").datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        changeMonth: true,
        minDate: 0,
        yearRange: "-100:+20",
    });

    $("#penukaranbank").datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        changeMonth: true,
        minDate: 0,
        yearRange: "-100:+20",
    });


    $(document).ready(function() {

        $('.cabang-select2').select2({
            placeholder: "Pilih Cabang",
            theme: "bootstrap", 
            width: "100%"
        });


        var max_taps = 30;
        var tap = 1;

        $("#tambahrekap").click(function(e) {
            e.preventDefault();
            tap++;
            $('.wrapper-append').append(`
                <div class="row col-8 mx-auto d-flex align-items-center">
                    <hr>

                    <div class="mb-3 col-6">
                        <label for="rekapharian" class="form-label">Rekap Harian</label>
                        <div class="form-control d-flex">
                            <input type="date" class="rekapharian w-100 border-0 cursor-pointer" name="rekapharian[]"  onchange="get_pembelian(event, ${tap});" autocomplete="off">
                        </div>
                    </div>
                    <div class="mt-3 col-5">
                        <span class="fs-6">Rp <span class="showpembelian${tap}">0</span></span>
                    </div>
                </div>
            `);
        });

        $(".wrapper-append").on("click", ".removecurrency", function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
            tap--;
        });

    });



</script>