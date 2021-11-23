<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18"><?= $title ?></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Hegarmanah</li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

 <div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page">
    <div class="container-fluid page__container">
        <div class="row mt-3 ml-2 mr-2">
            <!-- MENU -->
            <div class="col-xl-7 stretch-card grid-margin">
                <div class="card shadow" style="height: 57rem;">
                    <div class="card-body" style="overflow-y: scroll;">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <?php $i = 0; foreach ($kategori as $k) : ?>  
                                    <a class="nav-item nav-link mr-2 <?= ($i == 0) ? 'active' : '' ?> font-weight-bold" style="border-radius: 7px; border: solid;" id="nav-home-tab<?= $k['kategori'] ?>" data-toggle="tab" href="#nav-home-<?= $k['kategori'] ?>" role="tab" aria-controls="nav-home<?= $k['kategori'] ?>" aria-selected="true"><h3><?= $k['kategori'] ?></h3></a>
                                <?php $i++; endforeach; ?>
                            </div>
                        </nav>
                        <hr>
                        <div class="tab-content" id="nav-tabContent">
                            <?php 
                            $c = 0; foreach ($kategori as $a) : 
                            $kat = $this->transaksi->cari_data('mst_product', ['id_kategori' => $a['id']])->result_array();
                            ?>
                            <div class="tab-pane fade show <?= ($c == 0) ? 'active' : '' ?>" id="nav-home-<?= $a['kategori'] ?>" role="tabpanel" aria-labelledby="nav-home-tab<?= $a['kategori'] ?>">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xl-12 mb-2">
                                            <input type="text" class="form-control search" autocomplete="off">
                                        </div>
                                       <?php $j = 0; $k = 0; foreach ($kat as $t) : 
                                        $stok = $this->transaksi->cari_data('mst_stok', ['id_product'   => $t['id']])->row();
                                        $warna = ['primary', 'danger', 'warning', 'success'];
                                            if ($k > 3) {
                                                $modulus = ($k % 3);
                                                $wr = $modulus;
                                            } else {
                                                $wr = $k;
                                            }
                                            if($stok->stok > 0) {
                                        ?>
                                        <div class="col-xl-6 menu-card" id="menu-<?= $t['id'] ?>">
                                            <div class="card text-white bg-<?= $warna[$wr] ?> text-center nm_product shadow card-hover pulse" style="height: 16rem; cursor: pointer; border-radius: 20px;" data-id="<?= $t['id'] ?>" nama-produk="<?= $t['nama_product'] ?>" data-stok="<?php echo $stok->stok ?>">
                                                <img class="card-img-top" src="<?php echo base_url() ?>assets/img/upload/produk/<?php echo $t['foto_produk'] ?>" alt="<?php echo $t['nama_product'] ?>" height="150" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                                                <div class="card-body">
                                                    <h6 class="text-white mb-2 nama-product" data-id="<?= $t['id'] ?>"><?= $t['nama_product'] ?></h6>
                                                    <h6 class="card-text">Rp. <?= number_format($t['harga'],0,'.','.') ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } else { ?>
                                        <div class="col-xl-6 menu-card" id="menu-<?= $t['id'] ?>">
                                            <div class="card text-white bg-<?= $warna[$wr] ?> text-center shadow card-hover pulse" style="height: 16rem; cursor: pointer; border-radius: 20px; opacity: 0.6;" data-id="<?= $t['id'] ?>" nama-produk="<?= $t['nama_product'] ?>" data-stok="<?php echo $stok->stok ?>">
                                                <img class="card-img-top" src="<?php echo base_url() ?>assets/img/upload/produk/<?php echo $t['foto_produk'] ?>" alt="<?php echo $t['nama_product'] ?>" height="150" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                                                <div class="card-body">
                                                    <h6 class="text-white mb-2 nama-product" data-id="<?= $t['id'] ?>"><?= $t['nama_product'] ?></h6>
                                                    <h6 class="card-text">Rp. <?= number_format($t['harga'],0,'.','.') ?></h6>
                                                    <h6 class="card-text">Stok Tidak Tersedia</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } $j++; $k++; $wr--; endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <?php $c++; endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- TABEL TRANSAKSI -->
            <div class="col-xl-5 stretch-card grid-margin">
                <div class="card shadow" style="height: 57rem;">
                    <div class="card-header">
                        <h5 class="text-title">List Pesanan</h5>
                    </div>
                    <div class="card-body p-0 m-0">
                        <div class="table-responsive">
                            <table class="table table-hover tabel-list" width="100%">
                                <thead class="thead-light">
                                    <th class="font-weight-bold" style="color: black;">Produk</th>
                                    <th class="font-weight-bold" style="color: black;">Harga</th>
                                    <th class="font-weight-bold" style="color: black;">Qty</th>
                                    <th class="font-weight-bold" style="color: black;">Diskon</th>
                                    <th class="font-weight-bold" style="color: black;">Total</th>
                                    <th class="font-weight-bold" style="color: black;">Aksi</th>
                                </thead>
                                <tbody style="height: 500px;">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-header shadow" style="height: 250px;">
                        <table class="table table-no-border mb-2" id="tabel-bawah">
                            <tbody>
                                <tr class="font-weight-bold">
                                    <td style="font-size: 18px;">Diskon</td>
                                    <td class="text-right" style="font-size: 18px;"><span id="total_diskon">Rp. 0</span></td>
                                </tr>
                                <tr class="bg-warning text-white font-weight-bold">
                                    <td style="font-size: 18px;">Total</td>
                                    <td class="text-right" style="font-size: 18px;"><span id="total">Rp. 0</span></td>
                                </tr>
                                <tr class="font-weight-bold">
                                    <td style="font-size: 18px;">Tunai</td>
                                    <td class="text-right">
                                        <div class="row">
                                            <div class="col-md-10 offset-md-2 easy-get4" data-id="tunai">
                                                <input type="text" style="font-size: 18px;"  class="form-control input text-right angka" name="tunai" id="tunai" value="0">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bg-primary text-white font-weight-bold">
                                    <td style="font-size: 18px;">Kembali</td>
                                    <td class="text-right" style="font-size: 18px;"><span id="kembali">Rp. 0</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button class="btn-block btn btn-lg btn-success btn-fw" style="font-size: 18px;" id="btn_transaksi" hidden>TRANSAKSI</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit Produk -->
