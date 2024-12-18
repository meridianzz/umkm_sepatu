<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Verifikasi OTP - Modern Admin">
    <meta name="keywords" content="admin template, verify OTP, responsive, user authentication">
    <meta name="author" content="PIXINVENT">
    <title>Verifikasi OTP</title>
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/forms/icheck/custom.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/pages/login-register.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.css">
</head>
<body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>Verifikasi OTP</span></p>
                                <div class="card-body">
                                    <!-- Menampilkan flashdata jika ada -->
                                    <?php if (session()->getFlashdata('error')): ?>
                                        <div class="alert alert-danger">
                                            <?= session()->getFlashdata('error') ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (session()->getFlashdata('success')): ?>
                                        <div class="alert alert-success">
                                            <?= session()->getFlashdata('success') ?>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Tombol kirim ulang OTP hanya muncul jika OTP telah kedaluwarsa -->
                                    <?php if ($isOtpExpired): ?>
                                        <p class="text-center">
                                            <a href="<?= site_url('/resend-otp/' . $pelanggan['kode_pelanggan']) ?>" class="btn btn-outline-warning btn-sm">
                                                Kirim Ulang OTP
                                            </a>
                                        </p>
                                    <?php endif; ?>
                                    <form class="form-horizontal" action="<?= site_url('/verify-otp-process') ?>" method="post" novalidate>
                                        <input type="hidden" name="id_pelanggan" value="<?= $pelanggan['kode_pelanggan'] ?>" />
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" name="otp" class="form-control" placeholder="Masukkan Kode OTP" required>
                                            <div class="form-control-position">
                                                <i class="la la-key"></i>
                                            </div>
                                        </fieldset>

                                        <div class="form-group row">
                                            <button type="submit" class="btn btn-outline-info btn-block">
                                                <i class="ft-unlock"></i> Verifikasi OTP
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>Sudah memverifikasi?</span></p>
                                <div class="card-body">
                                    <a href="<?= base_url('/') ?>" class="btn btn-outline-danger btn-block">
                                        <i class="ft-user"></i> Login
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="<?= base_url() ?>app-assets/vendors/js/vendors.min.js"></script>
    <script src="<?= base_url() ?>app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <script src="<?= base_url() ?>app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="<?= base_url() ?>app-assets/js/core/app-menu.js"></script>
    <script src="<?= base_url() ?>app-assets/js/core/app.js"></script>
    <script src="<?= base_url() ?>app-assets/js/scripts/forms/form-login-register.js"></script>
</body>
</html>
