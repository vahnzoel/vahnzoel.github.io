<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="<?= $logo; ?>" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">E-SPJ</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            NPD
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/program" class="nav-link">
                                <i class="fas fa-bars nav-icon"></i>
                                <p>Program</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kegiatan" class="nav-link">
                                <i class="fas fa-bars nav-icon"></i>
                                <p>Kegiatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/subkegiatan" class="nav-link">
                                <i class="fas fa-bars nav-icon"></i>
                                <p>Sub Kegiatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/item" class="nav-link">
                                <i class="fas fa-bars nav-icon"></i>
                                <p>Item</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/npd" class="nav-link">
                                <i class="fas fa-print nav-icon"></i>
                                <p>Cetak NPD</p>
                            </a>
                        </li>
                    </ul>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            SPJ
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/spj" class="nav-link">
                                <i class="fas fa-bars nav-icon"></i>
                                <p>Daftar SPJ</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php if (session()->get('id') == 1 || session()->get('id') == 2) { ?>
                <li class="nav-header">Configuration</li>
                    <li class="nav-item">
                        <a href="/instansi" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Instansi
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/user" class="nav-link">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                PPTK
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-header">Profile</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <img src="/uploads/foto/<?= session()->get('foto'); ?>" class="img-circle elevation-2" alt="User Image" width="35" height="35">
                        <p>
                            &nbsp;&nbsp;<?= session()->get('nama'); ?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/profil/<?= session()->get('id'); ?>" class="nav-link">
                                <i class="fas fa-address-card nav-icon"></i>
                                <p>Edit Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/logout" class="nav-link">
                                <i class="fas fa-arrow-circle-right nav-icon"></i>
                                <p>Log Out</p>
                            </a>
                        </li>
                    </ul>
                </li>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>