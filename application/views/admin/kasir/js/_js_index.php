<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- DATE PICKER -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
    $(window).on('load', function() {
        $('#jenisTransaksi').modal('show');
    });

    var jenis;
    $('input[name=jenis]:radio').change(function() {  
        if($(this).val() == "beli"){   
            $('#labelbeli').addClass('bg-monex').addClass('text-white');
            $('#labeljual').removeClass('bg-monex').removeClass('text-white');
            $('.preview-jenis-transaksi').text('Buy');
            $('#jenistransaksi').val('beli')
            jenis = 'beli';
        }
        else if($(this).val() == "jual"){
            $('#labelbeli').removeClass('bg-monex').removeClass('text-white');
            $('#labeljual').addClass('bg-monex').addClass('text-white');
            $('.preview-jenis-transaksi').text('Sell');
            $('#jenistransaksi').val('jual');
            jenis = 'jual';
        }

    });

    $("#tgl").datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        changeMonth: true,
        // minDate: 0,
        yearRange: "-100:+20",
    });


    $(document).ready(function() {
        $('.cabang-select2').select2({
            placeholder: "Pilih Cabang",
            allowClear: true,
            theme: "bootstrap", 
            width: "100%"
        });

        $('.country-select2').select2({
            placeholder: "Pilih Negara",
            allowClear: true,
            theme: "bootstrap", 
            width: "100%"
        });

        $('.passpor-select2').select2({
            placeholder: "Passpor/Identitas",
            tags: true,
		    selectOnClose: true,
            allowClear: true,
            theme: "bootstrap", 
            width: "100%",
            ajax: {
                url: '<?= base_url()?>transaksi/getallcustomer',
                dataType: 'JSON',
                type: "GET",
                delay: 250,
                data: function (params){
                    return {
                        identitas: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.passpor,
                                text: item.passpor,
                                nama: item.nama,
                                nasionality: item.nasionality,
                            }
                        })
                    };
                }
            },
        }).on("select2:select", function (e){
            var selected=e.params.data;
            console.log(selected);
            $('#customer').val(selected.nama)
            $(".country-select2").val(selected.nasionality).trigger("change");
        });
    })

    
    function showRate(e, num){
        var rate; 
        if(jenis == 'jual'){
            rate = Number($(e).find(':selected').attr('data-ratejual'))
        }else{
            rate = Number($(e).find(':selected').attr('data-rate'))
        }

        $("#ratesummary"+num).val(rate.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $("#ratesummary"+num).attr("data-prevrate"+num, rate);
        $("#rate"+num).val(rate);

        if($("#lembar"+num).val() == '' || $("#lembar"+num).val() == null){
            console.log("KOSONG");
        }else{
            var amount = rate * $("#lembar"+num).val();
            $("#amountsummary"+num).text(amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        }

    }

    function lembarCalc(e, num){
        var lembar = Number(e.value);
        var rate = Number($("#rate"+num).val());
        $("#amountsummary"+num).text((rate * lembar).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
    }

    function rateChange(e, num){
        var rate = e.value;
        var prevdata = $(e).attr('data-prevrate'+num);
        rate = parseFloat(rate.split(",").join(""));
        

        if(rate < prevdata){
            Swal.fire({
                html: '<h3>Harga Penawaran Lebih Rendah Dari Rate</h3>',
                position: 'top',
                timer: 3000,
                showCloseButton: true,
                showConfirmButton: false,
                icon: 'warning',
                timer: 2000,
                timerProgressBar: true,
            });
            prevdata = Number(prevdata);    
            $("#ratesummary"+num).val(prevdata.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        }else{
            $("#rate"+num).val(rate);
            if($("#lembar"+num).val() == '' || $("#lembar"+num).val() == null){
                console.log("KOSONG");
            }else{
                var amount = rate * $("#lembar"+num).val();
                $("#amountsummary"+num).text(amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            }

        }



    }


    $(document).ready(function() {


        var max_taps = 30;
        var tap = 1;

        $("#tambahcurrency").click(function(e) {
            e.preventDefault();
            tap++;
            $('.wrapper-currency').append(`
                <div class="row">
                    <hr>
                    <div class="col-12 d-flex justify-content-end">
                        <i class="removecurrency ti ti-square-x  text-danger text-end" id="removecurrency" style="font-size: 26px; cursor: pointer;"></i>
                    </div>
                    <div class="col-6 my-4">
                        <div class="mb-3">
                            <input type="hidden" name="rate[]" id="rate${tap}">
                            <label for="name" class="form-label">Currency</label>
                            <select name="currency[]"  class="currency form-select select-currency-withdraw" onchange="showRate(this, ${tap})">
                                <option value="">--Select Currency--</option>  
                                <?php foreach($currency as $dt){
                                    if(
                                        $dt->currency == 'USD' || $dt->currency == 'AUD' || $dt->currency == 'GBP' ||
                                        $dt->currency == 'RMB' || $dt->currency == 'EUR' || $dt->currency == 'JPY'  
                                    ){  
                                ?>
                                    <option value="<?= $dt->currency?>" data-rate="<?= $dt->rate?>" data-ratejual="<?= $dt->rate_j?>" ><?= $dt->currency?></option>                                                                    
                                <?php 
                                    }
                                }?>

                                <?php foreach($currency as $dt){
                                    if(
                                        $dt->currency != 'USD' && $dt->currency != 'AUD' && $dt->currency != 'GBP' &&
                                        $dt->currency != 'RMB' && $dt->currency != 'EUR' && $dt->currency != 'JPY'  
                                    ){  
                                ?>
                                    <option value="<?= $dt->currency?>" data-rate="<?= $dt->rate?>" data-ratejual="<?= $dt->rate_j?>" ><?= $dt->currency?></option>                                                                    
                                <?php 
                                    }
                                }?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="lembar" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="lembar${tap}" onblur="lembarCalc(this, ${tap})" name="lembar[]" placeholder="Masukkan amount..." required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-6 my-4">
                        <div class="mb-3 pt-1 d-flex flex-column justify-content-center align-items-center">
                            <div>
                                <h6 class="text-center">Rate IDR:</h6>
                                <h4 class="text-center"><input id="ratesummary${tap}" onblur="rateChange(this, ${tap})" type="text" value="0" class="money-input w-100 text-center border-0"></h4>
                            </div>
                            <div class="pt-4">
                                <h6 class="text-center">Total Amount IDR:</h6>
                                <h3 class="text-center"><span id="amountsummary${tap}" class="money-input">0</span></h3>
                            </div>
                        </div>
                    </div>
                </div> 
                

            `);
        });

        $(".wrapper-currency").on("click", ".removecurrency", function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
            tap--;
        })
    })


</script>