<div class="modal fade" id="modal_ubah_list" role="dialog" aria-labelledby="exampleModalCenterTitle2" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered w-50" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #faa307;">
        <h5 class="modal-title font-weight-bold text-white judul">Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="mr-2 text-white">&times;</span>
        </button>
      </div>
      <form id="form_list" autocomplete="off">
            <input type="hidden" name="id" id="id">
            <div class="modal-body">
                <div class="col-md-8 offset-md-2 pt-2">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">QTY</label>
                        <div class="col-sm-5 easy-get2" data-id="jumlah">
                            <input type="text" class="form-control angka text-center"  style="font-size: 14px;" name="jumlah" id="jumlah" placeholder="Qty">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Diskon</label>
                        <div class="col-sm-8 easy-get3" data-id="nilai_diskon">
                            <input type="text" class="form-control angka text-right" style="font-size: 14px;" name="nilai_diskon" id="nilai_diskon" placeholder="Masukkan Diskon">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" style="background-color: #faa307;" class="btn text-white" id="simpan_produk">Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal Pelanggan -->
<div class="modal fade" id="modal_info_pelanggan" role="dialog" aria-labelledby="exampleModalCenterTitle2" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #faa307;">
            <h5 class="modal-title font-weight-bold text-white">Informasi Pelanggan</h5>
            <button type="button" class="close close-menu-transaksi" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="mr-2 text-white">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" autocomplete="off" required placeholder="Nama Pelanggan" autofocus>
            </div>
            <div class="form-group">
                <label for="alamat_pelanggan">Alamat Pelanggan</label>
                <textarea id="alamat_pelanggan" required class="form-control"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" style="background-color: #faa307;" class="btn text-white" id="check_out">Check Out</button>
        </div>
    </div>
  </div>
</div>

