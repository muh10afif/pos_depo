
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hagar Manah | <?php echo $title ?></title>
    <meta name="robots" content="noindex">
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo.png'); ?>">
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/vendor/simplebar.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/app.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/app.rtl.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-material-icons.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-material-icons.rtl.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-fontawesome-free.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-fontawesome-free.rtl.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-ion-rangeslider.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-ion-rangeslider.rtl.css" rel="stylesheet">
</head>
<body class="layout-login-centered-boxed">
    <div class="layout-login-centered-boxed__form">
        <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-2 navbar-light">
            <a href="<?php echo base_url(); ?>" class="navbar-brand text-center mb-2 mr-0" style="min-width: 0">
                <img class="navbar-brand-icon" src="<?php echo base_url(); ?>assets/img/logo.png" width="43">
            </a>
        </div>
        <div class="card card-body">
            <?php $this->view('messages') ?>
            <form action="<?php echo base_url('Auth/cek') ?>" method="post">
                <div class="form-group">
                    <label class="text-label" for="username">Username:</label>
                    <div class="input-group input-group-merge">
                        <input id="username" type="text" required class="form-control form-control-prepended" name="username" autocomplete="off">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-label" for="password">Password:</label>
                    <div class="input-group input-group-merge">
                        <input id="password" type="password" required class="form-control form-control-prepended" name="password">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fa fa-key"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-block btn-primary" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/template/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/template/vendor/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/vendor/bootstrap.min.js"></script>

    <!-- Simplebar -->
    <script src="<?php echo base_url(); ?>assets/template/vendor/simplebar.min.js"></script>

    <!-- DOM Factory -->
    <script src="<?php echo base_url(); ?>assets/template/vendor/dom-factory.js"></script>

    <!-- MDK -->
    <script src="<?php echo base_url(); ?>assets/template/vendor/material-design-kit.js"></script>

    <!-- Range Slider -->
    <script src="<?php echo base_url(); ?>assets/template/vendor/ion.rangeSlider.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/js/ion-rangeslider.js"></script>

    <!-- App -->
    <script src="<?php echo base_url(); ?>assets/template/js/toggle-check-all.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/js/check-selected-row.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/js/dropdown.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/js/sidebar-mini.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/js/app.js"></script>

    <!-- App Settings (safe to remove) -->
    <script src="<?php echo base_url(); ?>assets/template/js/app-settings.js"></script>





</body>

</html>