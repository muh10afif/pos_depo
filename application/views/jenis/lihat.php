<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-info p-3">
                <button class="btn float-right btn-light" id="tambah_jenis" data-toggle="modal" data-target="#modal_jenis"><i class="ti-plus mr-2"></i>Tambah Data</button>
            
                <h4 id="judul" class="font-weight-bold text-white mb-0 mt-2">Master Jenis</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"  id="tabel_jenis" width="100%" cellspacing="0">
                        <thead class="thead-light text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Jenis</th>
                                <th width="20%">Diskon</th>
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
<div class="modal fade" id="modal_jenis" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="judul_modal">Tambah Data jenis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-dark">&times;</span>
        </button>
      </div>
        <form id="form_jenis" autocomplete="off" class="form-control-line">
            <input type="hidden" name="id_jenis" id="id_jenis">
            <input type="hidden" name="aksi" id="aksi" value="Tambah">
            <div class="modal-body">
                <div class="col-md-12 p-3">
                    <div class="form-group row">
                        <label for="nama_jenis" class="col-sm-3 col-form-label">Jenis</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_jenis" id="nama_jenis" placeholder="Masukkan Jenis">
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="nama_jenis" class="col-sm-3 col-form-label">Diskon</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp. </span>
                                </div>
                                <input type="text" class="form-control numeric number_separator ml-2" name="diskon" id="diskon" placeholder="Masukkan Diskon">
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpan_jenis">Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>

    // 16-10-2020

    $(document).ready(function () {

        // menampilkan list jenis
        var tabel_jenis = $('#tabel_jenis').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "jenis/tampil_data_jenis",
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

        // menampilkan modal tambah jenis
        $('#tambah_jenis').on('click', function () {
            $('#form_jenis').trigger('reset');
            $('#aksi').val('Tambah');
            $('#modal_jenis').modal('show');

            $('#judul_modal').text('Tambah Data Jenis');
        })

        // aksi simpan data jenis
        $('#simpan_jenis').on('click', function () {

            var form_jenis  = $('#form_jenis').serialize();
            var nama_jenis  = $('#nama_jenis').val();
            var diskon      = $('#diskon').val();

            if (nama_jenis == '') {

                $('#nama_jenis').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Nama jenis harus terisi !',
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
                    text                : 'Diskon harus terisi !',
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
                    cancelButtonClass   : "btn btn-danger mr-3",

                    showCancelButton    : true,
                    confirmButtonText   : 'Ya',
                    confirmButtonColor  : '#3085d6',
                    cancelButtonColor   : '#d33',
                    cancelButtonText    : 'Batal',
                    reverseButtons      : true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url     : "jenis/simpan_data_jenis",
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
                            data    : form_jenis,
                            dataType: "JSON",
                            success : function (data) {

                                $('#modal_jenis').modal('hide');
                                
                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data berhasil disimpan',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                });    
                
                                tabel_jenis.ajax.reload(null,false);        
                                
                                $('#form_jenis').trigger("reset");
                                
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

        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // edit data jenis
        $('#tabel_jenis').on('click', '.edit-jenis', function () {

            $('#judul_modal').text('Ubah Data jenis');

            var id_jenis  = $(this).data('id');

            $.ajax({
                url         : "jenis/ambil_data_jenis/"+id_jenis,
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

                    $('#modal_jenis').modal('show');
                    
                    $('#id_jenis').val(data.id);

                    $('#nama_jenis').val(data.jenis);
                    $('#diskon').val(separator(data.diskon));

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

        // hapus jenis
        $('#tabel_jenis').on('click', '.hapus-jenis', function () {

            var id_jenis = $(this).data('id');
            var jenis    = $(this).attr('jenis');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus jenis '+jenis+'?',
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
                        url         : "jenis/simpan_data_jenis",
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
                        data        : {aksi:'Hapus', id_jenis:id_jenis},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_jenis.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus jenis',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                $('#form_jenis').trigger("reset");

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
                            text                : 'Anda membatalkan hapus jenis',
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