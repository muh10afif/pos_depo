<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-info p-3">
                <button class="btn float-right btn-light" id="tambah_hutang"><i class="ti-plus mr-2"></i>Bayar Hutang</button>
            
                <h4 class="font-weight-bold text-white mb-0 mt-2">Hutang</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"  id="tabel-hutang" width="100%" cellspacing="0">
                        <thead class="thead-light text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Pelanggan</th>
                                <th width="20%">Total hutang</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                        </tbody>
                    </table>
                
            </div>
        </div>
    </div>
</div>

<!-- 12-10-2020 -->

<!-- modal -->
<div id="modal-hutang" class="modal fade" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="my-modal-title">Bayar Hutang</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" autocomplete="off" id="form-hutang" class="form-control-line">
                <input type="hidden" id="aksi" name="aksi" value="Tambah">
                <input type="hidden" id="id_hutang" name="id_hutang" value="Tambah">
                <div class="modal-body">
                    <div class="row p-3 mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_bayar">Tanggal Bayar</label>
                                <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar" placeholder="Masukkan Tanggal Bayar">
                                <span class="text-danger" id="tgl_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="idpelanggan">Nama Pelanggan</label>
                                <select class="form-control select2" id="idpelanggan" name="idpelanggan" style="width: 100%;">
                                        <option value="" tot_hutang="">Pilih Pelanggan</option>
                                        <?php foreach ($list_nama as $n): ?>
                                            <option value="<?= $n['id'] ?>" tot_hutang="<?= $n['tot_hutang'] ?>"><?= $n['pelanggan'] ?></option>
                                        <?php endforeach; ?>
                                </select>
                                <span class="text-danger" id="nama_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bayar">Nominal Bayar</label>
                                <input type="text" class="form-control number_separator numeric" id="bayar" name="bayar" placeholder="Masukkan Nominal" disabled>
                                <span class="text-danger" id="telp_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sisa_hutang">Sisa hutang</label>
                                <input type="text" class="form-control number_separator numeric" id="sisa_hutang" name="sisa_hutang" value="0" disabled>
                                <span class="text-danger" id="sisa_hutang_error"></span>
                            </div>
                        </div>
                        <input type="hidden" id="tot_hutang">
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"><i class='mdi mdi-close mr-1'></i>Batal</button>
                <button type="button" class="btn btn-info" id="simpan_hutang"><i class='mdi mdi-check mr-1'></i>Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- 20-10-2020 -->
