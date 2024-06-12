<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #003f62;">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand order-1 text-white" href="#page-top">Rental Mobil Wisdom</a>
        <div class="d-flex order-lg-4 order-2">
            <?php if (!empty($data['profile'])) : ?>
                <div class="nav-item d-flex align-items-center">
                    <li class="nav-item dropdown mb-2" style="list-style: none;">

                        <a class="nav-link" href="#user-dropdown" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if (!empty($data['profile']['image'])) : ?>
                                <img src='data:image/jpeg;base64,<?= base64_encode($data['profile']['image']) ?>' class="utama-profile-image rounded-circle ml-2 " alt="Profile Image" style="width: 40px; height: 40px;" />

                            <?php else : ?>
                                <div class='nav-item'>
                                    <span id="user-section">
                                        <span class="me-3" id="user-avatar"><i class="bi bi-person-circle text-white" style="font-size: 35px;"></i></span>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                            <li><a class="dropdown-item" href='<?= BASEURL; ?>/admin/profile'>Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href='<?= BASEURL; ?>/admin/logout'>Logout</a></li>
                        </ul>
                    </li>
                </div>
            <?php else : ?>
                <div class='nav-item'>
                    <a href='<?= BASEURL; ?>/login' class='nav-link text-white'>Login/Sign Up</a>
                </div>
            <?php endif; ?>
            <button class="navbar-toggler order-2 my-2 h-25" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse justify-content-center order-lg-2 order-4" id="navbarResponsive">
        <div id="layoutSidenav" style="background-color: #003f62;">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu" style="text-align: center;">
                <div class="nav">
                    <a class="nav-link" href="<?= BASEURL; ?>/admin/menu">
                        <div class="sb-nav-link-icon">
                            <i class="fa-solid fa-house"></i>
                        </div>
                        Dashboard
                    </a>
                    <a class="nav-link" href="<?= BASEURL; ?>/admin/cars">
                        <div class="sb-nav-link-icon">
                            <i class="fa-solid fa-box"></i>
                        </div>
                        Produk
                    </a>
                    <a class="nav-link" href="<?= BASEURL; ?>/admin/status">
                        <div class="sb-nav-link-icon">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                        Orderan
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>
        </div>
    </div>
</nav>