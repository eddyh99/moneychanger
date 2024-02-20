
<a class="text-nowrap logo-img d-block px-4 py-9 w-100">
    <img src="<?= base_url()?>assets/img/logo.png" class="dark-logo" alt="Logo-Dark">
    <img src="<?= base_url()?>assets/img/logo-mobile.png" class="light-logo" alt="Logo-light" style="display: none;">
</a>

    <div class="d-none d-xl-flex align-items-center justify-content-center" style="height: calc(100vh - 120px);">
        <img  data-aos="fade-right"  data-aos-duration="3000" src="<?= base_url()?>assets/img/image-login.png" alt="image" class="img-fluid" height="500">
    </div>
</div>
<div class="col-xl-5 col-xxl-4">
    <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
        <div class="auth-max-width col-sm-8 col-md-7 col-xl-9 px-4">
        <h2 class="mb-1 fs-7 fw-bolder">Welcome to <br> Money Changer</h2>
        <p class="mb-7 mt-2">Silahkan login terlebih dahulu</p>
        <form action="<?= base_url()?>auth/auth_login" method="POST">
            <input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username">
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-expat w-100 py-8 mb-4 rounded-2">Login</button>
        </form>
    </div>
</div>


<script>
<?php if (isset($_SESSION["error_validation"])) { ?>
        setTimeout(function() {
            Swal.fire({
                html: '<?= trim(str_replace('"', '', json_encode($_SESSION['error_validation']))) ?>',
                position: 'top',
                showCloseButton: true,
                showConfirmButton: false,
                icon: 'error',
                timer: 2000,
                timerProgressBar: true,
            });
        }, 100);

<?php } 
    if(isset($_SESSION["error"])){
?>
    setTimeout(function() {
        Swal.fire({
            html: '<?= $_SESSION['error'] ?>',
            position: 'top',
            showCloseButton: true,
            showConfirmButton: false,
            icon: 'error',
            timer: 2000,
            timerProgressBar: true,
        });
    }, 100);
<?php }?>
</script>



        