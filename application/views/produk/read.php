<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page">
    <div class="container-fluid page__container">
      <div class="row" id="kategori">
        <?php foreach($kategori as $row) { ?>
          <div class="col-md-3">
            <div class="card shadow">
              <div class="card-body" align="center">
                <h4>
                  <a href="javascript:void(0)" class="kategori text-dark" style="font-weight: bold"><?php echo $row->kategori ?></a>
                </h4>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
      <div class="row" id="produk">
        <div class="col-md-12">
          <a href="javascript:void(0)" class="float-right btn btn-danger btn-xs mb-3" id="back">Kembali</a>
        </div>
      </div>
    </div>
</div>
</div>
</div>
<script>
  function number_format (number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
  };

  $(document).ready(function() {
    $('#produk').hide();
    $('.kategori').click(function(event) {
      var kategori = $(this).text();
      $('#kategori').fadeOut();
      $('#produk').fadeIn('fast', function() {
        $.ajax({
          url: '<?php echo base_url('Produk/get_detail') ?>',
          type: 'post',
          dataType: 'json',
          data: {kategori: kategori},
        })
        .done(function(result) {
          // if(result !== '')
          // {
            $.each(result, function(i, data){
              if(data.id_bahan == 0) {
                $('#produk').append(`
                  <div class="col-md-3 produk">
                    <div class="card shadow">
                      <img class="card-img-top" src="<?php echo base_url() ?>assets/img/upload/produk/`+data.foto_produk+`" alt="`+data.foto_produk+`" height="250">
                      <div class="card-body">
                          <ul>
                            <li>Nama Produk: `+data.nama_product+`</li>
                            <li>Merk: `+data.merk+`</li>
                            <li>Ukuran: `+data.Ukuran+`</li>
                            <li>Harga: Rp. `+number_format(data.harga,0,',',',')+`</li>
                            <li>HPP: Rp. `+number_format(data.hpp,0,',',',')+`</li>
                            <li>Harga Reseller: Rp. `+number_format(data.harga_reseller,0,',',',')+`</li>
                          </ul>
                      </div>
                    </div>
                  </div>
                `)
              }
              else
              {
                $('#produk').append(`
                  <div class="col-md-3 produk">
                    <div class="card shadow">
                      <img class="card-img-top" src="<?php echo base_url() ?>assets/img/upload/produk/`+data.foto_produk+`" alt="`+data.foto_produk+`" height="250">
                      <div class="card-body">
                          <ul>
                            <li>Nama Produk: `+data.nama_product+`</li>
                            <li>Bahan: `+data.nama_bahan+`</li>
                            <li>Merk: `+data.merk+`</li>
                            <li>Ukuran: `+data.Ukuran+`</li>
                            <li>Harga: Rp. `+number_format(data.harga,0,',',',')+`</li>
                            <li>HPP: Rp. `+number_format(data.hpp,0,',',',')+`</li>
                            <li>Harga Reseller: Rp. `+number_format(data.harga_reseller,0,',',',')+`</li>
                          </ul>
                      </div>
                    </div>
                  </div>
                `)
              }
            })
          // }
          // else
          // {
          //   $('#produk').html(`
          //     <div class="col">
          //       <h1 class="text-center">`+result.Error+`</h1>
          //     </div>
          //   `);
          // }
        })
      });
    });
    $('#back').click(function(event) {
      $('.produk').remove();
      $('#produk').fadeOut();
      $('#kategori').fadeIn();
    });
  });
</script>