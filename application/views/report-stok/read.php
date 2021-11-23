<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page">
    <div class="container-fluid page__container">
    	<div class="row">
    		<div class="col-sm">
    			<div class="card">
	                <div class="card-body">
	                  <form id="form-filter" class="form-horizontal" method="post" action="<?php echo base_url('Report/cetak') ?>">
	                    <div class="card" style="background-color: orange;">
	                      <div class="card-header text-center">
	                        <b>Periode</b>
	                      </div>
	                      <div class="card-body row">
	                        <div class="col-md-1"></div>
	                        <div class="col-md-4">
	                            <input type="text" class="form-control date" id="start" autocomplete="off" name="start_date">
	                        </div>
	                        <div class="col-md-2 text-center text-white">
	                          <b>s/d</b>
	                        </div>
	                        <div class="col-md-4">
	                            <input type="text" class="form-control date" id="end" autocomplete="off" name="end_date">
	                        </div>
	                      </div>
	                      <div class="card-footer">
	                        <div class="row">
	                          <div class="col-md-9">
	                            <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Download laporan PDF" type="submit" name="pdf"><i class="far fa-file-pdf"></i></button>
	                            <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Download laporan Excel" type="submit" name="excel"><i class="far fa-file-excel"></i></button>
	                          </div>
	                          <div class="col-md-3" align="right">
	                            <button type="button" id="btn-filter" class="btn btn-primary">Tampilkan</button>
	                            <button type="reset" id="btn-reset" class="btn btn-secondary">Reset</button>
	                          </div>
	                        </div>
	                      </div>
	                    </div>
	                  </form>
	                </div>
	            </div>
	            <div class="card">
	                <div class="card-body">
	                  <div class="table-wrap">
	                      <table id="table_main" class="table w-100 display pb-30 table-bordered table-striped" width="100%">
	                          <thead class="text-center">
	                              <tr>
	                                  <th width="5%">No.</th>
	                                  <th>Nama Produk</th>
	                                  <th>Barang Masuk</th>
	                                  <th>Barang Keluar</th>
	                                  <th>Barang Retur</th>
	                                  <th>Stok</th>
	                                  <th>Tanggal Transaksi</th>
	                                  <th width="7%">Detail</th>
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
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#table_main').DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Report/stok_read')?>",
                "type": "POST",
                "data": function (data) {
	                data.start_date     = $('#start').val();
	                data.end_date       = $('#end').val();
	            },
            },
            stateSave: true,
            "columnDefs": [
                { 
                    "targets": [0, 2, 3, 4, 5, 7],
                    "orderable": false,
                },
                {
                    "targets": [0],
                    "className": "text-center",
                }
            ],
        });
        $('#btn-filter').click(function(){
	      table.ajax.reload();
	    });

	    $('#btn-reset').click(function(){
	      $('#start').val('');
	      $('#end').val('');
	      table.ajax.reload();
	    });

	    $('#start').mydatepicker(1, {
	      "format": "yyyy-MM-DD"
	    });

	    $('#end').mydatepicker(1, {
	      "format": "yyyy-MM-DD"
	    });
	});
</script>
<!-- IGNORE THIS -->
</div>
</div>