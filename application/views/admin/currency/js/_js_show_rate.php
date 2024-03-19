<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    .poppins-black {
        font-family: "Poppins", sans-serif;
        font-weight: 900;
        font-style: normal;
    }

    h1{
        font-size: 36px;
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
        font-size: 24px;
        padding: 5px;
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
        grid-template-columns: 1fr 1fr 1fr;
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
        background-color: #f0f0f0;
        text-align: center;
        margin: 5px;
        cursor: pointer;
    }

    .grid-container-body li img {
        height: 30px;
    }

    .grid-container-body li .rate  {
        font-weight: 900;
        color: #000000;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
        padding: 0px;
    }



    .grid-container-body-final {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        background-color: #FFFFFF;

    }

    .grid-container-body-final li  {
        background-color: #f0f0f0;
        font-size: 24px;
        text-align: center;
        margin: 5px;
        cursor: pointer;
    }

    .grid-container-body-final li .rate  {
        font-weight: 900;
        color: #000000;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 30px;
    }


    

    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto;
    }


    .grid-container-header {
        display: grid;
        grid-template-columns: 40% 40% 20%;
        background-color: #387ADF;
        padding: 10px;
   
    }

    .grid-container-header h3 {
        /* padding: 5px; */
        font-size: 18px;
        font-weight: 900;
        text-align: center;
        margin: 10px; 
        color: #ffffff;
        font-size: 20px; 
    }

    .grid-container-data {
        display: grid;
        grid-template-columns: 40% 40% 20%;
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
    });
</script>