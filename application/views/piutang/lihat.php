<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-info p-3">
                <button class="btn float-right btn-light" id="tambah_piutang"><i class="ti-plus mr-2"></i>Bayar Piutang</button>
            
                <h4 class="font-weight-bold text-white mb-0 mt-2">Piutang</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"  id="tabel-piutang" width="100%" cellspacing="0">
                        <thead class="thead-light text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Pelanggan</th>
                                <th width="20%">Total Piutang</th>
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
<div id="modal-piutang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="my-modal-title">piutang</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" autocomplete="off" id="form-piutang" class="form-control-line">
                <input type="hidden" id="aksi" name="aksi" value="Tambah">
                <input type="hidden" id="id_piutang" name="id_piutang" value="Tambah">
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
                                    <option value="" tot_piutang="">Pilih Pelanggan</option>
                                    <?php foreach ($list_nama as $n): ?>
                                        <option value="<?= $n['id'] ?>" tot_piutang="<?= $n['tot_piutang'] ?>"><?= $n['pelanggan'] ?></option>
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
                                <label for="sisa_piutang">Sisa Piutang</label>
                                <input type="text" class="form-control number_separator numeric" id="sisa_piutang" name="sisa_piutang" value="0" disabled>
                                <span class="text-danger" id="sisa_piutang_error"></span>
                            </div>
                        </div>
                        <input type="hidden" id="tot_piutang">
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"><i class='mdi mdi-close mr-1'></i>Batal</button>
                <button type="button" class="btn btn-success" id="simpan_piutang"><i class='mdi mdi-check mr-1'></i>Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- 07-09-2020 -->
<div id="modal_detail_piutang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title2" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content f_detail_piutang">
            <div class="modal-header">
                <h5 class="modal-title" id="judul">Detail Piutang</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-2">
                <input type="hidden" id="id_pelanggan">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="tabel_detail_piutang" width="100%">
                    <thead class="thead-light">                                 
                        <tr class="text-center">
                            <th>No</th>
                            <th>Tanggal Bayar</th>
                            <th>Bayar</th>
                            <th>Sisa Piutang</th>
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
        var tabel_piutang = $('#tabel-piutang').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "piutang/tampil_data_piutang",
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
        var tabel_detail_piutang = $('#tabel_detail_piutang').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "piutang/tampil_data_detail_piutang",
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

        $('#tambah_piutang').on('click', function () {

            $('#modal-piutang').modal('show');
            $('#my-modal-title').html("<i class='mdi mdi-plus mr-2'></i>Bayar piutang");

            $('#form-piutang').trigger('reset');

            $('#simpan_piutang').removeClass('btn-progress disabled');
            $('#idpelanggan').val("").trigger("change")

            $.ajax({
                url     : "piutang/ambil_list_pelanggan",
                type    : "POST",
                dataType: "JSON",
                success : function (data) {

                    $('#idpelanggan').html(data.list_pl);
                    
                }
            })
    
            return false;

        })

        $('#simpan_piutang').on('click', function () {

            var tgl_bayar       = $('#tgl_bayar').val();
            var id_pel          = $('#idpelanggan').val();
            var bayar           = $('#bayar').val();
            var tot_piutang      = $('#idpelanggan').find(':selected').attr('tot_piutang');

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
                
                var form_piutang  = $('#form-piutang').serialize();

                // $('#simpan_piutang').addClass('btn-progress disabled');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus data',
                    type        : 'warning',

                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-primary",
                    cancelButtonClass   : "btn btn-danger mr-3",

                    showCancelButton    : true,
                    confirmButtonText   : 'Kirim',
                    confirmButtonColor  : '#d33',
                    cancelButtonColor   : '#3085d6',
                    cancelButtonText    : 'Batal',
                    reverseButtons      : true
                }).then((result) => {
                    if (result.value) {
                        
                        $.ajax({
                            url     : "piutang/simpan_data_piutang",
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
                            data    : {tgl_bayar:tgl_bayar, id_pelanggan:id_pel, bayar:bayar, tot_piutang:tot_piutang},
                            dataType: "JSON",
                            success : function (data) {

                                $('#modal-piutang').modal('hide');
                                
                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data berhasil disimpan',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 700
                                });    
                
                                tabel_piutang.ajax.reload(null,false);        
                                
                                $('#form-piutang').trigger("reset");
                                
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

        $('#tabel-piutang').on('click', '.detail-piutang', function () {
            
            var id_pelanggan = $(this).data('id'); 
            var nama         = $(this).attr('nama'); 

            $('#id_pelanggan').val(id_pelanggan);
            $('#judul').text('Detail piutang '+ucwords(nama));
            $('#modal_detail_piutang').modal('show');

            $('#tabel_detail_piutang tbody').empty();

            tabel_detail_piutang.ajax.reload(null, false);

        })

        // 06-09-2020
        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // 06-09-2020 07-09-2020
        $('#idpelanggan').on('change', function () {
            var tot_piutang  = $(this).find(':selected').attr('tot_piutang');
            var isi         = $('#bayar').val().replace('.','');
            var piutang      = $('#tot_piutang').val();

            var tt = 0;

            if (isi == '') {
                tt = tot_piutang;
            } else {
                tt = tot_piutang - isi
            }
            
            if (tot_piutang == '') {
                $('#bayar').val('');
                $('#sisa_piutang').val(0);
                $('#bayar').attr('disabled', true);
            } else {
                // $('#bayar').val('');
                $('#bayar').attr('disabled', false);
                $('#sisa_piutang').val(separator(tot_piutang - isi));
            }

            $('#tot_piutang').val(tot_piutang);
            $('#sisa_piutang_error').text('');

        })

        // 07-09-2020
        $('#bayar').on('keyup', function () {
            
            var isi          = $(this).val().replace('.','');
            var piutang      = $('#tot_piutang').val();
            var sisa_piutang = $('#sisa_piutang').val().replace('.',''); 

            var sisa_piutang  = piutang - isi;

            if (sisa_piutang < 0) {
                $('#sisa_piutang_error').text('Sisa piutang tidak boleh minus (-) atau kurang dari nol!');
                $('#simpan_piutang').attr("disabled", true);
            } else {
                $('#sisa_piutang_error').text('');
                $('#simpan_piutang').attr("disabled", false);
            }

            $('#sisa_piutang').val(separator(sisa_piutang));
            
        })

    })
</script>