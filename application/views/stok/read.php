<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-info p-3">
                <button class="btn float-right btn-danger" id="retur_stok"><i class="ti-reload mr-2"></i>Retur Barang</button>
                <button class="btn float-right btn-light mr-2" id="tambah_stok"><i class="ti-plus mr-2"></i>Tambah Stok</button>
            
                <h4 id="judul" class="font-weight-bold text-white mb-0 mt-2">Stok</h4>
            </div>
            <div class="card-body table-responsive">

                <ul class="nav nav-tabs nav-justified nav-bordered mb-3 customtab">
                    <li class="nav-item">
                        <a href="#home1" data-toggle="tab" aria-expanded="false"
                            class="nav-link rounded-0 active">
                            <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                            <span class="d-none d-lg-block">Stok Ada<span class="ml-2 badge badge-pill badge-success t_ada"><?= $t_ada ?></span></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile1" data-toggle="tab" aria-expanded="true"
                            class="nav-link rounded-0">
                            <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                            <span class="d-none d-lg-block">Stok Habis<span class="ml-2 badge badge-pill t_habis" style="background-color: red; color: white;"><?= $t_habis ?></span></span> 
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="home1" role="tabpanel">
                        <p class="mb-0 mt-2">
                            <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"  id="tabel_stok" width="100%" cellspacing="0">
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Produk</th>
                                        <th width="20%">Stok</th>
                                        <th width="10%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        
                                </tbody>
                            </table>
                        </p>
                    </div>
                    <div class="tab-pane" id="profile1" role="tabpanel">
                        <p class="mb-0 mt-2">
                            <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"  id="tabel_stok_habis" width="100%" cellspacing="0">
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Produk</th>
                                        <th width="20%">Stok</th>
                                        <th width="10%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        
                                </tbody>
                            </table>
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_stok" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="judul_modal">Tambah Stok</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-dark">&times;</span>
        </button>
      </div>
        <form id="form_stok" autocomplete="off" method="POST" class="form-control-line">
            <input type="hidden" name="id_stok" id="id_stok">
            <input type="hidden" name="aksi" id="aksi" value="Tambah">
            <div class="modal-body">
                <div class="col-md-12 p-3">
                    <div class="form-group row">
                        <label for="produk" class="col-sm-4 col-form-label">Produk</label>
                        <div class="col-sm-8">
                            <select name="produk" id="produk" class="form-control select2" style="width: 100%;">
                                <option value="">Pilih Produk</option>
                                <?php foreach ($produk as $p): ?>
                                    <option value="<?= $p['id'] ?>" stok="<?= $p['stok'] ?>" id_stok="<?= $p['id_stok'] ?>" harga="<?= $p['harga'] ?>"><?= $p['nama_product'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="stok_saat_ini" class="col-sm-4 col-form-label">Stok Saat Ini</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-center" name="stok_saat_ini" id="stok_saat_ini" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nilai_stok" class="col-sm-4 col-form-label t_stok">Tambah Stok</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-center number_separator numeric" name="nilai_stok" id="nilai_stok" placeholder="Masukkan Tambah Stok" disabled>

                            <!-- <div class="input-counter input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn-subtract btn btn-warning btn-spin kurang" aksi="kurang">
                                        <i class="ti-minus"></i>
                                    </button>
                                </div>
                                <input name="nilai_stok" id="nilai_stok" class="form-control counter number_separator numeric text-center" data-min="1" data-default="1">
                                <div class="input-group-append">
                                    <button type="button" class="btn-add btn btn-warning btn-spin" aksi="tambah">
                                        <i class="ti-plus"></i>
                                    </button>
                                </div>
                            </div> -->

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="total_stok" class="col-sm-4 col-form-label">Total Stok</label>
                        <div class="col-sm-8">
                            <input type="text" name="total_stok" class="form-control text-center" id="total_stok" readonly>
                        </div>
                    </div>
                    <div class="form-group row r_hutang">
                        <div class="col-md-12">
                            <input type="checkbox" id="hutang" name="hutang" class="material-inputs chk-col-red"/>
                            <label for="hutang"><mark>HUTANG</mark></label>
                        </div>
                    </div>
                    <div class="form-group row f_hutang" hidden>
                        <label for="total_stok" class="col-sm-4 col-form-label">Toko</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="id_pelanggan" name="id_pelanggan" style="width: 100%;">
                                <option value="" tot_piutang="">Pilih Pelanggan/Toko</option>
                                <?php foreach ($list_nama as $n): ?>
                                    <option value="<?= $n['id'] ?>"><?= $n['pelanggan'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row f_hutang" hidden>
                        <label for="total_hutang" class="col-sm-4 col-form-label">Total Hutang</label>
                        <div class="col-sm-8">
                            <input type="text" name="total_hutang" class="form-control text-center" id="total_hutang" readonly>
                        </div>
                    </div>
                    <input type="hidden" name="harga_pro" id="harga_pro">
                    <input type="hidden" name="status_hutang" id="status_hutang" value="tidak">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='mdi mdi-close mr-1'></i>Batal</button>
                <button type="button" class="btn btn-info" id="simpan_stok" disabled><i class='mdi mdi-check mr-1'></i>Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_detail" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-full-width" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="judul_detail">Detail Stok</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
        </button>
      </div>
        <form action="<?= base_url('Stok/download_file') ?>" autocomplete="off" method="POST">
            <input type="hidden" id="aksi_report" name="jns">
            <input type="hidden" id="id_stok_report" name="id_stok_report">
            <input type="hidden" id="nama_produk_report" name="nama_produk_report">
            <div class="modal-body">
                <div class="row">
                <div class="col-md-3">
                    <div class="alert alert-info mb-0" role="alert">
                        <div class="row">
                            <div class="col-md-8 font-weight-bold">Barang Masuk :</div>
                            <div class="col-md-4 font-weight-bold t_masuk text-right">100</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="alert alert-success mb-0" role="alert">
                        <div class="row">
                            <div class="col-md-8 font-weight-bold">Barang Keluar :</div>
                            <div class="col-md-4 font-weight-bold t_keluar text-right">100</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="alert alert-danger mb-0" role="alert">
                        <div class="row">
                            <div class="col-md-8 font-weight-bold">Barang Retur :</div>
                            <div class="col-md-4 font-weight-bold t_retur text-right">100</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="alert alert-primary mb-0" role="alert">
                        <div class="row">
                            <div class="col-md-8 font-weight-bold">Stok :</div>
                            <div class="col-md-4 font-weight-bold t_stok2 text-right">100</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 p-3 mt-2 table-responsive">
                    <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"  id="tabel_detail" width="100%" cellspacing="0">
                        <thead class="thead-light text-center">
                            <tr>
                                <!-- <th width="5%">No</th> -->
                                <th>Barang Masuk</th>
                                <th>Barang Keluar</th>
                                <th>Barang Retur</th>
                                <th>Stok</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info mr-2" type="submit" name="export" data="pdf"><i class="mdi mdi-file-pdf-box mr-2"></i>Download PDF</button>
                <button class="btn btn-warning mr-2" type="submit" name="export" data="excel"><i class="mdi mdi-file-excel-box mr-2"></i>Download Excel</button>
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="mdi mdi-close mr-2"></i>Close</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>

    $(document).ready(function () {

        // 19-10-2020
        $('#id_pelanggan').on('change', function () {

            var isi     = $(this).val();
            var hutang  = $('#total_hutang').val().replace('.','');

            if (isi == '') {
                $('#simpan_stok').attr('disabled', true);
            } else {
                if (hutang != 0) {
                    $('#simpan_stok').attr('disabled', false);
                } else {
                    $('#simpan_stok').attr('disabled', true);
                }
            }
            
        })

        // 19-10-2020
        $('#hutang').on('change', function () {

            var isi         = $(this).is(":checked");
            var id_pel      = $('#id_pelanggan').val();
            var nilai_stok  = $('#nilai_stok').val();

            if (isi == true) {
                if (id_pel == '') {
                    $('#simpan_stok').attr('disabled', true);
                } else {
                    $('#simpan_stok').attr('disabled', false);
                }

                $('#status_hutang').val('ya');
                $('.f_hutang').attr('hidden', false);
                // $('.f_hutang').fadeOut('fast').fadeIn();
            } else {

                if (nilai_stok != '') {
                    $('#simpan_stok').attr('disabled', false);
                } else {
                    $('#simpan_stok').attr('disabled', true);
                }
                
                $('#status_hutang').val('tidak');
                $('.f_hutang').attr('hidden', true);
                // $('.f_hutang').fadeIn('fast').fadeOut();
            }

            

        })

        // 06-10-2020

        $('button[name="export"]').on('click', function () {
            var jns = $(this).attr('data');

            $('#aksi_report').val(jns);
        })

        // 02-10-2020

        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $('#nilai_stok').on('keyup', function () {

            var nilai           = $(this).val().replace('.','');
            var stok_saat_ini   = $('#stok_saat_ini').val();
            var aksi            = $('#aksi').val();
            var harga_pro       = $('#harga_pro').val();

            var cek_hutang      = $('#hutang').is(":checked");
            var id_pel          = $('#id_pelanggan').val();

            if (nilai == '') {
                hutang     = 0;
            } else {
                hutang     = harga_pro * nilai;
            }

            $('#total_hutang').val(separator(hutang));

            var total;

            if (aksi == 'Tambah') {
                total   = parseInt(stok_saat_ini) + parseInt((nilai == '') ? 0 : nilai) ;
            } else {
                total   = parseInt(stok_saat_ini) - parseInt((nilai == '') ? 0 : nilai);
            }
            
            if (nilai == '' || nilai == 0) {
                $('#simpan_stok').attr('disabled', true);
            } else {
                if (total < 0) {
                    $('#simpan_stok').attr('disabled', true);
                } else {

                    if (cek_hutang == true) {
                        if (id_pel == '') {
                            $('#simpan_stok').attr('disabled', true);
                        } else {
                            $('#simpan_stok').attr('disabled', false);
                        }
                    } else {
                        $('#simpan_stok').attr('disabled', false);
                    }

                }
            }

            $('#total_stok').val(separator(total));
        })

        // 02-10-2020

        $('.number_separator').divide({
            delimiter:'.',
            divideThousand: true, // 1,000..9,999
            delimiterRegExp: /[\.\,\s]/g
        });

        $('.numeric').numericOnly();

        // 02-10-2020

        $('#produk').on('change', function () {

            var id_produk   = $(this).val();
            var stok        = $(this).find(':selected').attr('stok');
            var id_stok     = $(this).find(':selected').attr('id_stok');
            var harga       = $(this).find(':selected').attr('harga');
            var nilai_stok  = $('#nilai_stok').val().replace('.','');
            var aksi        = $('#aksi').val();

            var cek_hutang  = $('#hutang').is(":checked");
            var id_pel      = $('#id_pelanggan').val();

            $('#id_stok').val(id_stok);
            $('#harga_pro').val(harga);

            if (nilai_stok == '') {
                if (id_produk == '') {
                  nilai_stok = 0;  
                }
                nilai_stok = 0;
                hutang     = 0;
            } else {
                nilai_stok = nilai_stok;
                hutang     = harga * nilai_stok;
            }

            $('#total_hutang').val(separator(isNaN(hutang) ? 0 : hutang));

            var total;

            if (aksi == 'Tambah') {
                total = parseInt(stok) + parseInt(nilai_stok);
            } else {
                total = parseInt(stok) - parseInt(nilai_stok);
            }

            if (id_produk == '') {
                $('#nilai_stok').attr('disabled', true);
                $('#simpan_stok').attr('disabled', true);
                $('#nilai_stok').val('')
            } else {
                if (nilai_stok == '' || nilai_stok == 0) {
                    
                        $('#nilai_stok').attr('disabled', false);
                        $('#simpan_stok').attr('disabled', true);
                } else {
                    if (total < 0) {
                        $('#simpan_stok').attr('disabled', true);
                    } else {

                        if (cek_hutang == true) {
                            if (id_pel == '') {
                                $('#simpan_stok').attr('disabled', true);
                            } else {
                                $('#simpan_stok').attr('disabled', false);
                            }
                        } else {
                            $('#simpan_stok').attr('disabled', false);
                        }
                        
                    }
                }
                
            }

            $('#stok_saat_ini').val((id_produk == '') ? '' : stok);
            $('#total_stok').val(isNaN(total) ? '' : total);

        })

        // menampilkan list stok
        var tabel_stok = $('#tabel_stok').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "Stok/tampil_data_stok/ada",
                "type"  : "POST",
                "data"  : function (data) {
                    data.status = 'ada';
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,3],
                "orderable" : false
            }, {
                'targets'   : [0,2,3],
                'className' : 'text-center',
            }]

        })

        // 06-10-2020
        
        // menampilkan list stok
        var tabel_stok_habis = $('#tabel_stok_habis').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "Stok/tampil_data_stok",
                "type"  : "POST",
                "data"  : function (data) {
                    data.status = 'habis';
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,3],
                "orderable" : false
            }, {
                'targets'   : [0,2,3],
                'className' : 'text-center',
            }]

        })

        // 03-10-2020

        var tabel_detail = $('#tabel_detail').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "Stok/tampil_data_detail",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_stok = $('#id_stok').val();
                }
            },
            "columnDefs"        : [{
                "targets"   : [],
                "orderable" : false
            }, {
                'targets'   : [0,1,2,3,4],
                'className' : 'text-center',
            }]
        })

        // menampilkan modal tambah stok
        $('#tambah_stok').on('click', function () {
            $('#form_stok').trigger('reset');
            $('#aksi').val('Tambah');
            $('#modal_stok').modal('show');
            $('#judul_modal').text('Tambah Data Stok');
            $('#produk').val('').trigger('change');
            $('.t_stok').text('Tambah Stok');
            $('#nilai_stok').attr('placeholder', 'Masukkan Tambah Stok');

            $('#id_pelanggan').val('').trigger('change');
            $('#total_hutang').val(0);

            $('#hutang').attr('hidden', false);
            $('.f_hutang').attr('hidden', true);

            $('.r_hutang').attr('hidden', false);
        })

        // 03-10-2020

        $('#retur_stok').on('click', function () {
            $('#form_stok').trigger('reset');
            $('#aksi').val('Retur');
            $('#modal_stok').modal('show');
            $('#judul_modal').text('Retur Produk');
            $('#produk').val('').trigger('change');
            $('.t_stok').text('Jumlah Retur');
            $('#nilai_stok').attr('placeholder', 'Masukkan Jumlah Retur');

            $('.f_hutang').attr('hidden', true);

            $('.r_hutang').attr('hidden', true);
        })

        // aksi simpan data stok
        $('#simpan_stok').on('click', function () {

            var form_stok    = $('#form_stok').serialize();

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan kirim data?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-info",
                cancelButtonClass   : "btn btn-warning mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Ya',
                confirmButtonColor  : '#3085d6',
                cancelButtonColor   : '#d33',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url     : "Stok/simpan_data_stok",
                        type    : "POST",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        data    : form_stok,
                        dataType: "JSON",
                        success : function (data) {

                            $('#modal_stok').modal('hide');
                            
                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil disimpan',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 1000
                            });    
            
                            tabel_stok.ajax.reload(null,false);        
                            tabel_stok_habis.ajax.reload(null,false);        
                            
                            $('#form_stok').trigger("reset");
                            
                            $('#aksi').val('Tambah');

                            $('#produk').html(data.option);

                            $('.b_stok_habis').text(data.stok_habis);
                            $('.t_habis').text(data.stok_habis);
                            $('.t_ada').text(data.stok_ada);

                            if (data.stok_habis == 0) {
                                $('.b_stok_habis').attr('hidden', true);
                            } else {
                                $('.b_stok_habis').attr('hidden', false);
                            }
                            
                        }
                    })
            
                    return false;

                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal({
                        title               : "Batal",
                        text                : 'Anda membatalkan simpan data',
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-info",
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 1000
                    }); 
                }
            })

            return false;

        })

        // detail data stok
        $('#tabel_stok').on('click', '.detail-stok', function () {

            var produk      = $(this).attr('produk');
            var tot_masuk   = $(this).attr('tot_masuk');
            var tot_keluar  = $(this).attr('tot_keluar');
            var tot_retur   = $(this).attr('tot_retur');
            var stok        = $(this).attr('stok');
            var id_stok     = $(this).data('id');

            $('.t_masuk').text(tot_masuk);
            $('.t_keluar').text(tot_keluar);
            $('.t_retur').text(tot_retur);
            $('.t_stok2').text(stok);
            $('#id_stok').val(id_stok);
            $('#judul_detail').text('Detail Stok '+produk);
            $('#modal_detail').modal('show');
            $('#id_stok_report').val(id_stok);
            $('#nama_produk_report').val(produk);

            $('#tabel_detail tbody').empty();
            tabel_detail.ajax.reload(null, false);
        })

        // 06-10-2020
        $('#tabel_stok_habis').on('click', '.detail-stok', function () {

            var produk      = $(this).attr('produk');
            var tot_masuk   = $(this).attr('tot_masuk');
            var tot_keluar  = $(this).attr('tot_keluar');
            var tot_retur   = $(this).attr('tot_retur');
            var stok        = $(this).attr('stok');
            var id_stok     = $(this).data('id');

            $('.t_masuk').text(tot_masuk);
            $('.t_keluar').text(tot_keluar);
            $('.t_retur').text(tot_retur);
            $('.t_stok2').text(stok);
            $('#id_stok').val(id_stok);
            $('#judul_detail').text('Detail Stok '+produk);
            $('#modal_detail').modal('show');
            $('#id_stok_report').val(id_stok);
            $('#nama_produk_report').val(produk);

            $('#tabel_detail tbody').empty();
            tabel_detail.ajax.reload(null, false);

        })
        
    })

</script>