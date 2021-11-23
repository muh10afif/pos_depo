<style>
    .table-sm {
        border-collapse: separate;
        border-spacing: 0.4em;
    }
</style>
<div class="modal-header text-dark">
    <h4 class="font-weight-bold" id="my-modal-title" style="color: black;"><i class="mdi mdi-information-outline mr-2"></i>Detail Transaksi</h4>
    <button class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table  table-borderless table-sm">
                <tbody>
                <tr>
                    <th scope="row" width="35%">Tanggal</th>
                    <td class="font-weight-bold" width="5%">:</td>
                    <td class="text-right font-weight-bold" ><?= nice_date($report['created_at'], 'd F Y H:i:s') ?></td>
                </tr>
                <tr>
                    <th scope="row">Kode Transaksi</th>
                    <td class="font-weight-bold" width="5%">:</td>
                    <td class="text-right font-weight-bold" ><?= $report['kode_transaksi'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Kasir</th>
                    <td class="font-weight-bold" width="5%">:</td>
                    <td class="text-right font-weight-bold" ><?= $report['username'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Pelanggan</th>
                    <td class="font-weight-bold" width="5%">:</td>
                    <td class="text-right font-weight-bold" ><?= ($report['pelanggan']) ? $report['pelanggan'] : 'Umum' ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12 mt-2 mb-2">
            <div class="progress" style="height: 5px;">
                <div class="progress-bar bg-info" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="col-md-12 table-responsive mt-2">

            <table class="table  table-borderless table-sm">
                <tbody>
                    <?php $tot_dis = 0; foreach ($kategori as $t): 
                        
                        $det = $this->report->get_tr_detail($t['id'], $id_tr)->result_array();
                        
                    ?>

                        <tr class="font-weight-bold">
                            <th scope="row" colspan="3"><mark><u><?= $t['kategori'] ?></u></mark></th>
                        </tr>

                        <?php $no=1; foreach ($det as $k): ?>
                            <tr class="font-weight-bold">
                                <th scope="row" colspan="3"><?= $k['nama_product'] ?></th>
                            </tr>
                            <tr>
                                <td align="left"><?= $k['jumlah'] ?> x <?= number_format($k['harga'] - $k['potongan_harga'],0,'.','.') ?></td>
                                <td align="right">(<?= number_format($k['discount'],0,'.','.') ?>)</td>
                                <td align="right"><?= number_format($k['subtotal'],0,'.','.') ?></td>
                            </tr>
                        <?php $no++; $tot_dis += $k['discount']; endforeach; ?>
                        
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12 mt-2">
            <div class="progress" style="height: 5px;">
                <div class="progress-bar bg-info" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="col-md-12 table-responsive mt-3 d-flex justify-content-center">
            <table class="table  table-borderless table-sm">
                <tbody>
                <tr>
                    <th scope="row" width="35%">Total Diskon</th>
                    <td class="font-weight-bold">: Rp.</td>
                    <td class="text-right font-weight-bold"><?= number_format($report['total_discount'],0,'.','.') ?></td>
                </tr>
                <tr>
                    <th scope="row">Total</th>
                    <td class="font-weight-bold">: Rp.</td>
                    <td class="text-right font-weight-bold"><?= number_format($report['total_harga'],0,'.','.') ?></td>
                </tr>
                <tr>
                    <th scope="row">Total Bayar</th>
                    <td class="font-weight-bold">: Rp.</td>
                    <td class="text-right font-weight-bold">
                        <?= number_format($report['tunai'],0,'.','.') ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Kembali</th>
                    <td class="font-weight-bold">: Rp.</td>
                    <td class="text-right font-weight-bold"><?= number_format($report['tunai'] - $report['total_harga'],0,'.','.') ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <button type="button" class="btn btn-danger mr-3" data-dismiss="modal"><i class="mdi mdi-close-circle mr-2"></i><span>Close</span></button>
                
                <a href="<?php echo base_url('Report/cetak_faktur/'.$id_tr) ?>"  target="_blank" class="btn btn-info mr-2 cetak" data-id="<?= $id_tr ?>"><i class="mdi mdi-printer mr-2"></i><span>Cetak</span></a>
            </div>
        </div>
    </div>
</div>