<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-info p-3">
                <button class="btn float-right btn-light" id="tambah_bahan" data-toggle="modal" data-target="#modal_bahan"><i class="ti-plus mr-2"></i>Tambah Data</button>
            
                <h4 id="judul" class="font-weight-bold text-white mb-0 mt-2">Master Bahan</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"  id="tabel_bahan" width="100%" cellspacing="0">
                        <thead class="thead-light text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Kategori</th>
                                <th width="20%">Nama Bahan</th>
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

<!-- Modal -->
<div class="modal fade" id="modal_bahan" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="judul_modal">Tambah Data Bahan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-dark">&times;</span>
        </button>
      </div>
        <form id="form_bahan" autocomplete="off" class="form-control-line">
            <input type="hidden" name="id_bahan" id="id_bahan">
            <input type="hidden" name="aksi" id="aksi" value="Tambah">
            <div class="modal-body">
                <div class="col-md-12 p-3">
                    <div class="form-group row">
                        <label for="nama_bahan" class="col-sm-3 col-form-label">Nama bahan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" style="font-size: 14px;" name="nama_bahan" id="nama_bahan" placeholder="Masukkan Nama bahan">
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="kategori" class="col-sm-3 col-form-label">Kategori</label>
                        <div class="col-sm-9">
                            <div class="input-group f_kategori">
                                <select name="id_kategori" id="id_kategori" class="form-control select2" style="width: 92%;">
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($kategori as $k): ?>
                                        <option value="<?= $k['id'] ?>"><?= $k['kategori'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" data-toggle="tooltip" data-placement="top" title="Tambah Baru Kategori" id="tambah_kategori"><i class="ti-plus"></i></button>
                                </div>
                            </div>
                            <div class="input-group ft_kategori" hidden>
                                <input type="text" name="kategori_baru" id="kategori_baru" class="form-control" placeholder="Masukkan Kategori">
                                <div class="input-group-append">
                                    <button class="btn btn-danger" type="button" data-toggle="tooltip" data-placement="top" title="Batal Tambah Baru" id="batal_tambah"><i class="ti-back-left"></i></button>
                                </div>
                            </div>
                            <input type="hidden" name="status_kategori" id="status_kategori" value="lama">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpan_bahan">Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>

    // 06-07-2020

    $(document).ready(function () {

        // 07-10-2020
        
        $('#tambah_kategori').on('click', function () {

            $('.f_kategori').attr('hidden', true);
            $('.ft_kategori').attr('hidden', false).fadeOut('fast').fadeIn();
            $('#id_kategori').val('').trigger('change');
            $('#kategori_baru').val('');
            $('#status_kategori').val('baru');

        })

        // 07-10-2020
        $('#batal_tambah').on('click', function () {

            $('.f_kategori').attr('hidden', false).fadeOut('fast').fadeIn();
            $('.ft_kategori').attr('hidden', true);
            $('#id_kategori').val('').trigger('change');
            $('#kategori_baru').val('');
            $('#status_kategori').val('lama');

        })

        // menampilkan list bahan
        var tabel_bahan = $('#tabel_bahan').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "Bahan/tampil_data_bahan",
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

        // menampilkan modal tambah bahan
        $('#tambah_bahan').on('click', function () {
            $('#form_bahan').trigger('reset');
            $('#aksi').val('Tambah');
            $('#modal_bahan').modal('show');
            $('#judul_modal').text('Tambah Data Bahan');

            $('.f_kategori').attr('hidden', false).fadeOut('fast').fadeIn();
            $('.ft_kategori').attr('hidden', true);
            $('#id_kategori').val('').trigger('change');
            $('#kategori_baru').val('');
            $('#status_kategori').val('lama');
        })

        // aksi simpan data bahan
        $('#simpan_bahan').on('click', function () {

            var form_bahan      = $('#form_bahan').serialize();
            var nama_bahan      = $('#nama_bahan').val();
            var id_kategori     = $('#id_kategori').val();
            var sts_kategori    = $('#status_kategori').val();
            var kategori_baru   = $('#kategori_baru').val();

            // 07-10-2020

            if (sts_kategori == 'lama') {
                
                if (id_kategori == '') {

                    $('#id_kategori').focus();

                    swal({
                        title               : "Peringatan",
                        text                : 'Kategori harus terisi !',
                        buttonsStyling      : false,
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 1000
                    }); 

                    return false;
                }

            } else {

                if (kategori_baru == '') {

                    $('#kategori_baru').focus();

                    swal({
                        title               : "Peringatan",
                        text                : 'Kategori harus terisi !',
                        buttonsStyling      : false,
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 1000
                    }); 

                    return false;

                }

            }

            if (nama_bahan == '') {

                $('#nama_bahan').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Nama bahan harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 1000
                }); 

                return false;

            } else {

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan kirim data',
                    type        : 'warning',

                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-primary",
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
                            url     : "Bahan/simpan_data_bahan",
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
                            data    : form_bahan,
                            dataType: "JSON",
                            success : function (data) {

                                $('#modal_bahan').modal('hide');
                                
                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data berhasil disimpan',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                });    
                
                                tabel_bahan.ajax.reload(null,false);        
                                
                                $('#form_bahan').trigger("reset");
                                
                                $('#aksi').val('Tambah');
                                
                            }
                        })
                
                        return false;

                    } else if (result.dismiss === swal.DismissReason.cancel) {

                        swal({
                            title               : "Batal",
                            text                : 'Anda membatalkan simpan data',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 
                    }
                })

                return false;

            }

        })

        // edit data bahan
        $('#tabel_bahan').on('click', '.edit-bahan', function () {

            $('#judul_modal').text('Ubah Data Bahan');

            var id_bahan  = $(this).data('id');

            $.ajax({
                url         : "Bahan/ambil_data_bahan/"+id_bahan,
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
                    swal.close();

                    $('#modal_bahan').modal('show');
                    
                    $('#id_bahan').val(data.id);

                    $('#nama_bahan').val(data.nama_bahan);
                    $('#id_kategori').val(data.id_kategori).trigger('change');

                    $('.f_kategori').attr('hidden', false).fadeOut('fast').fadeIn();
                    $('.ft_kategori').attr('hidden', true);
                    $('#kategori_baru').val('');
                    $('#status_kategori').val('lama');

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

        // hapus bahan
        $('#tabel_bahan').on('click', '.hapus-bahan', function () {

            var id_bahan = $(this).data('id');
            var bahan    = $(this).attr('bahan');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus bahan '+bahan+'?',
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
                    $.ajax({
                        url         : "Bahan/simpan_data_bahan",
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
                        data        : {aksi:'Hapus', id_bahan:id_bahan},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_bahan.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus bahan',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                $('#form_bahan').trigger("reset");

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
                            text                : 'Anda membatalkan hapus bahan',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 
                }
            })

        })
        
    })

</script>