<?= $this->extend('layout/user') ?>

<?= $this->section('konten') ?>

<div class="app-content content">
    <div class="content-wrapper">
        <!-- Header Section -->
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0 d-inline-block">Beranda</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
                            <li class="breadcrumb-item active">Beranda</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Welcome Section -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h1>Selamat Datang di Toko Kami</h1>
                        <p class="card-text">Silahkan belanja dan nikmati pengalaman berbelanja yang mudah dan menyenangkan.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature Section -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fa fa-shopping-cart fa-3x text-primary mb-2"></i>
                        <h5 class="card-title">Belanja Mudah</h5>
                        <p class="card-text">Cari produk favorit Anda dengan cepat dan mudah.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fa fa-tags fa-3x text-success mb-2"></i>
                        <h5 class="card-title">Kualitas Terbaik</h5>
                        <p class="card-text">Dapatkan penawaran Kualitas terbaik anda dengan berbelanja di toko kami.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fa fa-truck fa-3x text-warning mb-2"></i>
                        <h5 class="card-title">Pengiriman Cepat</h5>
                        <p class="card-text">Produk Anda akan sampai di tujuan dengan cepat dan aman.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
