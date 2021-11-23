<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <?php
                
                if ($this->session->userdata('role') == 2) {
                    $hid = '';
                } else {
                    $hid = 'hidden';
                }
                
                if ($title == 'Transaksi') {
                    $act = 'selected';
                } else {
                    $act = '';
                }

                if ($judul == 'Produk') {
                    $act2 = 'selected';
                } else {
                    $act2 = '';
                }

                ?>

                <li class="nav-small-cap" style="margin-top: -15px;">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Menu</span>
                </li>
                <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('dashboard') ?>" aria-expanded="false"><i class="mdi mdi-airplay mr-2"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                <li class="sidebar-item <?= $act2 ?>"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('produk') ?>" aria-expanded="false"><i class="mdi mdi-collage mr-2"></i><span class="hide-menu">Produk</span></a>
                </li>
                <li class="sidebar-item" <?= $hid ?>> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('kategori') ?>" aria-expanded="false"><i class="mdi mdi-google-circles-extended mr-2"></i><span class="hide-menu">Kategori</span></a>
                </li>
                <!-- <li class="sidebar-item" <?= $hid ?>> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('bahan') ?>" aria-expanded="false"><i class="mdi mdi-cube mr-2"></i><span class="hide-menu">Bahan</span></a>
                </li> -->
                <li class="sidebar-item" <?= $hid ?>> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('merk') ?>" aria-expanded="false"><i class="mdi mdi-codepen mr-2"></i><span class="hide-menu">Merk</span></a>
                </li>
                <!-- <li class="sidebar-item" <?= $hid ?>> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('jenis') ?>" aria-expanded="false"><i class="mdi mdi-widgets mr-2"></i><span class="hide-menu">Jenis</span></a>
                </li> -->
                <li class="sidebar-item" <?= $hid ?>> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('pelanggan') ?>" aria-expanded="false"><i class="mdi mdi-account-card-details mr-2"></i><span class="hide-menu">Pelanggan</span></a>
                </li>
                <li class="sidebar-item" <?= $hid ?>> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('user') ?>" aria-expanded="false"><i class="mdi mdi-account-multiple mr-2"></i><span class="hide-menu">User</span></a>
                </li>
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Transaksi</span>
                </li>
                <?php 
                    $hbs = $this->session->userdata('stok_habis');
                    
                    if ($hbs == 0) {
                        $hid_h = 'hidden';
                    } else {
                        $hid_h = '';
                    }
                ?>
                <li class="sidebar-item" <?= $hid ?>> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('stok') ?>" aria-expanded="false"><i class="mdi mdi-google-circles-group mr-2"></i>
                    <span class="hide-menu mr-2">Stok</span><span class="badge badge-pill float-right b_stok_habis" style="background-color: red; color: white;" <?= $hid_h ?>><?= $this->session->userdata('stok_habis'); ?></span></a>
                </li>
                <li class="sidebar-item"> 
                    <!-- data-toggle="modal" data-target="#login-modal" -->
                    <a class="sidebar-link waves-effect waves-dark sidebar-link tr" href="<?= base_url('transaksi') ?>"  aria-expanded="false" ><i class="mdi mdi-tag-text-outline mr-2"></i><span class="hide-menu">Transaksi</span></a>
                </li>
                <li class="sidebar-item" <?= $hid ?>> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('hutang') ?>" aria-expanded="false"><i class="mdi mdi-note-text mr-2"></i><span class="hide-menu">Hutang</span></a>
                </li>
                <li class="sidebar-item" <?= $hid ?>> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('piutang') ?>" aria-expanded="false"><i class="mdi mdi-cash-multiple mr-2"></i><span class="hide-menu">Piutang</span></a>
                </li>
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Report</span>
                </li>
                <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('report') ?>" aria-expanded="false"><i class="mdi mdi-file-document mr-2"></i><span class="hide-menu">Report</span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer d-flex justify-content-center">
        <!-- item-->
        <!-- <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a> -->
        <!-- item-->
        <a href="<?= base_url('auth/out') ?>" class="link" data-toggle="tooltip" title="Logout"><i class="ti-power-off"></i></a>
    </div>
    <!-- End Bottom points-->
