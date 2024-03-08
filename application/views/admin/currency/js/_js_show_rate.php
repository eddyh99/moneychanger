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
    
</style>

<script>

    const swiper = new Swiper('.swiper', {
        loop: true,
        scrollbar: {
            el: '.swiper-scrollbar',
        },
        autoplay: {
            delay: 10000,
        },
    });
</script>