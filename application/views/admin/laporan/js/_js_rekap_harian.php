<!-- DATE PICKER -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer" ></script>

<style>
    
</style>

<script>
    $(document).ready(function(){	
        
        var divHeight = $('#printthis').height();
        var divWidth = $('#printthis').width();

        $('#downloadpdf').click(()=>{
            html2canvas(document.querySelector('#printthis')).then((canvas) => {
                var base64image = canvas.toDataURL('image/png');

                console.log(base64image);

                const { height, width } = canvas;

                var pdf = new jsPDF('p', 'mm',  [width * 4.332, height * 2.332]);

                pdf.addImage(base64image, 'PNG', 0, 0, width, height);
                pdf.save('<?= NAMETITLE ?>_Laporan Harian_<?= date('d-m-Y')?>.pdf'); 
            })
        })


        $( "#tgl" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth: true,
            // minDate: 0,
            yearRange: "-100:+20",
        });

    });
</script>
