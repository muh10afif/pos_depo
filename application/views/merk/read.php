<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-info p-3">
                <button class="btn float-right btn-light" id="tambah_merk" data-toggle="modal" data-target="#modal_merk"><i class="ti-plus mr-2"></i>Tambah Data</button>
            
                <h4 id="judul" class="font-weight-bold text-white mt-2 mb-0">Master Merk</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"  id="tabel_merk" width="100%" cellspacing="0">
                        <thead class="thead-light text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="">Merk</th>
                                <th width="20%">Aksi</th>
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
<div class="modal fade" id="modal_merk" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="judul_modal">Tambah Data merk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-dark">&times;</span>
        </button>
      </div>
        <form id="form_merk" autocomplete="off" class="form-control-line">
            <input type="hidden" name="id_merk" id="id_merk">
            <input type="hidden" name="aksi" id="aksi" value="Tambah">
            <div class="modal-body">
                <div class="col-md-12 p-3">
                    <div class="form-group row">
                        <label for="nama_merk" class="col-sm-3 col-form-label">Nama merk</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_merk" id="nama_merk" placeholder="Masukkan Nama merk">
                        </div>
                    </div>  
                    <!-- <div class="form-group">
                                        <label for="example-email">Email <span class="help"> e.g.
                                                "example@gmail.com"</span></label>
                                        <input type="email" id="example-email2" name="example-email"
                                            class="form-control" placeholder="Email"> </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="ti-close mr-2"></i>Batal</button>
                <button type="button" class="btn btn-info" id="simpan_merk"><i class="ti-check mr-2"></i>Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>

    // 06-07-2020

    $(document).ready(function () {

        // menampilkan list merk
        var tabel_merk = $('#tabel_merk').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "Merk/tampil_data_merk",
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

        // menampilkan modal tambah merk
        $('#tambah_merk').on('click', function () {
            $('#form_merk').trigger('reset');
            $('#aksi').val('Tambah');
            $('#modal_merk').modal('show');
            $('#judul_modal').text('Tambah Data Merk');
        })

        // aksi simpan data merk
        $('#simpan_merk').on('click', function () {

            var form_merk    = $('#form_merk').serialize();
            var nama_merk    = $('#nama_merk').val();

            if (nama_merk == '') {

                swal({
                    title               : "Peringatan",
                    text                : 'Nama merk harus terisi !',
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
                            url     : "merk/simpan_data_merk",
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
                            data    : form_merk,
                            dataType: "JSON",
                            success : function (data) {

                                $('#modal_merk').modal('hide');
                                
                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data berhasil disimpan',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                });    
                
                                tabel_merk.ajax.reload(null,false);        
                                
                                $('#form_merk').trigger("reset");
                                
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

        // edit data merk
        $('#tabel_merk').on('click', '.edit-merk', function () {

            $('#judul_modal').text('Ubah Data Merk');

            var id_merk  = $(this).data('id');

            $.ajax({
                url         : "Merk/ambil_data_merk/"+id_merk,
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

                    $('#modal_merk').modal('show');
                    
                    $('#id_merk').val(data.id);

                    $('#nama_merk').val(data.merk);

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

        // hapus merk
        $('#tabel_merk').on('click', '.hapus-merk', function () {

            var id_merk = $(this).data('id');
            var merk    = $(this).attr('merk');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus merk '+merk+'?',
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
                        url         : "Merk/simpan_data_merk",
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
                        data        : {aksi:'Hapus', id_merk:id_merk},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_merk.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus merk',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                $('#form_merk').trigger("reset");

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
                            text                : 'Anda membatalkan hapus merk',
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