<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-info p-3">
                <button class="btn float-right btn-light" id="tambah_pelanggan" data-toggle="modal" data-target="#modal_pelanggan"><i class="ti-plus mr-2"></i>Tambah Data</button>
            
                <h4 id="judul" class="font-weight-bold text-white mb-0 mt-2">Master Pelanggan</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"  id="tabel_pelanggan" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Pelanggan</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <!-- <th>Jenis</th> -->
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_pelanggan" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="judul_modal">Tambah Data pelanggan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-dark">&times;</span>
        </button>
      </div>
        <form id="form_pelanggan" autocomplete="off" class="form-control-line">
            <input type="hidden" name="id_pelanggan" id="id_pelanggan">
            <input type="hidden" name="aksi" id="aksi" value="Tambah">
            <div class="modal-body">
                <div class="col-md-12 p-3">
                    <div class="form-group row">
                        <label for="nama_pelanggan" class="col-sm-3 col-form-label">Nama pelanggan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" style="font-size: 14px;" name="nama_pelanggan" id="nama_pelanggan" placeholder="Masukkan Nama pelanggan">
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="no_telp" class="col-sm-3 col-form-label">No Telepon</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control numeric" name="no_telp" id="no_telp" placeholder="Masukkan No Telepon">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea name="alamat" id="alamat" rows="5" class="form-control" placeholder="Masukkan Alamat"></textarea>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="jenis" class="col-sm-3 col-form-label">Jenis</label>
                        <div class="col-sm-9">
                            
                            <div class="input-group f_jenis">
                                <select name="jenis" id="jenis" class="form-control select2" style="width: 92%;">
                                        <option value="">Pilih Jenis</option>
                                    <?php foreach ($jenis as $j): ?>
                                        <option value="<?= $j['id'] ?>"><?= $j['jenis'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" data-toggle="tooltip" data-placement="top" title="Tambah Baru Jenis" id="tambah_jenis"><i class="ti-plus"></i></button>
                                </div>
                            </div>
                            <div class="input-group ft_jenis" hidden>
                                <input type="text" name="jenis_baru" id="jenis_baru" class="form-control" placeholder="Masukkan Jenis">
                                <div class="input-group-append">
                                    <button class="btn btn-danger" type="button" data-toggle="tooltip" data-placement="top" title="Batal Tambah Baru" id="batal_tambah"><i class="ti-back-left"></i></button>
                                </div>
                            </div>
                            <div class="input-group ft_jenis mt-3" hidden>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp. </span>
                                </div>
                                <input type="text" class="form-control numeric number_separator ml-2" id="diskon" name="diskon" placeholder="Diskon">
                            </div>

                            <input type="hidden" name="status_jenis" id="status_jenis" value="lama">

                        </div>
                    </div> -->

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="ti-close mr-2"></i>Batal</button>
                <button type="button" class="btn btn-info" id="simpan_pelanggan"><i class="ti-check mr-2"></i>Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>

    // 03-10-2020

    $(document).ready(function () {

        // 15-10-2020
        $('#tambah_jenis').on('click', function () {

            $('.f_jenis').attr('hidden', true);
            $('.ft_jenis').attr('hidden', false).fadeOut('fast').fadeIn();
            // $('#jenis').val('').trigger('change');
            $('#jenis_baru').val('');
            $('#diskon').val('');
            $('#status_jenis').val('baru');

        })

        // 15-10-2020
        $('#batal_tambah').on('click', function () {

            $('.f_jenis').attr('hidden', false).fadeOut('fast').fadeIn();
            $('.ft_jenis').attr('hidden', true);
            // $('#jenis').val('').trigger('change');
            $('#jenis_baru').val('');
            $('#diskon').val('');
            $('#status_jenis').val('lama');

        })


        $('.numeric').numericOnly();

        // menampilkan list pelanggan
        var tabel_pelanggan = $('#tabel_pelanggan').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "Pelanggan/tampil_data_pelanggan",
                "type"  : "POST"
            },
            "columnDefs"        : [{
                "targets"   : [0,4],
                "orderable" : false
            }, {
                'targets'   : [0,4],
                'className' : 'text-center',
            }]

        })

        // menampilkan modal tambah pelanggan
        $('#tambah_pelanggan').on('click', function () {
            $('#form_pelanggan').trigger('reset');
            $('#aksi').val('Tambah');

            $('.f_jenis').attr('hidden', false);
            $('.ft_jenis').attr('hidden', true);

            $.ajax({
                url         : "pelanggan/ambil_option_jenis",
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
                dataType    : "JSON",
                success     : function (data) {
                    swal.close();

                    $('#modal_pelanggan').modal('show');
                    $('#judul_modal').text('Tambah Data Pelanggan');

                    $('#jenis').html(data.option);
                    
                },
                error       : function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    alert(err.Message);
                }

            })

            return false;

        })

        // aksi simpan data pelanggan
        $('#simpan_pelanggan').on('click', function () {

            var form_pelanggan  = $('#form_pelanggan').serialize();
            var nama_pelanggan  = $('#nama_pelanggan').val();
            var no_telp         = $('#no_telp').val();
            var alamat          = $('#alamat').val();
            var jenis_baru      = $('#jenis_baru').val();
            var jenis           = $('#jenis').val();
            var diskon          = $('#diskon').val();
            var status_jenis    = $('#status_jenis').val();

            if (nama_pelanggan == '') {

                $('#nama_pelanggan').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Nama pelanggan harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 1000
                }); 

                return false;

            }
            
            if (no_telp == '') {

                $('#no_telp').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'No Telepon harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 1000
                }); 

                return false;
                
            } 
            
            if (alamat == '') {

                $('#alamat').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Alamat harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 1000
                }); 

                return false;
                
            } 

            if (status_jenis == 'lama') {

                if (jenis == '') {
                    $('#jenis').focus();

                    swal({
                        title               : "Peringatan",
                        text                : 'Jenis harus terisi!',
                        buttonsStyling      : false,
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 1000
                    }); 

                    return false;
                }

            } else {

                if (jenis_baru == '') {

                    $('#jenis_baru').focus();

                    swal({
                        title               : "Peringatan",
                        text                : 'Nama Jenis harus terisi!',
                        buttonsStyling      : false,
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 1000
                    }); 

                    return false;
                    
                } else if (diskon == '') {

                    $('#diskon').focus();

                    swal({
                        title               : "Peringatan",
                        text                : 'Diskon harus terisi!',
                        buttonsStyling      : false,
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 1000
                    }); 

                    return false;

                }

            }
            
            // if ((alamat && nama_pelanggan && no_telp) != '') {

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan kirim data',
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
                            url     : "pelanggan/simpan_data_pelanggan",
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
                            data    : form_pelanggan,
                            dataType: "JSON",
                            success : function (data) {

                                $('#modal_pelanggan').modal('hide');
                                
                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data berhasil disimpan',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                });    
                
                                tabel_pelanggan.ajax.reload(null,false);        
                                
                                $('#form_pelanggan').trigger("reset");
                                
                                $('#aksi').val('Tambah');
                                
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

            // }

        })

        // edit data pelanggan
        $('#tabel_pelanggan').on('click', '.edit-pelanggan', function () {

            $('#judul_modal').text('Ubah Data Pelanggan');

            $('.f_jenis').attr('hidden', false);
            $('.ft_jenis').attr('hidden', true);

            var id_pelanggan  = $(this).data('id');

            $.ajax({
                url         : "pelanggan/ambil_data_pelanggan/"+id_pelanggan,
                type        : "GET",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses Data',
                        onOpen  : () => {
                            swal.showLoading();
                        }
                    })
                },
                dataType    : "JSON",
                success     : function(data)
                {
                    $('#jenis').html(data.option);

                    swal.close();

                    $('#modal_pelanggan').modal('show');
                    
                    $('#id_pelanggan').val(data.dt.id);

                    $('#nama_pelanggan').val(data.dt.pelanggan);
                    $('#no_telp').val(data.dt.no_telp);
                    $('#alamat').val(data.dt.alamat);
                    $('#jenis').val(data.dt.jenis).trigger('change');

                    $('#aksi').val('Ubah');

                    return false;

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            })

            return false;

        })

        // hapus pelanggan
        $('#tabel_pelanggan').on('click', '.hapus-pelanggan', function () {

            var id_pelanggan = $(this).data('id');
            var pelanggan    = $(this).attr('pelanggan');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus pelanggan '+pelanggan+'?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-info mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : "pelanggan/simpan_data_pelanggan",
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
                        data        : {aksi:'Hapus', id_pelanggan:id_pelanggan},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_pelanggan.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus pelanggan',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                $('#form_pelanggan').trigger("reset");

                                $('#aksi').val('Tambah');
                            
                        },
                        error       : function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            alert(err.Message);
                        }

                    })

                    return false;
                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal({
                            title               : 'Batal',
                            text                : 'Anda membatalkan hapus pelanggan',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-info",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 
                }
            })

        })
        
    })

</script>