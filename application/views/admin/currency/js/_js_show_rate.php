<style>
    h1{
        font-size: 50px;
    }
    thead {
        border-bottom: 5px solid  #000;
        background-color: #7FC7D9;
        color: #000;
    }

    th, td {
        font-size: 35px;
        padding: 20px 50px;
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