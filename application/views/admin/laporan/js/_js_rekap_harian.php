<!-- DATE PICKER -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" />

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script>
    $('#tgl').daterangepicker({
        startDate: moment(),
        opens:'right',
        locale: {
        format: 'DD MMM YYYY'
        }
    });

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
    });
</script>
