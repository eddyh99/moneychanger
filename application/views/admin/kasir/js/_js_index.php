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


    var rate;
    var lembar;
    var amount;
    $("#currency").on("change", function(){
        rate = Number($('#currency option:selected').attr('rate'));
        $("#ratesummary").text(rate.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $(".ratesum").val(rate * 2);

        if($("#lembar").val() == '' || $("#lembar").val() == null){
            console.log("KOSONG");
        }else{
            amount = rate * lembar;
            console.log(amount);
            $("#amountsummary").text(amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        }
    })

    $("#lembar").on("blur", function(){
        lembar = $("#lembar").val();
        amount = rate * lembar;
        console.log(amount);
        $("#amountsummary").text(amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        console.log("ON BLUR " +$("#lembar").val());
    })


</script>