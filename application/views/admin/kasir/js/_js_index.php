<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
    $(document).ready(function() {
        $('.country-select2').select2({
            placeholder: "Pilih Username",
            allowClear: true,
            theme: "bootstrap", 
            width: "100%"
        });
    })


    var selectedCurr = [];
    function showRate(e, num){
        var prevValue = []

        prevValue.push(e.value);
        selectedCurr.push(e.value);
        console.log(prevValue);
        console.log(selectedCurr);


        var rate = Number(e.value.slice(4));  
        console.log("SHOW RATE RATE : "+rate);
        $("#ratesummary"+num).text(rate.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $("#rate"+num).val(rate);

        if($("#lembar"+num).val() == '' || $("#lembar"+num).val() == null){
            console.log("KOSONG");
        }else{
            var amount = rate * $("#lembar"+num).val();
            $("#amountsummary"+num).text(amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        }


        // var rate = 0;
        // var lembar;
        // var amount;
        // $("#currency").on("change", function(){
        //     rate = Number($('#currency option:selected').attr('rate'));
        //     $("#ratesummary").text(rate.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        //     $(".ratesum").val(rate * 2);
    
        //     if($("#lembar").val() == '' || $("#lembar").val() == null){
        //         console.log("KOSONG");
        //     }else{
        //         amount = rate * lembar;
        //         console.log(amount);
        //         $("#amountsummary").text(amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        //     }
        // });
    }

    function lembarCalc(e, num){
        var lembar = Number(e.value);
        var rate = Number($("#rate"+num).val());
        console.log("LEMBAR DI RATE : "+rate);
        $("#amountsummary"+num).text((rate * lembar).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
    }

    // $("#lembar").on("blur", function(){
    //     lembar = $("#lembar").val();
    //     amount = rate * lembar;
    //     console.log(amount);
    //     $("#amountsummary").text(amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
    // });


    $(document).ready(function() {
        var max_taps = 30;
        var tap = 1;

        $("#tambahcurrency").click(function(e) {
            e.preventDefault();
            tap++;
            console.log(tap);
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
                                    <option value="<?= $dt->currency?>-<?= $dt->rate?>" rate="<?= $dt->rate?>"><?= $dt->currency?></option>                                                                    
                                <?php 
                                    }
                                }?>

                                <?php foreach($currency as $dt){
                                    if(
                                        $dt->currency != 'USD' && $dt->currency != 'AUD' && $dt->currency != 'GBP' &&
                                        $dt->currency != 'RMB' && $dt->currency != 'EUR' && $dt->currency != 'JPY'  
                                    ){  
                                ?>
                                    <option value="<?= $dt->currency?>-<?= $dt->rate?>" rate="<?= $dt->rate?>"><?= $dt->currency?></option>                                                                    
                                <?php 
                                    }
                                }?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="lembar" class="form-label">Lembar</label>
                            <input type="number" class="form-control" id="lembar${tap}" onblur="lembarCalc(this, ${tap})" name="lembar[]" placeholder="Masukkan jumlah lembar..." required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-6 my-4">
                        <div class="mb-3 pt-1 d-flex flex-column justify-content-center align-items-center">
                        
                            <div>
                                <h6 class="text-center">Rate:</h6>
                                <h4 class="text-center">Rp. <span id="ratesummary${tap}" class="money-input">0</span></h4>
                            </div>
                            <div class="pt-4">
                                <h6 class="text-center">Total Amount:</h6>
                                <h3 class="text-center">Rp. <span id="amountsummary${tap}" class="money-input">0</span></h3>
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