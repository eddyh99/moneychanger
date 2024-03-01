<!-- DATE PICKER -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

<script>

    $('#downloadpdf').on('click', function(){
            var doc = new jsPDF();
            var pdf = document.querySelector(".card-body");
            doc.fromHTML(pdf);
            doc.save("GFG.pdf");
    })

    $(document).ready(function(){		
        $( "#tgl" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth: true,
            // minDate: 0,
            yearRange: "-100:+20",
        });

    });
</script>