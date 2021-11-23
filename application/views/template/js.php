<!-- Bootstrap tether Core JavaScript -->
<script src="<?= base_url()  ?>assets/material-pro/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?= base_url()  ?>assets/material-pro/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- apps -->
<script src="<?= base_url()  ?>assets/material-pro/dist/js/app.min.js"></script>
<script src="<?= base_url()  ?>assets/material-pro/dist/js/app.init.js"></script>
<script src="<?= base_url()  ?>assets/material-pro/dist/js/app-style-switcher.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="<?= base_url()  ?>assets/material-pro/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?= base_url()  ?>assets/material-pro/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="<?= base_url()  ?>assets/material-pro/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?= base_url()  ?>assets/material-pro/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?= base_url()  ?>assets/material-pro/dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<!-- chartist chart -->
<!-- <script src="<?= base_url()  ?>assets/material-pro/libs/chartist/dist/chartist.min.js"></script> -->
<!-- <script src="<?= base_url()  ?>assets/material-pro/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script> -->
<!--c3 JavaScript -->
<!-- <script src="<?= base_url()  ?>assets/material-pro/libs/d3/dist/d3.min.js"></script> -->
<!-- <script src="<?= base_url()  ?>assets/material-pro/libs/c3/c3.min.js"></script> -->
<!-- Vector map JavaScript -->
<!-- <script src="<?= base_url()  ?>assets/material-pro/libs/jvectormap/jquery-jvectormap.min.js"></script> -->
<!-- <script src="<?= base_url()  ?>assets/material-pro/extra-libs/jvector/jquery-jvectormap-us-aea-en.js"></script> -->
<!-- Chart JS -->
<!-- <script src="<?= base_url()  ?>assets/material-pro/dist/js/pages/dashboards/dashboard2.js"></script> -->

<!-- Sweet Alerts js -->
<script src="<?= base_url() ?>assets/swa/sweetalert2.all.min.js"></script>

<script src="<?= base_url(); ?>assets/dropify/dist/js/dropify.min.js"></script>

<script src="<?= base_url(); ?>assets/input_spinner/dist/js/jquery.input-counter.min.js"></script>

<!-- numeric -->
<script src="<?php echo base_url(); ?>assets/numeric/jquery.numeric-only.js"></script>
<!-- number separator -->
<script src="<?php echo base_url(); ?>assets/number_divider/dist/number-divider.min.js"></script>

<script src="<?= base_url()  ?>assets/material-pro/libs/select2/dist/js/select2.full.min.js"></script>
<script src="<?= base_url()  ?>assets/material-pro/libs/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url()  ?>assets/material-pro/dist/js/pages/forms/select2/select2.init.js"></script>

<script src="<?= base_url()  ?>assets/material-pro/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url()  ?>assets/material-pro/libs/magnific-popup/meg.init.js"></script>

<script src="<?= base_url()  ?>assets/material-pro/libs/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url()  ?>assets/material-pro/dist/js/pages/datatable/custom-datatable.js"></script>
<script src="<?= base_url()  ?>assets/material-pro/dist/js/pages/datatable/datatable-basic.init.js"></script>

<script src="<?= base_url()  ?>assets/material-pro/libs/moment/moment.js"></script>
<script src="<?= base_url()  ?>assets/material-pro/libs/moment/locale/id.js"></script>
<script src="<?= base_url()  ?>assets/material-pro/libs/daterangepicker/daterangepicker.js"></script>

<script>
    $(document).ready(function () {

        $('.autoapply').daterangepicker({
            autoApply: true,
            showDropdowns: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });

        $('.numeric').numericOnly();

        $('.number_separator').divide({
            delimiter:'.',
            divideThousand: true, // 1,000..9,999
            delimiterRegExp: /[\.\,\s]/g
        });

        var options = {
            selectors: {
                addButtonSelector		: '.btn-add',
                subtractButtonSelector	: '.btn-subtract',
                inputSelector			: '.counter',
            },
            settings: {
                checkValue: true,
                isReadOnly: true,
            },
        };

        $(".input-counter").inputCounter(options);
        
    })
</script>