</aside>

<!-- SignIn modal content -->
<div id="login-modal" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center font-weight-bold mt-2 mb-4">
                   <h3 class="display-6">Transaksi</h3>
                </div>

                <form action="<?= base_url('transaksi/tampil_halaman') ?>" method="POST" class="pl-3 pr-3 form-control-line">

                    <div class="form-group row">
                        <label for="pelanggan" class="col-sm-12 col-form-label">Pilih Pelanggan</label>
                        <div class="col-sm-12 text-center">
                            <select name="pelanggan" id="pelanggan_t" class="form-control  select2" style="width: 100%;">
                                    
                            </select>
                        </div>
                    </div>  

                    <div class="form-group row">
                        <label for="nama_jenis" class="col-sm-12 col-form-label">Jenis</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control text-center" name="jenis" id="jenis_t" readonly>
                        </div>
                    </div>  

                    <input type="hidden" name="diskon" id="diskon_t">
                    <input type="hidden" name="nama" id="nama_t">
                    <input type="hidden" name="no_telp" id="no_telp_t">
                    <input type="hidden" name="alamat" id="alamat_t">
                    <input type="hidden" name="id_pelanggan" id="id_plg_t">

                    <div class="form-group text-center" style="margin-top: 30px;">
                        <button class="btn btn-rounded btn-danger mr-2" type="button" onclick="location.reload()"><i class="ti-close mr-2"></i>Batal Masuk</button>
                        <button class="btn btn-rounded btn-primary" id="btn_masuk" type="submit" disabled><i class="ti-angle-double-right mr-2" ></i>Masuk Transaksi</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function () {

        // var url     = "<?= base_url() ?>";
        // var url_b   = url.replace('depo/transaksi', 'depo');

        // $.ajax({
        //     url         : url+"transaksi/ambil_option_pelanggan",
        //     method      : "POST",
        //     dataType    : "JSON",
        //     success     : function (data) {
        //         swal.close();

        //         $('#pelanggan_t').html(data.option);
                
        //     },
        //     error       : function(xhr, status, error) {
        //         var err = eval("(" + xhr.responseText + ")");
        //         alert(err.Message);
        //     }

        // })

        // 22-10-2020
        // $('.tr').on('click', function () {

        //     var url     = "<?= base_url() ?>";
        //     var url_b   = url.replace('depo/transaksi', 'depo');

        //     $.ajax({
        //         url         : url+"transaksi/ambil_option_pelanggan",
        //         method      : "POST",
        //         dataType    : "JSON",
        //         success     : function (data) {
        //             swal.close();

        //             $('#pelanggan_t').html(data.option);
                    
        //         },
        //         error       : function(xhr, status, error) {
        //             var err = eval("(" + xhr.responseText + ")");
        //             alert(err.Message);
        //         }

        //     })
            
        // })

        // 16-10-2020
        $('#pelanggan_t').on('change', function () {

            var jenis       = $(this).find(':selected').attr('jenis');
            var diskon      = $(this).find(':selected').attr('diskon');
            var no_telp     = $(this).find(':selected').attr('no_telp');
            var alamat      = $(this).find(':selected').attr('alamat');
            var nama        = $(this).find(':selected').text();
            var id_plg      = $(this).val();

            if (jenis == null) {
                jenis = '';
                $('#btn_masuk').attr('disabled', true);
            } else {
                jenis = jenis;
                $('#btn_masuk').attr('disabled', false);
            }

            $('#jenis_t').val(jenis);
            $('#diskon_t').val(diskon);
            $('#nama_t').val(nama);
            $('#no_telp_t').val(no_telp);
            $('#alamat_t').val(alamat);
            $('#id_plg_t').val(id_plg);
            
        })
        
    })
</script>