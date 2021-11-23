<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hagar Manah | <?php echo $title ?></title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <!-- Simplebar -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/vendor/simplebar.min.css" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/app.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/app.rtl.css" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-material-icons.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-material-icons.rtl.css" rel="stylesheet">

    <!-- Font Awesome FREE Icons -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-fontawesome-free.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-fontawesome-free.rtl.css" rel="stylesheet">

    <!-- ion Range Slider -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-ion-rangeslider.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-ion-rangeslider.rtl.css" rel="stylesheet">


    <!-- Flatpickr -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-flatpickr.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-flatpickr.rtl.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-flatpickr-airbnb.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-flatpickr-airbnb.rtl.css" rel="stylesheet">

    <!-- Vector Maps -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/vendor/jqvmap/jqvmap.min.css" rel="stylesheet">

    <!-- Misc -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/bootstrap4/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/DataTables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datepicker/myjqdatepicker.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dropify/dist/css/dropify.min.css">
    <script src="<?php echo base_url(); ?>assets/template/vendor/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/moment.js"></script>
    <script src="<?php echo base_url(); ?>assets/DataTables/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/DataTables/js/dataTables.bootstrap4.js"></script>
    <script src="<?php echo base_url(); ?>assets/datepicker/myjqdatepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dropify/dist/js/dropify.min.js"></script>
    <style>
      [dir=ltr] .modal-backdrop {
        position: relative;
      }
      #dp_wrapper {
        z-index: 2;
      }
    </style>
    <?php if($this->uri->segment(1) == 'Transaksi') { ?>
      <style>
        [dir=ltr] .page__container,[dir=ltr] .page__heading-container{
          max-width: 2000px;
          padding-right: 0;
          padding-left: 0;
        }
        #table-list {
          height: 400px;
        }
        #tabel-list, tbody {
          display:block;
          overflow-y:auto;
          overflow-x: hidden;
          height: 400px;
        }
        #tabel-list, thead, tbody tr {
          display:table;
          width: var(--table-width);
          table-layout:fixed;
        }
        body {
        --table-width: 100%; /* Or any value, this will change dinamically */
        }
        #tabel-bawah, thead, tbody, tr, td {
          border-top: none !important;
        }
        .input {
          border-radius: 10px;
          border-color: #f2a654;
        }
        .input2 {
            border-radius: 10px;
            border-color: #f2a654;
        }

        @keyframes bounce {
          0%{transform: scale(1);}
          50%{transform: scale(1.1);}
          100%{transform: scale(1);}
        }

        .pulse.active {
        animation: bounce 0.3s ease-out 1;
        }

        .controlgroup-textinput{
            padding-top: .22em;
            padding-bottom: .22em;
        }
        .nav-tabs .nav-link:not(.active) {
            border-color: #f2a654 !important;
            color: grey;
        }
        .nav-tabs .nav-link.active {
            border-color: #f2a654 !important;
            background-color: #faa307 !important;
            font-weight: bold !important;
            color: white !important;
        }
        .nav-tabs .nav-link.active h3 {
            color: white !important;
        }
/*        [dir=ltr] .mdk-header-layout__content--scrollable {
          overflow-y: hidden;
        }*/

        [dir=ltr] .modal-backdrop {
          position: relative;
        }
      </style>
    <?php } ?>
</head>