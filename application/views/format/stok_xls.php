<?php
header('Content-Type: application/xls');
header('Content-Disposition: attachment; filename=Laporan Rekapan Stok.xls');
?>
<style> .str{ mso-number-format:\@; } </style>
<h1><?php echo $ket; ?></h1>
<?php 
$i              = 1;
$barang_masuk   = 0;
$barang_keluar  = 0;
$barang_retur   = 0;
$stok           = 0;
?>
<table>
    <thead>
    	<tr>
            <th>No.</th>
            <th>Barang Masuk</th>
            <th>Barang Keluar</th>
            <th>Barang Kembali</th>
            <th>Stok</th>
            <th>Tanggal Transaksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($laporan as $row) { 
            $barang_masuk   += $row->barang_masuk;
            $barang_keluar  += $row->barang_keluar;
            $barang_retur   += $row->barang_retur;
            $stok           += ($row->barang_masuk - ($row->barang_keluar + $row->barang_retur))
            ?>
            <tr>
                <td><?php echo $i++; ?>.</td>
                <td><?php echo $row->barang_masuk; ?> Unit</td>
                <td><?php echo $row->barang_keluar; ?> Unit</td>
                <td><?php echo $row->barang_retur; ?> Unit</td>
                <td><?php echo $stok; ?> Unit</td>
                <td><?php echo date('d-m-Y', strtotime($row->created_at)); ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td>Total</td>
            <td><?php echo $barang_masuk; ?> unit</td>
            <td><?php echo $barang_keluar; ?> unit</td>
            <td><?php echo $barang_retur; ?> unit</td>
            <td colspan="2" style="text-align: center"><?php echo $stok; ?> unit</td>
        </tr>
    </tfoot>
</table>