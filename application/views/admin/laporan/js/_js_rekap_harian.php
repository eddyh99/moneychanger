<!-- DATE PICKER -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script> -->
<script type="text/javascript" src="<?= base_url()?>assets/libs/html2canvas/html2canvas.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/libs/html2canvas/canvg.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/libs/html2canvas/jspdf.js"></script>

<style>
    
</style>

<script>
    // $('#downloadpdf').on('click', function(){
    //     window.html2canvas = html2canvas;
    //         var doc = new jsPDF();
    //         var pdf = document.querySelector(".card-body");
    //         doc.fromHTML(pdf);
    //         doc.save("<?= NAMETITLE ?>_Laporan Harian_<?= date('d-m-Y')?>.pdf");
    // })

    // $('#downloadpdf').on('click', function(){
    //     var pdf = new jsPDF('p','pt','a3');
    //     var options = {
    //         background: '#fff'        
    //     };
    //     pdf.addHTML(document.querySelector('.card-body'), options, function() {
    //         pdf.save('<?= NAMETITLE ?>_Laporan Harian_<?= date('d-m-Y')?>.pdf');
    //     });
    // })

    $('#downloadpdf').click(()=>{
        var pdf = new jsPDF('p','pt','a4');
        var options = {
            background: '#fff'        
        };
        pdf.addHTML(document.body, options, function() {
            pdf.save('<?= NAMETITLE ?>_Laporan Harian_<?= date('d-m-Y')?>.pdf');
        });
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
