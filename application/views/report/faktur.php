<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link type="text/css" href="<?php echo base_url(); ?>assets/bootstrap4/css/bootstrap.css" rel="stylesheet">
	<link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-fontawesome-free.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url(); ?>assets/template/css/vendor-fontawesome-free.rtl.css" rel="stylesheet">
	<style type="text/css" media="print">
	  /* @page { 
	  	margin: 0;
	  	size: 21.59cm 13.97cm portrait; 
	  } */

	  /* @media print and (width: 21cm) and (height: 29.7cm) {
			@page {
				margin: 0;
			}
		} */
	  .container {
		margin-top: 10px;
		/* padding-top: 30px; */
		
	}

	@media print {

		@page {
			size: 21.00cm 13.97cm;
			margin: 0;
		}

	}
	</style>
	<style>
		tfoot {
			box-sizing: content-box !important;
		}
	</style>
</head>
<body>
	<?php  
    // $this->db->select('trn_detail_transaksi.*, trn_transaksi.total_harga, trn_transaksi.total_discount, trn_transaksi.nama_pelanggan, trn_transaksi.alamat_pelanggan, mst_kategori.kategori, mst_product.nama_product, mst_product.harga')
    // ->from('trn_detail_transaksi')
    // ->join('trn_transaksi', 'trn_transaksi.id = trn_detail_transaksi.id_transaksi', 'inner')
    // ->join('mst_product', 'mst_product.id = trn_detail_transaksi.id_product', 'left')
    // ->join('mst_kategori', 'mst_kategori.id = mst_product.id_kategori')
    // ->where('trn_detail_transaksi.id_transaksi', $row->id);
    // $query = $this->db->get();
	// $detil = $query->result();
	
	$detil = $this->report->get_tr_detail_r($row->id)->result();

    $total = 0;
    ?>
	<div class="container">
		<div class="card border-dark" style="margin: 0;">
			<div class="card-header border-dark">
				<div class="row">
					<div class="col-sm-6">
						<h1>Hegarmanah Furniture</h1>
						<h6>Jl. Raya Sukadami, Sukadami, Wanayasa, Kabupaten Purwakarta, Jawa Barat 41174</h6>
						<p>083843157618</p>
					</div>
					<div class="col-sm-6">
						<img class="float-right" src="<?= base_url() ?>assets/img/bannerlogo.png" alt="" height="110">
					</div>
				</div>
				
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-sm-2">
						<p>Kode Transaksi</p>
						<p>Kepada</p>
					</div>
					<div class="col-sm-3" align="left">
						<p>: <?php echo $row->kode_transaksi ?></p>
						<p>: <?php echo $row->pelanggan ?></p>
					</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-2 align="right">
						<p>Tanggal</p>
						<p>Alamat</p>
					</div>
					<div class="col-sm-4" align="left">
						<?php if(strftime('%A',strtotime($row->created_at)) == 'Monday') { ?>
						<p>: Senin, <?php echo date('d-m-Y', strtotime($row->created_at)) ?></p>
						<?php } ?>
						<?php if(strftime('%A',strtotime($row->created_at)) == 'Tuesday') { ?>
						<p>: Selasa, <?php echo date('d-m-Y', strtotime($row->created_at)) ?></p>
						<?php } ?>
						<?php if(strftime('%A',strtotime($row->created_at)) == 'Wednesday') { ?>
						<p>: Rabu, <?php echo date('d-m-Y', strtotime($row->created_at)) ?></p>
						<?php } ?>
						<?php if(strftime('%A',strtotime($row->created_at)) == 'Thursday') { ?>
						<p>: Kamis, <?php echo date('d-m-Y', strtotime($row->created_at)) ?></p>
						<?php } ?>
						<?php if(strftime('%A',strtotime($row->created_at)) == 'Friday') { ?>
						<p>: Jum'at, <?php echo date('d-m-Y', strtotime($row->created_at)) ?></p>
						<?php } ?>
						<?php if(strftime('%A',strtotime($row->created_at)) == 'Saturday') { ?>
						<p>: Sabtu, <?php echo date('d-m-Y', strtotime($row->created_at)) ?></p>
						<?php } ?>
						<?php if(strftime('%A',strtotime($row->created_at)) == 'Sunday') { ?>
						<p>: Minggu, <?php echo date('d-m-Y', strtotime($row->created_at)) ?></p>
						<?php } ?>
						<p>: <?php echo $row->alamat ?></p>
					</div>
					<div class="col-sm-12">
						<table class="table table-borderless table-sm" style="margin-bottom: -10px;">
							<thead class="border-dark" style="border: solid; text-align: center; border-color: #000;">
								<tr>
									<th>Nama Barang</th>
									<th>Kategori</th>
									<th>Jumlah</th>
									<th>Harga</th>
									<th>Diskon</th>
									<th>Sub Total</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($detil as $row2) : ?>
			                    <tr>
			                      <td><?php echo $row2->nama_product ?></td>
			                      <td><?php echo $row2->kategori ?></td>
			                      <td  align='center'><?php echo $row2->jumlah ?></td>
			                      <td>Rp. <?php echo number_format($row2->harga) ?></td>
			                      <td>Rp. <?php echo number_format($row2->discount) ?></td>
			                      <td>Rp. <?php echo number_format($row2->subtotal) ?></td>
			                    </tr>
			                  <?php endforeach ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="5" align="right" style="border: none;"><b>TOTAL</b></td>
									<td style="border: none;">Rp. <?php echo number_format($row->total_harga) ?></td>
								</tr>
								<tr>
									<td style="border: none;" colspan="5" align="right"><b>TUNAI</b></td>
									<td style="border: none;">Rp. <?php echo number_format($row->tunai) ?></td>
								</tr>
								<tr>
									<td style="border: none;" colspan="5" align="right"><b>KEMBALI</b></td>
									<td style="border: none;">Rp. <?php echo number_format($row->tunai - $row->total_harga) ?></td>
								</tr>
							</tfoot>
							 
						</table>
						<table class="table table-borderless" style="margin-bottom: -20px; margin-top: 10px;">
							<tfoot>
								<tr>
									<td colspan="2" style="border: none; text-align: center;">Admin</td>
									<td colspan="2" style="border: none; text-align: center;">Kurir</td>
									<td colspan="2" style="border: none; text-align: center;">Penerima</td>
								</tr>
								<tr>
									<td colspan="2" style="border: none; text-align: center;">__________________</td>
									<td colspan="2" style="border: none; text-align: center;">__________________</td>
									<td colspan="2" style="border: none; text-align: center;">__________________</td>
								</tr>
								<tr>
									<td colspan="6" style="border: none; text-align: center;">Powered By Bagja Indonesia</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script>
	window.print();
	window.onafterprint = function () {
	    window.close();
	}
</script>
</html>