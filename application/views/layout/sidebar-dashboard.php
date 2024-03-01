<!-- Sidebar Start -->
<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="#" class="text-nowrap logo-img pt-4">
                <img src="<?= base_url()?>assets/img/logo.png" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$dash_active?>" href="<?= base_url()?>dashboard" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <?php if($_SESSION['logged_user']['role'] == 'admin'){?>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">MASTER</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow <?= @$master_active?>" href="javascript:void(0)" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-settings"></i>
                        </span>
                        <span class="hide-menu">Setup Master</span>
                    </a>

                    <ul aria-expanded="false" class="collapse first-level <?= @$master_in?>">
                        <li class="sidebar-item">
                            <a href="<?= base_url()?>user" class="sidebar-link <?= @$dropdown_user?>">
                                <div class="round-16 ms-3 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-address-book"></i>
                                </div>
                                <span class="hide-menu">User</span>
                            </a>
                        
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= base_url()?>cabang" class="sidebar-link <?= @$dropdown_cabang?>">
                                <div class="round-16 ms-3 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-building-store"></i>
                                </div>
                                <span class="hide-menu">Cabang</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= base_url()?>staff" class="sidebar-link <?= @$dropdown_staff?>">
                                <div class="round-16 ms-3 d-flex align-items-center justify-content-center">
                                <i class="ti ti-user-plus"></i>
                                </div>
                                <span class="hide-menu">Assign Staff</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= base_url()?>currency/rate_currency" class="sidebar-link <?= @$dropdown_rate?>">
                                <div class="round-16 ms-3 d-flex align-items-center justify-content-center">
                                <i class="ti ti-file-dollar"></i>
                                </div>
                                <span class="hide-menu">Rate Currency</span>
                            </a>
                        </li>
                    </ul>
                </li>
				<li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Transaction</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link  <?= @$penukaran_active?>" href="<?= base_url()?>kas/penukaran" aria-expanded="false">
                        <span>
                            <i class="ti ti-pig-money"></i>
                        </span>
                        <span class="hide-menu">
                            Penukaran Bank
                        </span>
                    </a>
                </li>
                <?php }?>

                <?php if($_SESSION['logged_user']['role'] == 'kasir'){?>
                <li class="sidebar-item">
                    <a class="sidebar-link  <?= @$kas_active?>" href="<?= base_url()?>kas" aria-expanded="false">
                        <span>
                            <i class="ti ti-wallet"></i>
                        </span>
                        <span class="hide-menu">
                            Kas
                        </span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Transaction</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link  <?= @$transaksi_active?>" href="<?= base_url()?>transaksi" aria-expanded="false">
                        <span>
                            <i class="ti ti-pig-money"></i>
                        </span>
                        <span class="hide-menu">
                            Kasir
                        </span>
                    </a>
                </li>
                <?php }?>
                
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Laporan</span>
                </li>


                <li class="sidebar-item">
                    <a class="sidebar-link  <?= @$rekapharian_active?>" href="<?= base_url()?>laporan/harian" aria-expanded="false">
                       <span>
                            <i class="ti ti-report"></i>
                        </span>
                        <span class="hide-menu">
                            Rekap Harian
                        </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link  <?= @$transaksi_harian_active?>" href="<?= base_url()?>transaksi/harian" aria-expanded="false">
                       <span>
                            <i class="ti ti-report-money"></i>
                        </span>
                        <span class="hide-menu">
                            Transaksi Harian
                        </span>
                    </a>
                </li>
				<li class="sidebar-item">
                    <a class="sidebar-link  <?= @$setoran_active?>" href="<?= base_url()?>laporan/penukaran" aria-expanded="false">
                       <span>
                            <i class="ti ti-history"></i>
                        </span>
                        <span class="hide-menu">
                            Penukaran 
                        </span>
                    </a>
                </li>
				<li class="sidebar-item">
                    <a class="sidebar-link  <?= @$lapkas_active?>" href="<?= base_url()?>laporan/kaskeluar" aria-expanded="false">
                       <span>
                            <i class="ti ti-zoom-out-area"></i>
                        </span>
                        <span class="hide-menu">
                            Kas Keluar
                        </span>
                    </a>
                </li>

                <li class="sidebar-item mb-5 pb-5 mt-3">
                    <a class="sidebar-link" href="<?= base_url()?>auth/logout" aria-expanded="false">
                        <span>
                            <i class="ti ti-logout"></i>
                        </span>
                        <span class="hide-menu">
                            Logout
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!--  Sidebar End -->

<!--  Main wrapper -->
<div class="body-wrapper">
    <!--  Header Start -->
    <header class="app-header" style="background-color: #fff; border-bottom: 1px solid #fff; box-shadow: 3px 3px 3px rgba(0,0,0,0.1);">
        <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
            </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown me-3">
                    <span id="clock" class=""></span>
                </li>
                <li class="nav-item dropdown ">
                    <?= @$_SESSION['logged_user']['username']?>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= base_url()?>assets/img/user-2.jpg" alt="" width="35" height="35" class="rounded-circle">
                    </a>
                </li>
            </ul>
        </div>
        </nav>
    </header>
    <!--  Header End -->
