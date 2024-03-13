<style>
    h1{
        font-size: 50px;
    }
    thead {
        border-bottom: 5px solid  #000;
        background-color: #387ADF;
        color: #fff;
    }

    tbody{
        background-color: #fff;
    }

    th, td {
        font-size: 35px;
        padding: 20px 50px;
    }

    tr td {
        font-weight: 800;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .swiper {
        width: 100%;
        height: auto;
    }



    .grid-container-body {
        display: grid;
        /* grid-template-columns: 1fr 1fr 1fr; */
        background-color: #FFFFFF;
        grid-template-areas: "curr-USD50-100 JPY AED" "curr-USD5-10-20 CAD SAR" "curr-USD1-2 SGD CNY" "AUD NZD THB" "EUR MYR PHP" "GBP HKD INR" "CHF KRW ARS";

    }


    /* Coloumn 1 */
    .curr-USD50-100 {
        grid-area: curr-USD50-100;
    }
    
    .curr-USD5-10-20 {
        grid-area: curr-USD5-10-20;
    }
    
    .curr-USD1-2 {
        grid-area: curr-USD1-2;
    }
    
    .curr-AUD {
        grid-area: AUD;
    }
    
    .curr-EUR {
        grid-area: EUR;
    }
     
    .curr-GBP {
        grid-area: GBP;
    }
    
    .curr-CHF {
        grid-area: CHF;
    }
    
    
    
    
    
    /* Coloumn 2 */
    .curr-JPY{
        grid-area: JPY;
    }

    .curr-CAD{
        grid-area: CAD;
    }

    .curr-SGD{
        grid-area: SGD;
    }
    
    .curr-NZD{
        grid-area: NZD;
    }
    
    .curr-MYR{
        grid-area: MYR;
    }
    
    .curr-HKD{
        grid-area: HKD;
    }

    .curr-KRW{
        grid-area: KRW;
    }
    
    
    
    /* Coloumn 3 */
    .curr-AED{
        grid-area: AED;
    }
    
    .curr-SAR{
        grid-area: SAR;
    }
 
    .curr-CNY{
        grid-area: CNY;
    }

    .curr-THB{
        grid-area: THB;
    }
    
    .curr-PHP{
        grid-area: PHP;
    }

    .curr-INR{
        grid-area: INR;
    }
    
    .curr-ARS{
        grid-area: ARS;
    }
    
    

    .grid-container-body li  {
        background-color: #dfdfdf;
        font-size: 30px;
        text-align: center;
        margin: 10px;
        cursor: pointer;
    }



    .grid-container-body-final {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        background-color: #FFFFFF;

    }

    .grid-container-body-final li  {
        background-color: #dfdfdf;
        font-size: 30px;
        text-align: center;
        margin: 10px;
        cursor: pointer;
    }
    

    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto;
    }


    .grid-container-header {
        display: grid;
        grid-template-columns: 33.333333% 33.333333% 33.333333%;
        background-color: #387ADF;
        padding: 10px;
   
    }

    .grid-container-header h3 {
        padding: 20px;
        font-size: 30px;
        text-align: center;
        margin: 10px; 
        color: #ffffff;
    }

    .grid-container-data {
        display: grid;
        grid-template-columns: 33.333333% 33.333333% 33.333333%;
    }

    .grid-container-data span {
        font-size: 30px;
        text-align: center;
        margin: 5px;
        padding: 10px;
    }
    
</style>

<script>

    const swiper = new Swiper('.swiper', {
        loop: true,
        scrollbar: {
            el: '.swiper-scrollbar',
            draggable: false,
        },
        autoplay: {
            delay: 5000,
        },
    });
</script>