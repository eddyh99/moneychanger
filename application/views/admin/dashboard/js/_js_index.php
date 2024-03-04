<script src="<?= base_url()?>assets/libs/canvasjs/canvasjs-chart/canvasjs.min.js"></script>


<style>
    .canvasjs-chart-credit {
        display: none !important;
    }
</style>

<script>


    $( document ).ready(function() {
        var omzetBulanan = [];

        <?php foreach($omzet as $dt){?>
            omzetBulanan.push({y: <?= $dt->total?>, label: '<?= $dt->cabang?>'});
        <?php }?>

        console.log(omzetBulanan);

        var chartOmzet = new CanvasJS.Chart("omzetBulananChart", {
            animationEnabled: true,
            title: {
                text: "Omzet Bulanan Cabang"
            },
            data: [{
                type: "pie",
                startAngle: 240,
                yValueFormatString: "Rp #,##0.00",
                indexLabel: "{label} {y}",
                dataPoints: omzetBulanan
            }]
        });
        chartOmzet.render();


        var nationality = [];

        <?php foreach($final as $key=>$val){?>
            var tempNas = "<?= $key?>";
            var tempData = []; 
            <?php foreach($val as $dt){?>
                tempData.push({label: "<?= $dt->label?>", y: <?= $dt->y?>});
            <?php }?>
            nationality.push({
                type: "column",
                name: tempNas,
                legendText: tempNas,
                showInLegend: true,
                dataPoints: tempData
            })
        <?php }?>

        console.log(nationality);


        var chartNationality = new CanvasJS.Chart("chartNationality", {
            animationEnabled: true,
            title:{
                text: "Top 3 Nationality Transaksi"
            },	
            axisY: {
                title: "Total Transaksi",
                titleFontColor: "#4F81BC",
                lineColor: "#4F81BC",
                labelFontColor: "#4F81BC",
                tickColor: "#4F81BC"
            },
            // axisY2: {
            //     title: "Millions of Barrels/day",
            //     titleFontColor: "#C0504E",
            //     lineColor: "#C0504E",
            //     labelFontColor: "#C0504E",
            //     tickColor: "#C0504E"
            // },	
            toolTip: {
                shared: true
            },
            data: nationality
        });
        chartNationality.render();





        // var csvData = [
        // { "label": "Bill", "month": "January", "y": 11 },
        // { "label": "Chris", "month": "January", "y": 13 },
        // { "label": "Jesse", "month": "January", "y": 18 },
        // { "label": "Lilia", "month": "January", "y": 65 },

        // { "label": "Bill", "month": "February", "y": 7 },
        // { "label": "Chris", "month": "February", "y": 56 },
        // { "label": "Manue", "month": "February", "y": 23 },

        // { "label": "Bill", "month": "Mars", "y": 11 },
        // { "label": "Chris", "month": "Mars", "y": 13 },
        // { "label": "Jesse", "month": "Mars", "y": 18 },
        // { "label": "Lilia", "month": "Mars", "y": 65 }
        // ];

        // var technicianData = {};
        // var months = {};
        // var monthIndex = 0;

        // for(var i=0; i<csvData.length; i++) {
        // var csvLines = csvData[i];
        // if(!technicianData[csvLines.label]) {
        //     technicianData[csvLines.label] = [];
        // }

        // if(typeof months[csvLines.month] === "undefined") {
        //     months[csvLines.month] = monthIndex;
        //     monthIndex += 1;
        // }
        // technicianData[csvLines.label].push({ "label" : csvLines.month, y: csvLines.y, x: months[csvLines.month]});
        // }
        // //console.log(technicianData)

        // var data = [];

        // for (var technician in technicianData ) {
        //     if (!technicianData.hasOwnProperty(technician)) continue;
        //     data.push({"name": technician, dataPoints: technicianData[technician]})
        // }


        // var chartNationality = new CanvasJS.Chart("chartNationality", {
        // title: {
        //     text: "Work Orders Details"
        // },
        // axisX: {
        //     title: "Month →"
        // },
        // axisY: {
        //     title: "Total Transaksi →"
        // },
        // toolTip: {
        //     content: "{name}: {y}",
        // },
        // data: data

        // });

        // chartNationality.render();

        
    });


    // [

    //     {
    //         United state of america : [
    //             {label: "PT SEDANA", y: 99},
    //             {label: "MONEX KUTA", y: 10},
    //             {label: "MONEX CANGGU", y: 40},
    //         ]
    //     },
    //     {
    //         Italy : [
    //             {label: "PT SEDANA", y: 0},
    //             {label: "MONEX KUTA", y: 70},
    //             {label: "MONEX CANGGU", y: 10},
    //         ]
    //     },
    //     {
    //         Indonesia : [
    //             {label: "PT SEDANA", y: 100},
    //             {label: "MONEX KUTA", y: 0},
    //             {label: "MONEX CANGGU", y: 6},
    //         ]
    //     },
    // ]

</script>