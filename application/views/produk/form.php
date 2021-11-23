<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page">
    <div class="container-fluid page__container">
        <?php $this->view('messages') ?>
        <form action="<?php echo base_url('Produk/create') ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_product">Nama Product</label>
                <input type="text" id="nama_product" class="form-control" name="nama_product" required autofocus autocomplete="off">
            </div>
            <div class="form-group">
                <label for="id_kategori">Kategori</label>
                <select name="id_kategori" id="id_kategori" class="form-control" required>
                    <option selected disabled hidden>--PILIH--</option>
                    <?php  
                    foreach($kategori as $row) {
                    ?>
                    <option value="<?php echo $row->id ?>"><?php echo $row->kategori ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group" id="form-bahan">
                <label for="id_bahan">Bahan</label>
                <select name="id_bahan" id="id_bahan" class="form-control">
                    <option selected disabled hidden>--PILIH--</option>
                    <?php  
                    foreach($bahan as $row) {
                    ?>
                    <option value="<?php echo $row->id ?>"><?php echo $row->nama_bahan ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_merk">Merk</label>
                <select name="id_merk" id="id_merk" class="form-control" required>
                    <option selected disabled hidden>--PILIH--</option>
                    <?php  
                    foreach($merk as $row) {
                    ?>
                    <option value="<?php echo $row->id ?>"><?php echo $row->merk ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="width-ukuran">Ukuran</label>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" id="width-ukuran" name="lebar" class="form-control" required placeholder="Lebar" autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="panjang" class="form-control" required placeholder="Panjang" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                    </div>
                    <input type="text" id="harga" class="form-control" name="harga" required autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <label for="hpp">HPP</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                    </div>
                    <input type="text" id="hpp" class="form-control" name="hpp" required autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <label for="harga_reseller">Harga Reseller</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                    </div>
                    <input type="text" id="harga_reseller" class="form-control" name="harga_reseller" required autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <label for="foto_produk" class="control-label">Foto Produk</label>
                <input name="foto_produk" id="foto_produk" type="file" class="dropify" data-max-file-size="5M" data-show-errors="true" data-allowed-file-extensions="jpg png jpeg"/>
            </div>
            <div class="form-group float-right">
                <button role="submit" class="btn btn-success btn-flat foat-right"><i class="fa fa-plus"></i> Tambah Produk</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<script>
    $(document).ready(function() {
        $('#form-bahan').hide();
        $('#id_kategori').change(function(event) {
            var id = $('select[name=id_kategori] option').filter(':selected').val()
           $.ajax({
               url: '<?php echo base_url("Produk/get_bahan") ?>',
               type: 'post',
               dataType: 'json',
               data: {id: id},
           })
           .done(function(data) 
           {
               if(data.have_bahan < 1)
               {
                $('#form-bahan').hide();
               }
               else
               {
                $('#form-bahan').show();
               }
           })
        });
        $('.dropify').dropify({
          messages: 
          {
              'default': 'Seret file atau ketik di sini',
              'replace': 'Seret file atau ketik di sini',
              'remove':  'Buang',
              'error':   'Maaf, ada kesalahan.'
          }
        });
        $('#harga').keyup(function(event) {
            if(event.which >= 37 && event.which <= 40) return;
            $(this).val(function(index, value) {
              return value
              .replace(/\D/g, "")
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
              ;
            });
        });
        $('#hpp').keyup(function(event) {
            if(event.which >= 37 && event.which <= 40) return;
            $(this).val(function(index, value) {
              return value
              .replace(/\D/g, "")
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
              ;
            });
        });
        $('#harga_reseller').keyup(function(event) {
            if(event.which >= 37 && event.which <= 40) return;
            $(this).val(function(index, value) {
              return value
              .replace(/\D/g, "")
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
              ;
            });
        });
    });
</script>