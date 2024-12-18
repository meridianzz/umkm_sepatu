<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>Register with Background Color - Modern Admin - Clean Bootstrap 4 Dashboard HTML Template + Bitcoin Dashboard</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/icheck/custom.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/app.css">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/login-register.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END Custom CSS-->
  </head>
  <body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-4 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                <div class="card-header border-0 pb-0">
                    <div class="card-title text-center">
                        <img src="../../../app-assets/images/logo/logo-dark.png" alt="branding logo">
                    </div>
                </div>
                <div class="card-content">
                    
                    <div class="card-body">
                    <form class="form-horizontal" action="<?= base_url('/registerproses') ?>" method="post" novalidate>
    <fieldset class="form-group position-relative has-icon-left">
        <input type="text" class="form-control" name="username" placeholder="Username" required>
        <div class="form-control-position">
            <i class="ft-user"></i>
        </div>
    </fieldset>
    <fieldset class="form-group position-relative has-icon-left">
        <input type="text" class="form-control" name="nama_pelanggan" placeholder="Nama Lengkap" required>
        <div class="form-control-position">
            <i class="ft-user"></i>
        </div>
    </fieldset>
    <fieldset class="form-group position-relative has-icon-left">
        <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
        <div class="form-control-position">
            <i class="la la-key"></i>
        </div>
    </fieldset>
    <fieldset class="form-group position-relative has-icon-left">
        <input type="text" class="form-control" name="email" placeholder="Email" required>
        <div class="form-control-position">
            <i class="ft-mail"></i>
        </div>
    </fieldset>
    <fieldset class="form-group position-relative has-icon-left">
        <input type="number" class="form-control" name="handphone" placeholder="Nomor HP" required>
        <div class="form-control-position">
            <i class="ft-phone"></i>
        </div>
    </fieldset>
    <fieldset class="form-group position-relative has-icon-left">
        <input type="textarea" class="form-control" name="alamat" placeholder="Alamat" required>
        <div class="form-control-position">
            <i class="ft-map"></i>
        </div>
    </fieldset>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <button type="submit" class="btn btn-outline-info btn-block">
        <i class="ft-user"></i> Register
    </button>
</form>

                    </div>
                    <div class="card-body">
                    <a href="<?= base_url('/login') ?>" class="btn btn-outline-danger btn-block"><i class="ft-unlock"></i> Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="../../../app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <script src="../../../app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="../../../app-assets/js/scripts/forms/form-login-register.js"></script>
    <!-- END PAGE LEVEL JS-->
  </body>
</html>