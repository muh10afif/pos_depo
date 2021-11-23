<!-- JAVASCRIPT -->
<script src="<?= base_url() ?>assets/template_baru/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/template_baru/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= base_url() ?>assets/template_baru/assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url() ?>assets/template_baru/assets/libs/node-waves/waves.min.js"></script>

<script src="<?= base_url() ?>assets/template_baru/assets/libs/select2/js/select2.min.js"></script>

<!-- form advanced init -->
<script src="<?= base_url() ?>assets/template_baru/assets/js/pages/form-advanced.init.js"></script>

<!-- plugin js -->
<script src="<?= base_url() ?>assets/template_baru/assets/libs/moment/min/moment.min.js"></script>
<!-- <script src="<?= base_url() ?>assets/template_baru/assets/libs/jquery-ui/jquery-ui.min.js"></script> -->
<script src="<?= base_url() ?>assets/template_baru/assets/libs/fullcalendar/fullcalendar.min.js"></script>

<!-- Sweet Alerts js -->
<script src="<?= base_url() ?>assets/swa/sweetalert2.all.min.js"></script>

<!-- Calendar init -->
<script src="<?= base_url() ?>assets/template_baru/assets/js/pages/calendar.init.js"></script>

<!-- App js -->
<script src="<?= base_url() ?>assets/template_baru/assets/js/app.js"></script>

<script src="<?= base_url(); ?>assets/dropify/dist/js/dropify.min.js"></script>

<script src="<?= base_url(); ?>assets/input_spinner/dist/js/jquery.input-counter.min.js"></script>

<script src="<?= base_url(); ?>stepper/jquery.fs.stepper"></script>

<!-- numeric -->
<script src="<?php echo base_url(); ?>assets/numeric/jquery.numeric-only.js"></script>
<!-- number separator -->
<script src="<?php echo base_url(); ?>assets/number_divider/dist/number-divider.min.js"></script>

<script src="<?= base_url() ?>assets/template_baru/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>

<!-- Magnific Popup-->
<script src="<?= base_url() ?>assets/template_baru/assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Tour init js-->
<script src="<?= base_url() ?>assets/template_baru/assets/js/pages/lightbox.init.js"></script>

<!-- Required datatable js -->
<script src="<?= base_url() ?>assets/template_baru/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/template_baru/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="<?= base_url() ?>assets/template_baru/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/template_baru/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?= base_url() ?>assets/template_baru/assets/js/pages/datatables.init.js"></script>

<script src="<?= base_url() ?>assets/template_baru/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script src="<?= base_url() ?>assets/template_baru/assets/js/pages/form-advanced.init.js"></script>

<script>
    $(document).ready(function () {

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