<!-- Modal Transaksi -->
<div class="modal fade" id="modal_selesai" role="dialog" aria-labelledby="exampleModalCenterTitle2" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered w-75" role="document">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #faa307;">
            <h5 class="modal-title font-weight-bold text-white">Transaksi Berhasil!</h5>
            <button type="button" class="close close-menu-transaksi" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="mr-2 text-white">&times;</span>
            </button>
        </div>
        <div class="modal-body row">
            <div class="col-md-6">
                <a href="<?php echo base_url('Transaksi/cetak_faktur') ?>"  target="_blank">
                    <div class="card text-center shadow pulse c_nota" style="cursor: pointer; border-radius: 10px;">
                        <div class="card-body text-dark">
                            <h4 class="text-primary mb-2"><i class="fa fa-sticky-note fa-3x"></i></h4>
                            <h5 class="card-text">Cetak <br> Faktur</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <div class="card text-center shadow pulse close-menu-transaksi" data-dismiss="modal" style="cursor: pointer; border-radius: 10px;">
                    <div class="card-body">
                        <h4 class="text-warning mb-2"><i class="fa fa-undo fa-3x"></i></h4>
                        <h5 class="card-text">Kembali <br> Transaksi</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<script>
    var tunai = document.getElementById('tunai');
    tunai.addEventListener('keyup', function(e){
        tunai.value = formatRupiah(this.value, '');
    });
    var nilai_diskon = document.getElementById('nilai_diskon');
    nilai_diskon.addEventListener('keyup', function(e){
        nilai_diskon.value = formatRupiah(this.value, '');
    });
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split           = number_string.split(','),
        sisa            = split[0].length % 3,
        rupiah          = split[0].substr(0, sisa),
        ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
        if(ribuan)
        {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
    }
    $(document).ready(function() {
        $('a[data-toggle="tab"]').on('hide.bs.tab', function(e) {
            var $old_tab = $($(e.target).attr("href"));
            var $new_tab = $($(e.relatedTarget).attr("href"));
            if ($new_tab.index() < $old_tab.index()) {
                $old_tab.css('position', 'relative').css("right", "0").show();
                $old_tab.animate({
                "right": "-100%"
                }, 300, function() {
                $old_tab.css("right", 0).removeAttr("style");
                });
                $('.search').val("");
                $('.menu-card').show();
            } else {
                $old_tab.css('position', 'relative').css("left", "0").show();
                $old_tab.animate({
                "left": "-100%"
                }, 300, function() {
                $old_tab.css("left", 0).removeAttr("style");
                });
                $('.search').val("");
                $('.menu-card').show();
            }
        });

        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            var $new_tab = $($(e.target).attr("href"));
            var $old_tab = $($(e.relatedTarget).attr("href"));

            if ($new_tab.index() > $old_tab.index()) {
                $new_tab.css('position', 'relative').css("right", "-2500px");
                $new_tab.animate({
                "right": "0"
                }, 500);
                 $('.search').val("");
                 $('.menu-card').show();
            } else {
                $new_tab.css('position', 'relative').css("left", "-2500px");
                $new_tab.animate({
                "left": "0"
                }, 500);
                 $('.search').val("");
                 $('.menu-card').show();
            }
        });
        // Animasi, mereun
        $(".pulse").click(function(){
            $(this).addClass("active").delay(300).queue(function(next){
                $(this).removeClass("active");
                next();
                $('.search').val("");
                $('.menu-card').show();
            });
        });
        // Live Search
        $('.search').keyup(function(event) {
            var filter = $(this).val();
            $('.nama-product').each(function() {
                var id = $(this).data('id');
                if($(this).text().search(new RegExp(filter, 'i')) < 0) {
                   $('#menu-'+id).hide();
                }
                else
                {
                    $('#menu-'+id).show();
                }
            });
        });
        // Set Button Transaksi agar Dihilangkan kalau kosong
        $('#btn_transaksi').attr('hidden', true);
        // Tabel Pesanan
        var tabel_list = $('.tabel-list').DataTable({
            "processing"        : true,
            "order"             : [],
            "language"  : {
                "emptyTable"    : "List Kosong"
            },
            "columnDefs"        : [{
                "targets"   : [0,1,2,3,4,5],
                "orderable" : false
            }, {
                'targets'   : [2,5],
                'className' : 'text-center',
            }, {
                'targets'   : [4],
                'className' : 'text-right'
            }],
            "paging"        : false,
            "info"          : false,
            "searching"     : false,
        })
        // Gw nggak tau ini apaan
        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        // Nambah Pesanan dari Menu
        $('.nm_product').on('click', function () {
            var id_product = $(this).data('id');
            $.ajax({
                url     : "Transaksi/add_row",
                type    : "POST",
                data    : {id_product:id_product},
                dataType: "JSON",
                success : function (data) {
                    var counter = 1;
                    var  id_product = data.id_product;
                    var nama_product = data.nama_product;
                    if($('.'+id_product+'').text() == nama_product)
                    {
                        if(parseInt($('.jumlah').text()) >= $('.jumlah').data('stok'))
                        {
                            swal({
                                    title               : "Peringatan",
                                    text                : 'Jumlah tidak boleh Melebihi Stok',
                                    buttonsStyling      : false,
                                    type                : 'warning',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                });  
                                return false;
                            }
                        else
                        {
                            $('#jumlah'+id_product+'').text(parseFloat($('#jumlah'+id_product+'').text()) + 1);
                            var nominal     = $('#harga'+data.id_product+'').text().replace("Rp. ", '');
                            var harga       = parseFloat(nominal.split('.').join(''));
                            var jumlah      = parseFloat($('#jumlah'+id_product+'').text());
                            var subtotal    = harga*jumlah;
                            $('#total'+id_product+'').text('Rp. '+separator(subtotal));
                        }
                    }
                    else
                    {
                        tabel_list.row.add([
                            "<div class='"+data.id_product+" nama_product'>"+data.nama_product+"</div>",
                            "<div class='text-right' id='harga"+data.id_product+"'>"+data.total+"</div>",
                            "<label class='badge badge-danger jumlah' id='jumlah"+data.id_product+"' data-stok='"+data.stok+"'>"+counter+"</label>",
                            "<div id='diskon"+data.id_product+"' class='text-right diskon'>"+data.total_diskon+"</div>",
                            "<div class='text-right subtotal' id='total"+data.id_product+"'>Rp. "+separator(data.tot_tr*counter)+"</div>",
                            "<div><span style='cursor:pointer' class='text-success ubah-list mr-3' data-toggle='tooltip' data-placement='top' title='Edit' product='"+data.nama_product+"' data-id='"+data.id_product+"'><i class='fa fa-pencil-alt'></i></span><span style='cursor:pointer' class='text-danger hapus-list' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='"+data.id_product+"'><i class='fa fa-trash-alt'></i></span></div>"
                        ]).draw(false);
                    }
                    if(tabel_list.rows().count() < 1)
                    {
                        $('#diskon').text(data.diskon);
                        $('#total_diskon').text(data.total_diskon);
                        $('#total').text(data.tot_bayar);
                        $('#harga').val(data.tot_tr);
                        var tunai1      = $('#tunai').val();
                        var tunai       = tunai1.replace(".","");
                        var t_kembali   = tunai - data.tot_tr;
                        if (tunai > 0) {
                            $('#kembali').text("Rp. "+separator(t_kembali));
                        }
                    }
                    else
                    {
                        if(tabel_list.rows().count() < 2)
                        {
                            var nominal     = $('.subtotal').text().replace("Rp. ", '');
                            var subtotal    = nominal.split('.').join('');
                            $('#total_diskon').text(data.total_diskon);
                            $('#total').text('Rp. '+separator(subtotal,0,',','.'));
                            var tunai1      = $('#tunai').val();
                            var tunai       = tunai1.split('.').join('');
                            var t_kembali   = tunai - subtotal;
                            if (tunai > 0) {
                                $('#kembali').text("Rp. "+separator(t_kembali));
                            }
                        }
                        else
                        {
                            var subtotal = 0;
                            var diskon   = 0;
                            $('.subtotal').each(function(){
                                var nominal_harga   = $(this).text().replace("Rp. ", '');
                                var harga           = nominal_harga.split('.').join('');
                                subtotal            += parseInt(harga);
                            });
                            $('.diskon').each(function(){
                                var nominal_diskon  = $(this).text().replace("Rp. ", '');
                                var nilai_diskon    = nominal_diskon.split('.').join('');
                                diskon              += parseInt(nilai_diskon);
                            });
                            $('#total_diskon').text('Rp. '+separator(diskon));
                            $('#total').text('Rp. '+separator(subtotal));
                            var tunai1      = $('#tunai').val();
                            var tunai       = tunai1.split('.').join('');
                            var t_kembali   = tunai - subtotal;
                            if (tunai > 0) {
                                $('#kembali').text("Rp. "+separator(t_kembali));
                            }
                        }
                    }
                    $('#btn_transaksi').removeAttr('hidden');
                }
            })
        });
        // untuk Tunai
        $('#tunai').keyup(function(event) {
            var nominal     = $('#total').text().replace("Rp. ", '');
            var subtotal    = nominal.split('.').join('');
            var tunai1      = $(this).val();
            var tunai       = tunai1.split('.').join('');
            var t_kembali   = tunai - subtotal;
            if (tunai > 0) {
                $('#kembali').text("Rp. "+separator(t_kembali));
            }
            else
            {
                $('#kembali').text("Rp. 0");
            }
        });
        // Untuk angka aja
        $(".angka").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#errmsg").html("Digits Only").show().fadeOut("slow");
                return false;
            }
        });
        // close modal transaksi dan trigger reload
        $(".close-menu-transaksi").click(function(event) {
            location.reload();
        });
        // Buka Modul ubah pesanan
        $('.tabel-list').on('click', '.ubah-list', function () {
            var id              = $(this).data('id');
            var product         = $(this).attr('product');
            var nominal_diskon  = $('#diskon'+id+'').text().replace("Rp. ", '');
            var diskon          = parseFloat(nominal_diskon.split('.').join(''));
            var jumlah          = parseFloat($('#jumlah'+id+'').text());
            var stok            = $('#jumlah'+id+'').data('stok');
            $('.judul').text("Product "+product);
            $('#id').val(id);
            $('#jumlah').val(jumlah);
            $('#jumlah').attr({
                'data-stok': stok
            });
            $('#nilai_diskon').val(diskon);
            $('#modal_ubah_list').modal('show');
        })
        // validasi qty
        $('#jumlah').on('keydown keyup', function(e){
            if ($(this).val() > $(this).data('stok') 
                && e.keyCode !== 46
                && e.keyCode !== 8
               ) {
               e.preventDefault();
               $(this).val($(this).data('stok'));
            }
        });
        // Update Pesanan
         $('#simpan_produk').on('click', function () {
            var form_list    = $('#form_list').serialize();
            id = $('#id').val();
            $('#jumlah'+id+'').text($('#jumlah').val());
            $('#diskon'+id+'').text('Rp. '+separator($('#nilai_diskon').val()));
            var nominal_harga       = $('#harga'+id+'').text().replace("Rp. ", '');
            var harga               = parseFloat(nominal_harga.split('.').join(''));
            var nominal_diskon      = $('#diskon'+id+'').text().replace("Rp. ", '');
            var diskon              = parseFloat(nominal_diskon.split('.').join(''));
            var jumlah              = parseFloat($('#jumlah'+id+'').text());
            var subtotal            = (harga*jumlah)-diskon;
            $('#total'+id+'').text('Rp. '+separator(subtotal));
            if(tabel_list.rows().count() < 2)
            {
                $('#total_diskon').text('Rp. '+separator($('#nilai_diskon').val()));
                $('#total').text('Rp. '+separator(subtotal,0,',','.'));
                $('#harga').val(subtotal);
                var tunai1      = $('#tunai').val();
                var tunai       = tunai1.split('.').join('');
                var t_kembali   = tunai - subtotal;
                if (tunai > 0) {
                    $('#kembali').text("Rp. "+separator(t_kembali));
                }
                $('#modal_ubah_list').modal('hide');
            }
            else
            {
                var nilai_subtotal = 0;
                var nilai_diskon   = 0;
                $('.subtotal').each(function(){
                    var nominal_harga   = $(this).text().replace("Rp. ", '');
                    var harga_plain     = nominal_harga.split('.').join('');
                    nilai_subtotal      += parseInt(harga_plain);
                });
                $('.diskon').each(function(){
                    var nominal_diskon  = $(this).text().replace("Rp. ", '');
                    var diskon_plain    = nominal_diskon.split('.').join('');
                    nilai_diskon        += parseInt(diskon_plain);
                });
                $('#total_diskon').text('Rp. '+separator(nilai_diskon));
                $('#total').text('Rp. '+separator(nilai_subtotal));
                var tunai1      = $('#tunai').val();
                var tunai       = tunai1.split('.').join('');
                var t_kembali   = tunai - nilai_subtotal;
                if (tunai > 0) {
                    $('#kembali').text("Rp. "+separator(t_kembali));
                }
                $('#modal_ubah_list').modal('hide');
            }
        })
         // Hapus Pesanan
        $('.tabel-list').on('click', '.hapus-list', function () {
            tabel_list.row($(this).parents('tr')).remove().draw();
            if(tabel_list.rows().count() < 1) 
            {
                $('#btn_transaksi').attr('hidden', true);
                $('#diskon').text('Rp. 0');
                $('#total_diskon').text('Rp. 0');
                $('#total').text('Rp. 0');
                $('#harga').val('Rp. 0');
                $('#kembali').text("Rp. 0");
            }
            else
            {
                $('#btn_transaksi').removeAttr('hidden');
                if(tabel_list.rows().count() < 2)
                {
                    var nominal_subtotal    = $('.subtotal').text().replace("Rp. ", '');
                    var subtotal            = nominal_subtotal.split('.').join('');
                    var nominal_diskon      = $('.diskon').text().replace("Rp. ", '');
                    var diskon              = nominal_diskon.split('.').join('');
                    $('#total_diskon').text('Rp. '+separator(diskon,0,',','.'));
                    $('#total').text('Rp. '+separator(subtotal,0,',','.'));
                    var tunai1      = $('#tunai').val();
                    var tunai       = tunai1.split('.').join('');
                    var t_kembali   = tunai - subtotal;
                    if (tunai > 0) {
                        $('#kembali').text("Rp. "+separator(t_kembali));
                    }
                }
                else
                {
                    var nilai_subtotal = 0;
                    var nilai_diskon   = 0;
                    $('.subtotal').each(function(){
                        var nominal_harga   = $(this).text().replace("Rp. ", '');
                        var harga_plain     = nominal_harga.split('.').join('');
                        nilai_subtotal      += parseInt(harga_plain);
                    });
                    $('.diskon').each(function(){
                        var nominal_diskon  = $(this).text().replace("Rp. ", '');
                        var diskon_plain    = nominal_diskon.split('.').join('');
                        nilai_diskon        += parseInt(diskon_plain);
                    });
                    $('#total_diskon').text('Rp. '+separator(nilai_diskon));
                    $('#total').text('Rp. '+separator(nilai_subtotal));
                    var tunai1      = $('#tunai').val();
                    var tunai       = tunai1.split('.').join('');
                    var t_kembali   = tunai - nilai_subtotal;
                    if (tunai > 0) {
                        $('#kembali').text("Rp. "+separator(t_kembali));
                    }
                }
            }
        })
        // Tombol Transaksi pass ke Modal Data Pelanggan
        $('#btn_transaksi').on('click', function () {
            var nominal_total_harga     = $('#total').text().replace("Rp. ", '');
            var total_harga             = nominal_total_harga.split('.').join('');
            var nominal_tunai           = $('#tunai').val();
            var tunai                   = nominal_tunai.split('.').join('');
            var nominal_kembalian       = $('#kembali').text().replace("Rp. ", '');
            var kembalian               = nominal_kembalian.split('.').join('');
            var nominal_total_diskon    = $('#total_diskon').text().replace("Rp. ", '');
            var total_diskon            = nominal_total_diskon.split('.').join('');
            var nama_product            = [];
            $('.nama_product').each(function() { 
                nama_product.push($(this).text()); 
            });
            var jumlah                  = [];
            $('.jumlah').each(function() {
                jumlah.push($(this).text());
            });
            var discount                = [];
            $('.diskon').each(function() {
                discount.push($(this).text().replace("Rp. ", '').split('.').join(''));
            });
            var subtotal                = [];
            $('.subtotal').each(function() {
                subtotal.push($(this).text().replace("Rp. ", '').split('.').join(''));
            });
            console.log(tunai);
            if(tunai == 0) {
                swal({
                    title               : "Peringatan",
                    text                : 'Nilai Tunai Harap Diisi!',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 1000
                });  
                return false;
            } else if (kembalian < 0) {
                swal({
                    title               : "Peringatan",
                    text                : 'Nilai Tunai Kurang!',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 1000
                });  
                return false;
            } else {
                $('#modal_info_pelanggan').modal('show');
                // $.ajax({
                //     url         : "Transaksi/simpan_transaksi",
                //     method      : "POST",
                //     beforeSend  : function () {
                //         swal({
                //             title   : 'Menunggu',
                //             html    : 'Memproses Data',
                //             onOpen  : () => {
                //                 swal.showLoading();
                //             }
                //         })
                //     },
                //     data        : {total_harga:total_harga, total_diskon:total_diskon, nama_product:nama_product, jumlah:jumlah, discount:discount, subtotal:subtotal},
                //     dataType    : "JSON",
                //     success     : function (data) {
                //         $('#subtotal').text("Rp. 0");
                //         $('#diskon').text("Rp. 0");
                //         $('#total_diskon').text("Rp. 0");
                //         $('#total').text("Rp. 0");
                //         $('#tunai').val(0);
                //         $('#kembali').text("Rp. 0");
                //         $('#btn_transaksi').attr('hidden', true);
                //         swal.close()  
                //         $('#modal_selesai').modal('show');
                //         tabel_list.clear().draw();              
                //     },
                //     error       : function(xhr, status, error) {
                //         var err = eval("(" + xhr.responseText + ")");
                //         alert(err.Message);
                //     }
                // });
                // return false;
            }
        })
        $('#check_out').click(function(event) {
            var nominal_total_harga     = $('#total').text().replace("Rp. ", '');
            var total_harga             = nominal_total_harga.split('.').join('');
            var nominal_kembalian       = $('#kembali').text().replace("Rp. ", '');
            var kembalian               = nominal_kembalian.split('.').join('');
            var nominal_total_diskon    = $('#total_diskon').text().replace("Rp. ", '');
            var total_diskon            = nominal_total_diskon.split('.').join('');
            var nama_pelanggan          = $('#nama_pelanggan').val();
            var alamat_pelanggan        = $('#alamat_pelanggan').val();
            var nama_product            = [];
            $('.nama_product').each(function() { 
                nama_product.push($(this).text()); 
            });
            var jumlah                  = [];
            $('.jumlah').each(function() {
                jumlah.push($(this).text());
            });
            var discount                = [];
            $('.diskon').each(function() {
                discount.push($(this).text().replace("Rp. ", '').split('.').join(''));
            });
            var subtotal                = [];
            $('.subtotal').each(function() {
                subtotal.push($(this).text().replace("Rp. ", '').split('.').join(''));
            });
            if(nama_pelanggan == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Nama Pelanggan Harap Diisi!',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 1000
                });  
                return false;
            } else if (alamat_pelanggan == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Alamat Pelanggan Harap Diisi!',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 1000
                });  
                return false;
            } else {
                $.ajax({
                    url         : "Transaksi/simpan_transaksi",
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
                    data        : {total_harga:total_harga, total_diskon:total_diskon, nama_product:nama_product, jumlah:jumlah, discount:discount, subtotal:subtotal, nama_pelanggan:nama_pelanggan, alamat_pelanggan:alamat_pelanggan},
                    dataType    : "JSON",
                    success     : function (data) {
                        $('#subtotal').text("Rp. 0");
                        $('#diskon').text("Rp. 0");
                        $('#total_diskon').text("Rp. 0");
                        $('#total').text("Rp. 0");
                        $('#tunai').val(0);
                        $('#kembali').text("Rp. 0");
                        $('#btn_transaksi').attr('hidden', true);
                        swal.close()  
                        $('#modal_info_pelanggan').modal('hide');
                        $('#modal_selesai').modal('show');
                        tabel_list.clear().draw();              
                    },
                    error       : function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert(err.Message);
                    }
                });
                return false;
            }
        });
    });
</script>
<!-- IGNORE THIS -->
</div>
</div>