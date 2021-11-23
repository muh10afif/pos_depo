<style>
    .article {
    box-shadow: 0 15px 8px rgba(0, 0, 0, 0.03);
    box-shadow: 0 15px 8px rgba(0, 0, 0, 0.03);
    background-color: #fff;
    border-radius: 3px;
    border: none;
    position: relative;
    margin-bottom: 30px; }
    .article .article-header {
        height: 170px;
        position: relative;
        overflow: hidden; }
        .article .article-header .article-image {
        background-color: #fbfbfb;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        width: 100%;
        height: 100%;
        z-index: -1; }
        .article .article-header .article-title {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.01) 1%, rgba(0, 0, 0, 0.65) 98%, rgba(0, 0, 0, 0.65) 100%);
        padding: 10px; }
        .article .article-header .article-title h2 {
            font-size: 16px;
            line-height: 24px; }
            .article .article-header .article-title h2 a {
            font-weight: 700;
            text-decoration: none;
            color: #fff; }
    .article .article-details {
        background-color: #fff;
        padding: 20px;
        line-height: 24px; }
        .article .article-details .article-cta {
        text-align: center; }
    .article .article-header .article-badge {
        position: absolute;
        bottom: 10px;
        left: 10px; }
        .article .article-header .article-badge .article-badge-item {
        padding: 7px 15px;
        font-weight: 600;
        color: #fff;
        border-radius: 30px;
        font-size: 12px; }
        .article .article-header .article-badge .article-badge-item .ion, .article .article-header .article-badge .article-badge-item .fas, .article .article-header .article-badge .article-badge-item .far, .article .article-header .article-badge .article-badge-item .fab, .article .article-header .article-badge .article-badge-item .fal {
            margin-right: 3px; }
    .article.article-style-b .article-details .article-title {
        margin-bottom: 10px; }
        .article.article-style-b .article-details .article-title h2 {
        line-height: 22px; }
        .article.article-style-b .article-details .article-title a {
        font-size: 16px;
        font-weight: 600; }
    .article.article-style-b .article-details p {
        color: #34395e; }
    .article.article-style-b .article-details .article-cta {
        text-align: right; }
    .article.article-style-c .article-header {
        height: 233px; }
    .article.article-style-c .article-details .article-category {
        text-transform: uppercase;
        margin-bottom: 5px;
        letter-spacing: 1px;
        color: #34395e; }
        .article.article-style-c .article-details .article-category a {
        font-size: 10px;
        color: #34395e;
        font-weight: 700; }
    .article.article-style-c .article-details .article-title {
        margin-bottom: 10px; }
        .article.article-style-c .article-details .article-title h2 {
        line-height: 22px; }
        .article.article-style-c .article-details .article-title a {
        font-size: 16px;
        font-weight: 600; }
    .article.article-style-c .article-details p {
        color: #34395e; }
    .article.article-style-c .article-user {
        display: inline-block;
        width: 100%;
        margin-top: 20px; }
        .article.article-style-c .article-user img {
        border-radius: 50%;
        float: left;
        width: 45px;
        margin-right: 15px; }
        .article.article-style-c .article-user .user-detail-name {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis; }
        .article.article-style-c .article-user .user-detail-name a {
            font-weight: 700; }

    @media (max-width: 575.98px) {
    .article .article-style-c .article-header {
        height: 225px; } }

    @media (min-width: 768px) and (max-width: 991.98px) {
    .article {
        margin-bottom: 40px; }
        .article .article-header {
        height: 195px !important; }
        .article.article-style-c .article-header {
        height: 155px; } }

    @media (max-width: 1024px) {
    .article.article-style-c .article-header {
        height: 216px; }
    .article .article-header {
        height: 155px; } }

</style>
<!-- start page title -->

<?php if ($this->session->userdata('role') == 2) {
    $hid = '';
} else {
    $hid = 'hidden';
}?>

<div class="row">
    <div class="col-md-6">
        <div class="d-flex justify-content-start mb-3">
            <a href="<?= base_url('produk') ?>"><button class="btn btn-success float-right"><i class="ti-arrow-left mr-2"></i>Kembali</button></a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary float-right" id="tambah_produk" id_kategori="<?= $id_kat ?>" <?= $hid ?>><i class="ti-plus mr-1"></i> Tambah Produk</button>
        </div>
    </div>
</div>


<div class="row">

    <div class="col-xl-12 mt-2 mb-2">    
        <input type="text" class="input3 form-control search" autocomplete="off" placeholder="Cari..">
    </div>

    <?php 
        foreach ($kat as $k): 
        $stok = $this->produk->cari_data('mst_stok', ['id_product' => $k['id']])->row_array();
        ?>

        <div class="col-md-4 col-xl-3 mt-2 mb-3" style="cursor: pointer;" id="pro_<?= $k['id'] ?>">

            <article class="article article-style-c mb-0">
                <div class="article-header">

                        <?php 
                        
                            if ($k['foto_produk'] != null) {
                                $ft = base_url()."assets/img/upload/produk/".$k['foto_produk']; 
                            } else {
                                $ft = base_url()."assets/img/bg.jpg"; 
                            }
                        
                        ?>

                        <a class="image-popup-no-margins" href="<?= $ft ?>">
                        <img hidden src="<?= $ft ?>">
                        
                        <div class="article-image" data-background="<?= $ft ?>" style="background-image: url('<?= $ft ?>');">
                        </div></a>
                </div>
                <div class="article-details mb-0">
                    <div class="article-title text-center">
                        
                        <h5><span class="nama-product" data-id="<?= $k['id'] ?>"><?= ucwords($k['nama_product']) ?></span></h5>
                        <h6 class="text-muted mb-3 mt-0"><mark>Rp. <?= number_format($k['harga'],0,'.','.') ?></mark></h6>

                        <hr>

                        <button type="button" class="btn btn-sm btn-primary mr-1 detail_produk" id_produk="<?= $k['id'] ?>" nama_kat="<?= $nama_kat['kategori'] ?>" have_bahan="<?= $nama_kat['have_bahan'] ?>" nama_produk="<?= $k['nama_product'] ?>" foto_produk="<?= $k['foto_produk'] ?>" id_kategori="<?= $nama_kat['id'] ?>" nm_bahan="<?= $k['nama_bahan'] ?>" bahan="<?= $k['id_bahan'] ?>" merk="<?= $k['id_merk'] ?>" nm_merk="<?= $k['merk'] ?>" ukuran_panjang="<?= $k['ukuran_panjang'] ?>" ukuran_lebar="<?= $k['ukuran_lebar'] ?>" ukuran="<?= $k['tipe_ukuran'] ?>" harga="<?= $k['harga'] ?>" hpp="<?= $k['hpp'] ?>" harga_reseller="<?= $k['harga_reseller'] ?>" stok="<?= $stok['stok'] ?>" id_stok="<?= $stok['id'] ?>">Detail</button>

                        <button type="button" class="btn btn-sm btn-success mr-1 edit_produk" id_produk="<?= $k['id'] ?>" <?= $hid ?> nama_kat="<?= $nama_kat['kategori'] ?>" have_bahan="<?= $nama_kat['have_bahan'] ?>" nama_produk="<?= $k['nama_product'] ?>" foto_produk="<?= $k['foto_produk'] ?>" id_kategori="<?= $nama_kat['id'] ?>" nm_bahan="<?= $k['nama_bahan'] ?>" bahan="<?= $k['id_bahan'] ?>" merk="<?= $k['id_merk'] ?>" nm_merk="<?= $k['merk'] ?>" ukuran_panjang="<?= $k['ukuran_panjang'] ?>" ukuran_lebar="<?= $k['ukuran_lebar'] ?>" ukuran="<?= $k['tipe_ukuran'] ?>" harga="<?= $k['harga'] ?>" hpp="<?= $k['hpp'] ?>" harga_reseller="<?= $k['harga_reseller'] ?>" stok="<?= $stok['stok'] ?>" id_stok="<?= $stok['id'] ?>">Edit</button>
                        <button type="button" class="btn btn-sm btn-danger hapus_produk" id_produk="<?= $k['id'] ?>" gambar="<?= $k['foto_produk'] ?>" nm_produk="<?= $k['nama_product'] ?>" <?= $hid ?>>Hapus</button>

                    </div>
                </div>
            </article> 

        </div>

    <?php endforeach; ?>

</div>

<!-- 02-10-2020 -->
<div class="modal fade modal_produk" role="dialog" aria-labelledby="modal_produk" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="form_produk" method="post" autocomplete="off" class="form-control-line">
                <input type="hidden" name="foto_produk_t" id="foto_produk_t">
                <input type="hidden" name="id_produk" id="id_produk">
                <input type="hidden" name="id_stok" id="id_stok">
                <input type="hidden" name="aksi" id="aksi" value="tambah">
                <input type="hidden" name="id_kategori" id="id_kategori" value="<?= $id_kat ?>">
                <input type="hidden" name="nama_kat" id="nama_kat" value="<?= $nama_kat['kategori'] ?>">
                <input type="hidden" name="have_bahan" id="have_bahan" value="<?= $nama_kat['have_bahan'] ?>">
                <div class="modal-header">
                    <h5 class="modal-title mt-0 font-weight-bold" id="modal_produk">Tambah Produk Kategori <?= $nama_kat['kategori'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row p-3">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="nama_produk" class="col-sm-4 col-form-label">Nama Produk</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" style="font-size: 14px;" name="nama_produk" id="nama_produk" placeholder="Masukkan Nama Produk">
                                </div>
                            </div>  
                            <?php if($nama_kat['have_bahan'] == 1) : ?>
                                <!-- <div class="form-group row">
                                    <label for="bahan" class="col-sm-4 col-form-label">Bahan</label>
                                    <div class="col-sm-8">

                                        <div class="input-group f_bahan">
                                            <select name="bahan" id="bahan" class="form-control select2" style="width: 90%;">
                                                <option value="">Pilih Bahan</option>
                                                <?php foreach ($bahan as $b): ?>
                                                    <option value="<?= $b['id'] ?>"><?= $b['nama_bahan'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="button" data-toggle="tooltip" data-placement="top" title="Tambah Baru Bahan" id="tambah_bahan"><i class="ti-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="input-group ft_bahan" hidden>
                                            <input type="text" name="bahan_baru" id="bahan_baru" class="form-control" placeholder="Masukkan Bahan">
                                            <div class="input-group-append">
                                                <button class="btn btn-danger" type="button" data-toggle="tooltip" data-placement="top" title="Batal Tambah Bahan" id="batal_bahan"><i class="ti-back-left"></i></button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="status_bahan" id="status_bahan" value="lama">

                                    </div>
                                </div> -->
                            <?php endif; ?>
                            
                            <div class="form-group row">
                                <label for="merk" class="col-sm-4 col-form-label">Merk</label>
                                <div class="col-sm-8">
                                    
                                    <div class="input-group f_merk">
                                        <select name="merk" id="merk" class="form-control select2" style="width: 90%;">
                                            <option value="">Pilih Merk</option>
                                            <?php foreach ($merk as $m): ?>
                                                <option value="<?= $m['id'] ?>"><?= ucwords($m['merk']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-success" type="button" data-toggle="tooltip" data-placement="top" title="Tambah Baru Merk" id="tambah_merk"><i class="ti-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="input-group ft_merk" hidden>
                                        <input type="text" name="merk_baru" id="merk_baru" class="form-control" placeholder="Masukkan Merk">
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" type="button" data-toggle="tooltip" data-placement="top" title="Batal Tambah Merk" id="batal_merk"><i class="ti-back-left"></i></button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="status_merk" id="status_merk" value="lama">

                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label for="ukuran" class="col-sm-4 col-form-label">Ukuran</label>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">P</span>
                                                </div>
                                                <input type="text" name="ukuran_panjang" id="ukuran_panjang" class="form-control lp text-right" placeholder="Panjang">
                                                <div class="input-group-append">
                                                    
                                                    <select name="ukuran" id="ukuran_l" class="form-control ukuran">
                                                        <option value="cm">cm</option>
                                                        <option value="m">m</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">L</span>
                                                </div>
                                                <input type="text" name="ukuran_lebar" id="ukuran_lebar" class="form-control lp text-right" placeholder="Lebar">
                                                <div class="input-group-append">
                                                    <select name="ukuran" id="ukuran_p" class="form-control ukuran" style="width: 100%;">
                                                        <option value="cm">cm</option>
                                                        <option value="m">m</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label for="harga" class="col-sm-4 col-form-label">Harga</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-0">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Rp. </span>
                                        </div>
                                        <input type="text" class="form-control numeric number_separator" id="harga" name="harga" placeholder="Masukkan Harga">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label for="hpp" class="col-sm-4 col-form-label">HPP</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Rp. </span>
                                        </div>
                                        <input type="text" class="form-control numeric number_separator" name="hpp" id="hpp" placeholder="Masukkan HPP">
                                    </div>
                                </div>
                            </div>   -->

                            <div class="form-group row row_stok">
                                <label for="stok" class="col-sm-4 col-form-label">Stok Produk</label>
                                <div class="col-sm-8">
                                    <div class="input-counter input-group">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn-subtract btn btn-warning btn-spin kurang" aksi="kurang">
                                                <i class="ti-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="stok" id="stok" class="form-control counter text-center angka_qty" data-min="1" data-default="1">
                                        <div class="input-group-append">
                                            <button type="button" class="btn-add btn btn-warning btn-spin" aksi="tambah">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="foto_produk" class="col-sm-4 col-form-label">Foto</label>
                                <div class="col-sm-8">
                                    <input name="foto_produk" id="foto_produk" type="file" class="dropify" data-max-file-size="5M" data-show-errors="true" data-allowed-file-extensions="jpg png jpeg"/>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6">

                            <!-- <div class="form-group row">
                                <label for="harga_reseller" class="col-sm-4 col-form-label">Harga Reseller</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Rp. </span>
                                        </div>
                                        <input type="text" class="form-control numeric number_separator" name="harga_reseller" id="harga_reseller" placeholder="Masukkan Harga Reseller">
                                    </div>
                                </div>
                            </div> -->
                            
                            
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"><i class="ti-close mr-2"></i>Batal</button>
                    <button type="button" class="btn btn-info" id="btn_simpan"><i class="ti-check mr-2"></i>Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- 02-10-2020 -->
<div class="modal fade modal_detail" tabindex="-1" role="dialog" aria-labelledby="modal_detail" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content f_detail">
            <div class="modal-header">
                <h5 class="modal-title mt-0 font-weight-bold" id="judul_detail_modal">Detail Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row p-3">
                    <div class="col-md-12">
                        <div class="media mb-0">
                            
                            <img class="d-flex align-self-center rounded mr-3 foto_detail" src="" alt="Generic placeholder image" height="300" width="300">
                            <div class="media-body ml-2 table-responsive">
                                <table class="table table-light table-borderless" style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td>Nama Produk</td>
                                            <td id="tb_nm_produk"></td>
                                        </tr>
                                        <tr>
                                            <td>Kategori</td>
                                            <td id="tb_kategori"></td>
                                        </tr>
                                        <?php if($nama_kat['have_bahan'] == 1) : ?>
                                        <!-- <tr>
                                            <td>Bahan</td>
                                            <td id="tb_bahan"></td>
                                        </tr> -->
                                        <?php endif; ?>
                                        <tr>
                                            <td>Merk</td>
                                            <td id="tb_merk"></td>
                                        </tr>
                                        <!-- <tr>
                                            <td>Ukuran</td>
                                            <td id="tb_ukuran"></td>
                                        </tr> -->
                                        <tr>
                                            <td>Harga</td>
                                            <td id="tb_harga"></td>
                                        </tr>
                                        <!-- <tr>
                                            <td>HPP</td>
                                            <td id="tb_hpp"></td>
                                        </tr>
                                        <tr>
                                            <td>Harga Reseller</td>
                                            <td id="tb_harga_reseller"></td>
                                        </tr> -->
                                        <tr>
                                            <td>Stok</td>
                                            <td id="tb_stok"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function () {

        // 07-10-2020

        // Live Search
        $('.search').keyup(function(event) {
            var filter = $(this).val();
            $('.nama-product').each(function() {
                var id = $(this).data('id');

                if($(this).text().search(new RegExp(filter, 'i')) < 0) {
                    $('#pro_'+id).hide();
                }else{
                    $('#pro_'+id).show();
                }
            });
        });

        // 07-10-2020
        
        $('#tambah_bahan').on('click', function () {

            $('.f_bahan').attr('hidden', true);
            $('.ft_bahan').attr('hidden', false).fadeOut('fast').fadeIn();
            $('#bahan').val('').trigger('change');
            $('#bahan_baru').val('');
            $('#status_bahan').val('baru');

        })

        // 07-10-2020
        $('#batal_bahan').on('click', function () {

            $('.f_bahan').attr('hidden', false).fadeOut('fast').fadeIn();
            $('.ft_bahan').attr('hidden', true);
            $('#bahan').val('').trigger('change');
            $('#bahan_baru').val('');
            $('#status_bahan').val('lama');

        })

        // 07-10-2020

        $('#tambah_merk').on('click', function () {

            $('.f_merk').attr('hidden', true);
            $('.ft_merk').attr('hidden', false).fadeOut('fast').fadeIn();
            $('#merk').val('').trigger('change');
            $('#merk_baru').val('');
            $('#status_merk').val('baru');

        })

        // 07-10-2020
        $('#batal_merk').on('click', function () {

            $('.f_merk').attr('hidden', false).fadeOut('fast').fadeIn();
            $('.ft_merk').attr('hidden', true);
            $('#merk').val('').trigger('change');
            $('#merk_baru').val('');
            $('#status_merk').val('lama');
            
        })

        // 02-10-2020

        $('.dropify').dropify({
          messages: 
          {
              'default': 'Seret file atau ketik di sini',
              'replace': 'Seret file atau ketik di sini',
              'remove':  'Hapus',
              'error':   'Maaf, ada kesalahan.'
          }
        });

        // 05-10-2020
        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // 02-10-2020

        $('.hapus_produk').on('click', function () {
            
            var id_pro      = $(this).attr('id_produk');
            var foto        = $(this).attr('gambar');
            var nm_produk   = $(this).attr('nm_produk');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan menghapus produk '+nm_produk+'?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-primary mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {

                    var base_url = "<?= base_url() ?>";

                    $.ajax({
                        url         : base_url+"produk/hapus_produk",
                        method      : "POST",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        data        : {id_produk:id_pro, foto:foto},
                        dataType    : "JSON",
                        success     : function (data) {

                                $('#pro_'+id_pro).remove();

                                swal({
                                    title               : 'Hapus pelanggan',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 
                            
                        },
                        error       : function(xhr, status, error) {
                           
                            swal({
                                    title               : 'Peringatan',
                                    text                : 'Error',
                                    buttonsStyling      : false,
                                    type                : 'error',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                        }

                    })

                    return false;
                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal({
                            title               : 'Batal',
                            text                : 'Anda membatalkan hapus produk!',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 
                }
            })

            
            
        })

        // 05-10-2020
        $('.detail_produk').on('click', function () {

            var id_produk       = $(this).attr('id_produk');
            var id_stok         = $(this).attr('id_stok');
            var nama_kat        = $(this).attr('nama_kat');
            var have_bahan      = $(this).attr('have_bahan');
            var nama_produk     = $(this).attr('nama_produk');
            var foto_produk     = $(this).attr('foto_produk');
            var id_kategori     = $(this).attr('id_kategori');
            var bahan           = $(this).attr('bahan');
            var merk            = $(this).attr('merk');
            var ukuran_panjang  = $(this).attr('ukuran_panjang');
            var ukuran_lebar    = $(this).attr('ukuran_lebar');
            var ukuran          = $(this).attr('ukuran');
            var harga           = $(this).attr('harga');
            var hpp             = $(this).attr('hpp');
            var harga_reseller  = $(this).attr('harga_reseller');
            var stok            = $(this).attr('stok');
            var nm_merk         = $(this).attr('nm_merk');
            var nm_bahan        = $(this).attr('nm_bahan');

            console.log(foto_produk);

            if (foto_produk == '') {
                $('.foto_detail').attr('src', "<?= base_url('assets/img/bg.jpg') ?>");
            } else {
                $('.foto_detail').attr('src', "<?= base_url('assets/img/upload/produk/') ?>"+foto_produk);
            }

            $('#tb_nm_produk').text(": "+nama_produk);
            $('#tb_kategori').text(": "+nama_kat);
            $('#tb_bahan').text(": "+nm_bahan);
            $('#tb_merk').text(": "+nm_merk);
            $('#tb_ukuran').text(": "+ukuran_panjang+ukuran+" x "+ukuran_lebar+ukuran);
            $('#tb_harga').text(": Rp. "+separator(harga));
            $('#tb_hpp').text(": Rp. "+separator(hpp));
            $('#tb_harga_reseller').text(": Rp. "+separator(harga_reseller));
            $('#tb_stok').text(": "+stok);
            // $('.foto_detail').attr('src', "<?= base_url('assets/img/upload/produk/') ?>"+foto_produk);
            
        })

        // 02-10-2020

        $('.edit_produk').on('click', function () {

            $('#aksi').val('ubah');

            var aksi = $('#aksi').val();
            
            if (aksi == 'ubah') {
                $('.row_stok').attr('hidden', true);
            } else {
                $('.row_stok').attr('hidden', false);
            }
            
            var id_produk       = $(this).attr('id_produk');
            var id_stok         = $(this).attr('id_stok');
            var nama_kat        = $(this).attr('nama_kat');
            var have_bahan      = $(this).attr('have_bahan');
            var nama_produk     = $(this).attr('nama_produk');
            var foto_produk     = $(this).attr('foto_produk');
            var id_kategori     = $(this).attr('id_kategori');
            var bahan           = $(this).attr('bahan');
            var merk            = $(this).attr('merk');
            var ukuran_panjang  = $(this).attr('ukuran_panjang');
            var ukuran_lebar    = $(this).attr('ukuran_lebar');
            var ukuran_lebar    = $(this).attr('ukuran_lebar');
            var ukuran          = $(this).attr('ukuran');
            var harga           = $(this).attr('harga');
            var hpp             = $(this).attr('hpp');
            var harga_reseller  = $(this).attr('harga_reseller');
            var stok            = $(this).attr('stok');

            $('#foto_produk_t').val(foto_produk);
            $('#id_produk').val(id_produk);
            $('#id_stok').val(id_stok);
            $('#nama_produk').val(nama_produk);
            $('#bahan').val(bahan).trigger('change');
            $('#merk').val(merk).trigger('change');
            $('#ukuran_lebar').val(ukuran_panjang);
            $('#ukuran_panjang').val(ukuran_lebar);
            $('.ukuran').val(ukuran).trigger('change');
            $('#harga').val(harga);
            $('#hpp').val(hpp);
            $('#harga_reseller').val(harga_reseller);
            $('#stok').val(stok);
            // $('#foto_produk').addClass('dropify');
            // $('#foto_produk').attr('data-default-file', "<?= base_url('assets/img/upload/produk/') ?>"+foto_produk);
            $('#have_bahan').val(have_bahan);
            $('#nama_kat').val(nama_kat);
            $('#id_kategori').val(id_kategori);

            var imagenUrl = "<?= base_url('assets/img/upload/produk/') ?>"+foto_produk;
            var drEvent = $('#foto_produk').dropify(
            {
            defaultFile: imagenUrl
            });
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = imagenUrl;
            drEvent.destroy();
            drEvent.init();

            $('.modal_produk').modal('show');
            
        })

        // 02-10-2020

        $('#tambah_produk').on('click', function () {

            $(".dropify-clear").trigger("click");

            $('#form_produk').trigger('reset');

            $('#stok').val(1);

            $('#aksi').val('tambah');

            $('.modal_produk').modal('show');

            $('.f_merk').attr('hidden', false).fadeOut('fast').fadeIn();
            $('.ft_merk').attr('hidden', true);
            $('#merk').val('').trigger('change');
            $('#merk_baru').val('');
            $('#status_merk').val('lama');

            $('.f_bahan').attr('hidden', false).fadeOut('fast').fadeIn();
            $('.ft_bahan').attr('hidden', true);
            $('#bahan').val('').trigger('change');
            $('#bahan_baru').val('');
            $('#status_bahan').val('lama');
            
        })

        // 02-10-2020

        $('.detail_produk').on('click', function () {
            $('.modal_detail').modal('show');
        })

        // 05-10-2020
        $('#btn_simpan').on('click', function () {
            
            var aksi            = $('#aksi').val();
            var nm_produk       = $('#nama_produk').val();
            var bahan           = $('#bahan').val();
            var merk            = $('#merk').val();
            var ukuran_l        = $('#ukuran_lebar').val();
            var ukuran_p        = $('#ukuran_panjang').val();
            var harga           = $('#harga').val();
            var hpp             = $('#hpp').val();
            var harga_reseller  = $('#harga_reseller').val();
            var stok            = $('#stok').val();
            var foto            = $('#foto_produk').val();
            var id_produk       = $('#id_produk').val();
            var id_stok         = $('#id_stok').val();

            var have_bahan      = $('#have_bahan').val();

            var sts_bahan       = $('#status_bahan').val();
            var sts_merk        = $('#status_merk').val();

            var bahan_baru      = $('#bahan_baru').val();
            var merk_baru       = $('#merk_baru').val();

            var formData        = new FormData($('#form_produk')[0]);

            // 07-10-2020

            if (sts_bahan == 'lama') {
                
                if (bahan == '' && have_bahan == 1) {
            
                    $('#bahan').focus();
            
                    swal({
                        title               : "Peringatan",
                        text                : 'bahan harus terisi !',
                        buttonsStyling      : false,
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 1000
                    }); 
            
                    return false;
                }
            
            } else {
            
                if (bahan_baru == '') {
            
                    $('#bahan_baru').focus();
            
                    swal({
                        title               : "Peringatan",
                        text                : 'bahan harus terisi !',
                        buttonsStyling      : false,
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 1000
                    }); 
            
                    return false;
            
                }
            
            }

            if (sts_merk == 'lama') {
                
                if (merk == '') {
            
                    $('#merk').focus();
            
                    swal({
                        title               : "Peringatan",
                        text                : 'Merk harus terisi !',
                        buttonsStyling      : false,
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 1000
                    }); 
            
                    return false;
                }
            
            } else {
            
                if (merk_baru == '') {
            
                    $('#merk_baru').focus();
            
                    swal({
                        title               : "Peringatan",
                        text                : 'Merk harus terisi !',
                        buttonsStyling      : false,
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 1000
                    }); 
            
                    return false;
            
                }
            
            }

            // if (aksi == 'tambah') {

            //     if (foto == '') {

            //         $('#foto').focus();

            //         swal({
            //             title               : "Peringatan",
            //             text                : 'Foto harus terisi dahulu!',
            //             type                : 'warning',
            //             showConfirmButton   : false,
            //             timer               : 700
            //         }); 

            //         return false;

            //     }
                
            // }

            if (nm_produk == '') {

                $('#nama_produk').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Nama produk harus terisi dahulu!',
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 

                return false;
                
            } else if (ukuran_p == '') {

                $('#ukuran_panjanga').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Ukuran panjang harus terisi dahulu!',
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 

                return false;

            }else if (ukuran_l == '') {

                $('#ukuran_lebar').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Ukuran lebar harus terisi dahulu!',
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 

                return false;

            }else if (hpp == '') {

                $('#hpp').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Hpp harus terisi dahulu!',
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 

                return false;

            }else if (harga_reseller == '') {

                $('#harga_reseller').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Harga reseller harus terisi dahulu!',
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 

                return false;

            } else {

                if (aksi == 'tambah') {
                    url_nya = "<?= base_url('Produk/create') ?>";
                } else {
                    url_nya = "<?= base_url('Produk/update') ?>";
                }

                $.ajax({
                    url         : url_nya,
                    beforeSend :function () {
                        swal({
                            title   : 'Menunggu',
                            html    : 'Memproses data',
                                onOpen: () => {
                                swal.showLoading()
                                }
                            })      
                    },
                    type        : "POST",
                    data        : formData,
                    contentType : false,
                    processData : false,
                    dataType    : "JSON",
                    success: function(data){

                        $('.modal_produk').modal('hide');

                        swal({
                            title               : 'Tambah Produk',
                            text                : 'Data Berhasil Disimpan',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-success",
                            type                : 'success',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 

                        location.reload();

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal({
                            title               : 'Gagal',
                            text                : 'Error',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-success",
                            type                : 'success',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 
                    }
                });

                return false;
            
            }
        })

        // 05-10-2020
        $('.lp').keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        // 05-10-2020
        $('#ukuran_l').on('change', function () {

            var tipe = $(this).val();
            $('#ukuran_p').val(tipe);
            
        })

        // 05-10-2020
        $('#ukuran_p').on('change', function () {

            var tipe = $(this).val();
            $('#ukuran_l').val(tipe);
            
        })


        
    })
</script>