<div id="modal_detail_hutang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title2" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content f_detail_hutang">
            <div class="modal-header">
                <h5 class="modal-title" id="judul">Detail Hutang</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-2">
                <input type="hidden" id="id_pelanggan">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="tabel_detail_hutang" width="100%">
                    <thead class="thead-light">                                 
                        <tr class="text-center">
                            <th>No</th>
                            <th>Tanggal Bayar</th>
                            <th>Bayar</th>
                            <th>Sisa hutang</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        
        // 20-10-2020
        var tabel_hutang = $('#tabel-hutang').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "hutang/tampil_data_hutang",
                "type"  : "POST"
            },
            "columnDefs"        : [{
                "targets"   : [0,3],
                "orderable" : false
            }, {
                'targets'   : [0,3],
                'className' : 'text-center',
            }]

        })

        // 20-10-2020
        var tabel_detail_hutang = $('#tabel_detail_hutang').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "hutang/tampil_data_detail_hutang",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_pelanggan = $('#id_pelanggan').val();
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,1,2,3],
                "orderable" : false
            }, {
                'targets'   : [0,3],
                'className' : 'text-center',
            }]
        })
        
        // 05-09-2020

        $('.number_separator').divide({
            delimiter:'.',
            divideThousand: true, // 1,000..9,999
            delimiterRegExp: /[\.\,\s]/g
        });

        $('.numeric').numericOnly();

        $('#tambah_hutang').on('click', function () {

            $('#modal-hutang').modal('show');
            $('#my-modal-title').html("<i class='mdi mdi-plus mr-2'></i>Bayar hutang");

            $('#form-hutang').trigger('reset');

            $('#simpan_hutang').removeClass('btn-progress disabled');
            $('#idpelanggan').val("").trigger("change")

            $.ajax({
                url     : "hutang/ambil_list_pelanggan",
                type    : "POST",
                dataType: "JSON",
                success : function (data) {

                    $('#idpelanggan').html(data.list_pl);
                    
                }
            })
    
            return false;

        })

        $('#simpan_hutang').on('click', function () {

            var tgl_bayar       = $('#tgl_bayar').val();
            var id_pel          = $('#idpelanggan').val();
            var bayar           = $('#bayar').val();
            var tot_hutang      = $('#idpelanggan').find(':selected').attr('tot_hutang');

            if (tgl_bayar == '') {
                
                swal({
                    title               : "Peringatan",
                    text                : 'Tanggal bayar harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 
                
                $('#tgl_bayar').focus();

            } else if (id_pel == '') {

                $('#idpelanggan').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Pelanggan harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 

            } else if (bayar == '' || bayar == 0) {

                $('#bayar').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Nominal bayar harus terisi bernilai !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 

            } else {
                
                var form_hutang  = $('#form-hutang').serialize();

                // $('#simpan_hutang').addClass('btn-progress disabled');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus data',
                    type        : 'warning',

                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-info",
                    cancelButtonClass   : "btn btn-danger mr-3",

                    showCancelButton    : true,
                    confirmButtonText   : 'Ya',
                    confirmButtonColor  : '#d33',
                    cancelButtonColor   : '#3085d6',
                    cancelButtonText    : 'Batal',
                    reverseButtons      : true
                }).then((result) => {
                    if (result.value) {
                        
                        $.ajax({
                            url     : "hutang/simpan_data_hutang",
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
                            data    : {tgl_bayar:tgl_bayar, id_pelanggan:id_pel, bayar:bayar, tot_hutang:tot_hutang},
                            dataType: "JSON",
                            success : function (data) {

                                $('#modal-hutang').modal('hide');
                                
                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data berhasil disimpan',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 700
                                });    
                
                                tabel_hutang.ajax.reload(null,false);        
                                
                                $('#form-hutang').trigger("reset");
                                
                                $('#aksi').val('Tambah');

                                $('#idpelanggan').html(data.list_pl);
                                
                            }
                        })
                
                        return false;
                        
                    } else if (result.dismiss === swal.DismissReason.cancel) {

                        swal({
                                title               : 'Batal',
                                text                : 'Anda membatalkan kirim data!',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-primary",
                                type                : 'error',
                                showConfirmButton   : false,
                                timer               : 700
                            }); 
                    }
                })

            }

        })

        // 07-09-2020
        function ucwords (str) {
            return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
                return $1.toUpperCase();
            });
        }

        $('#tabel-hutang').on('click', '.detail-hutang', function () {
            
            var id_pelanggan = $(this).data('id'); 
            var nama         = $(this).attr('nama'); 

            $('#id_pelanggan').val(id_pelanggan);
            $('#judul').text('Detail hutang '+ucwords(nama));
            $('#modal_detail_hutang').modal('show');

            $('#tabel_detail_hutang tbody').empty();

            tabel_detail_hutang.ajax.reload(null, false);

        })

        // 06-09-2020
        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // 06-09-2020 07-09-2020
        $('#idpelanggan').on('change', function () {
            var tot_hutang  = $(this).find(':selected').attr('tot_hutang');
            var isi         = $('#bayar').val().replace('.','');
            var hutang      = $('#tot_hutang').val();

            var tt = 0;

            if (isi == '') {
                tt = tot_hutang;
            } else {
                tt = tot_hutang - isi
            }
            
            if (tot_hutang == '') {
                $('#bayar').val('');
                $('#sisa_hutang').val(0);
                $('#bayar').attr('disabled', true);
            } else {
                // $('#bayar').val('');
                $('#bayar').attr('disabled', false);
                $('#sisa_hutang').val(separator(tot_hutang - isi));
            }

            $('#tot_hutang').val(tot_hutang);
            $('#sisa_hutang_error').text('');

        })

        // 07-09-2020
        $('#bayar').on('keyup', function () {
            
            var isi          = $(this).val().replace('.','');
            var hutang      = $('#tot_hutang').val();
            var sisa_hutang = $('#sisa_hutang').val().replace('.',''); 

            var sisa_hutang  = hutang - isi;

            if (sisa_hutang < 0) {
                $('#sisa_hutang_error').text('Sisa hutang tidak boleh minus (-) atau kurang dari nol!');
                $('#simpan_hutang').attr("disabled", true);
            } else {
                $('#sisa_hutang_error').text('');
                $('#simpan_hutang').attr("disabled", false);
            }

            $('#sisa_hutang').val(separator(sisa_hutang));
            
        })

    })
</script>