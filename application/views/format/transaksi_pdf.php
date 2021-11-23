<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
	<h1><?php echo $ket; ?></h1>
  <?php foreach($laporan as $row) { ?>
    <h3><b>Kode Transaksi: <?php echo $row->kode_transaksi ?></b></h3>
    <h3><b>Tanggal: <?php echo date('d-m-Y', strtotime($row->created_at)) ?></b></h3>
    <br>
    <?php  
    $this->db->select('trn_detail_transaksi.*, trn_transaksi.total_harga, mst_product.nama_product, mst_product.harga')
    ->from('trn_detail_transaksi')
    ->join('trn_transaksi', 'trn_transaksi.id = trn_detail_transaksi.id_transaksi', 'inner')
    ->join('mst_product', 'mst_product.id = trn_detail_transaksi.id_product', 'left')
    ->where('trn_detail_transaksi.id_transaksi', $row->id);
    $query = $this->db->get();
    $detil = $query->result();
    $i = 1;
    $total = 0;
    ?>
    <table class="table" border="1" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>No.</th>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Diskon</th>
          <th>Sub Total</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($detil as $row2) { 
          $total += $row2->subtotal;
          ?>
          <tr>
            <td align='center'><?php echo $i++; ?></td>
            <td><?php echo $row2->nama_product ?></td>
            <td>Rp. <?php echo number_format($row2->harga) ?></td>
            <td  align='center'><?php echo $row2->jumlah ?></td>
            <td>Rp. <?php echo number_format($row2->discount) ?></td>
            <td>Rp. <?php echo number_format($row2->subtotal) ?></td>
          </tr>
        <?php } ?>
        <tfoot>
          <tr>
            <td colspan="5" align="center"><b>TOTAL</b></td>
            <td>Rp. <?php echo number_format($total) ?></td>
          </tr>
          <tr>
            <td colspan="5" align="center"><b>TUNAI</b></td>
            <td>Rp. <?php echo number_format($total) ?></td>
          </tr>
          <tr>
            <td colspan="5" align="center"><b>KEMBALI</b></td>
            <td>Rp. 0</td>
          </tr>
        </tfoot>
      </tbody>
    </table>
  <?php } ?>
</body>
</html>