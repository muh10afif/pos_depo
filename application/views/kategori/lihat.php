<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-info p-3">
                <button class="btn float-right btn-light" id="tambah_kategori" data-toggle="modal" data-target="#modal_kategori"><i class="ti-plus mr-2"></i>Tambah Data</button>
                <h4 id="judul" class="font-weight-bold text-white mb-0 mt-2">Master Kategori</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_kategori" width="100%" cellspacing="0">
                        <thead class="thead-light text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Kategori</th>
                                <!-- <th width="20%">Mempunyai Bahan</th> -->
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
<div class="modal fade" id="modal_kategori" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="judul_modal">Tambah Data Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-dark">&times;</span>
        </button>
      </div>
        <form id="form_kategori" autocomplete="off" class="form-control-line">
            <input type="hidden" name="id_kategori" id="id_kategori">
            <input type="hidden" name="aksi" id="aksi" value="Tambah">
            <div class="modal-body">
                <div class="col-md-12 p-3">
                    <div class="form-group row">
                        <label for="nama_kategori" class="col-sm-3 col-form-label">Nama Kategori</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" style="font-size: 14px;" name="nama_kategori" id="nama_kategori" placeholder="Masukkan Nama Kategori">
                        </div>
                    </div>  
                    <!-- <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Mempunyai Bahan</label>
                        <div class="col-sm-9">
                            <select name="have_bahan" id="have_bahan" class="form-control">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="ti-close mr-2"></i>Batal</button>
                <button type="button" class="btn btn-info" id="simpan_kategori"><i class="ti-check mr-2"></i>Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>

    // 06-07-2020

    $(document).ready(function () {

        // menampilkan list kategori
        var tabel_kategori = $('#tabel_kategori').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "kategori/tampil_data_kategori",
                "type"  : "POST"
            },
            "columnDefs"        : [{
                "targets"   : [0,2],
                "orderable" : false
            }, {
                'targets'   : [0,2],
                'className' : 'text-center',
            }]

        })

        // menampilkan modal tambah kategori
        $('#tambah_kategori').on('click', function () {
            $('#form_kategori').trigger('reset');
            $('#aksi').val('Tambah');
            $('#modal_kategori').modal('show');

            $('#judul_modal').text('Tambah Data Kategori');
        })

        // aksi simpan data kategori
        $('#simpan_kategori').on('click', function () {

            var form_kategori    = $('#form_kategori').serialize();
            var nama_kategori    = $('#nama_kategori').val();

            console.log('masuk');

            if (nama_kategori == '') {

                swal({
                    title               : "Peringatan",
                    text                : 'Nama kategori harus terisi !',
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
                            url     : "Kategori/simpan_data_kategori",
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
                            data    : form_kategori,
                            dataType: "JSON",
                            success : function (data) {

                                $('#modal_kategori').modal('hide');
                                
                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data berhasil disimpan',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                });    
                
                                tabel_kategori.ajax.reload(null,false);        
                                
                                $('#form_kategori').trigger("reset");
                                
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

        // edit data kategori
        $('#tabel_kategori').on('click', '.edit-kategori', function () {

            $('#judul_modal').text('Ubah Data Kategori');

            var id_kategori  = $(this).data('id');

            $.ajax({
                url         : "Kategori/ambil_data_kategori/"+id_kategori,
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

                    $('#modal_kategori').modal('show');
                    
                    $('#id_kategori').val(data.id);

                    $('#nama_kategori').val(data.kategori);
                    $('#have_bahan').val(data.have_bahan);

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

        // hapus kategori
        $('#tabel_kategori').on('click', '.hapus-kategori', function () {

            var id_kategori = $(this).data('id');
            var kategori    = $(this).attr('kategori');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus kategori '+kategori+'?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-primary",
                cancelButtonClass   : "btn btn-danger mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : "Kategori/simpan_data_kategori",
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
                        data        : {aksi:'Hapus', id_kategori:id_kategori},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_kategori.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus kategori',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                $('#form_kategori').trigger("reset");

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
                            text                : 'Anda membatalkan hapus kategori',
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