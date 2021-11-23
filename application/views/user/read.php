<style>
    .field-icon {
        float: right;
        margin-left: -25px;
        margin-right: 10px;
        margin-top: -32px;
        position: relative;
        z-index: 2;
    }

</style>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-info p-3">
                <button class="btn float-right btn-light" id="tambah_user" data-toggle="modal" data-target="#modal_user"><i class="ti-plus mr-2"></i>Tambah Data</button>
            
                <h4 id="judul" class="font-weight-bold text-white mb-0 mt-2">Master User</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"  id="tabel_user" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="">Username</th>
                            <th width="">Role</th>
                            <th width="15%">Aksi</th>
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
<div class="modal fade" id="modal_user" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="judul_modal">Tambah Data user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-dark">&times;</span>
        </button>
      </div>
        <form id="form_user" autocomplete="off" class="form-control-line">
            <input type="hidden" name="id_user" id="id_user">
            <input type="hidden" name="aksi" id="aksi" value="Tambah">
            <input type="hidden" name="password_lama" id="password_lama">
            <div class="modal-body">
                <div class="col-md-12 p-3">
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username">
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control mb-2" name="password" id="password" placeholder="Masukkan Password">
                            <i toggle="#password" class="ti-face-smile field-icon toggle-password"></i>
                            <p id="ket" hidden><span class="text-danger">*Kosongkan bila tidak mengubah password!</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="ti-close mr-2"></i>Batal</button>
                <button type="button" class="btn btn-info" id="simpan_user"><i class="ti-check mr-2"></i>Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>

    // 06-07-2020

    $(document).ready(function () {

        // 02-10-2020

        $(".toggle-password").click(function() {

            $(this).toggleClass("ti-face-smile ti-face-sad");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
            input.attr("type", "text");
            } else {
            input.attr("type", "password");
            }

        });

        // menampilkan list user
        var tabel_user = $('#tabel_user').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "user/tampil_data_user",
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

        // menampilkan modal tambah user
        $('#tambah_user').on('click', function () {
            $('#form_user').trigger('reset');
            $('#aksi').val('Tambah');
            $('#modal_user').modal('show');
            $('#judul_modal').text('Tambah Data user');
            $('#ket').attr('hidden', true);
        })

        // aksi simpan data user
        $('#simpan_user').on('click', function () {

            var form_user    = $('#form_user').serialize();
            var nama_user    = $('#username').val();

            if (nama_user == '') {

                swal({
                    title               : "Peringatan",
                    text                : 'Username harus terisi !',
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
                            url     : "user/simpan_data_user",
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
                            data    : form_user,
                            dataType: "JSON",
                            success : function (data) {

                                $('#modal_user').modal('hide');
                                
                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data berhasil disimpan',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                });    
                
                                tabel_user.ajax.reload(null,false);        
                                
                                $('#form_user').trigger("reset");
                                
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

            }

        })

        // edit data user
        $('#tabel_user').on('click', '.edit-user', function () {

            $('#ket').attr('hidden', false);

            $('#judul_modal').text('Ubah Data user');

            var id_user  = $(this).data('id');

            $.ajax({
                url         : "user/ambil_data_user/"+id_user,
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

                    $('#modal_user').modal('show');
                    
                    $('#id_user').val(data.id);

                    $('#username').val(data.username);
                    $('#password_lama').val(data.pass);

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

        // hapus user
        $('#tabel_user').on('click', '.hapus-user', function () {

            var id_user = $(this).data('id');
            var user    = $(this).attr('user');

            $('#ket').attr('hidden', true);

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus user '+user+'?',
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
                        url         : "user/simpan_data_user",
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
                        data        : {aksi:'Hapus', id_user:id_user},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_user.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus user',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                $('#form_user').trigger("reset");

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
                            text                : 'Anda membatalkan hapus user',
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