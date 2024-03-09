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
        grid-template-columns: 1fr 1fr 1fr;
        background-color: #f2f2f2;

    }



    .grid-container-body li  {
        background-color: #FFFFFF;
        font-size: 30px;
        text-align: center;
        margin: 10px;
        cursor: pointer;
    }

    .grid-container-body li:nth-child(even){
        /* background-color: #A4CE95; */
        border-left: 10px solid #fff;
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
            delay: 10000,
        },
    });
</script>