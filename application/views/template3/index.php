<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?= $title ?> | Hegarmanah Furniture</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/logo_kecil.png">

    <?php $this->load->view('template/css') ?>

    <script src="<?= base_url() ?>assets/template_baru/assets/libs/jquery/jquery.min.js"></script>

</head>

<body data-layout="detached" data-topbar="colored">

    <div class="container-fluid">
        <!-- Begin page -->
        <div id="layout-wrapper">

            <?php $this->load->view('template/header') ?>

            <!-- ========== Left Sidebar Start ========== -->
            <?php $this->load->view('template/sidebar') ?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content" style="margin-top: 0px;">

                    <?= $konten ?>
                    
                </div>
                <!-- End Page-content -->

                <?php $this->load->view('template/footer') ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

    </div>
    <!-- end container-fluid -->
    
    <?php $this->load->view('template/js') ?>

</body>

</html>