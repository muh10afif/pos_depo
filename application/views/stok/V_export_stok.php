<!doctype html>
<html>
    <head>
        <title>Report Stok</title>

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

    <style>

    #ad thead tr th {
      vertical-align: middle;
      text-align: center;
    }

    th, td {
      padding: 5px;
      font-size: 10px;
    }

    th {
      text-align: center;
    }

    tr th {
      background-color: #122E5D; color: white;
    }
    .a tr td {
      font-weight: bold;
    }
    /* body {
      margin: 20px 20px 20px 20px;
      color: black;
    } */
    h5, h6 {
      font-weight: bold;
      text-align: center;
      font-size: 15px;
    }
    #d th {
      background-color: #122E5D; color: white;
    }
    #tot {
      background-color: #d2e0f7; font-weight: bold;
    }
    #tot_1 {
      font-weight: bold;
    }
    </style>
</head>
<body>

<h6 style="font-weight: bold; margin: 5px;">Report Stok</h6>
<h6 style="font-weight: bold; margin: 5px;">Produk <?= $nm_produk ?></h6><br>

<table border="0">
    <tr>
        <td>Barang Masuk</td>
        <td>: <?= $brg_masuk ?></td>
    </tr>
    <tr>
        <td>Barang Keluar</td>
        <td>: <?= $brg_keluar ?></td>
    </tr>
    <tr>
        <td>Barang Retur</td>
        <td>: <?= $brg_retur ?></td>
    </tr>
    <tr>
        <td>Stok</td>
        <td>: <?= $stok ?></td>
    </tr>
</table>
<br>

  <table border="1" cellspacing="0" width="100%" align="center">
      <thead>
          <tr>
              <th>No</th>
              <th>Barang Masuk</th>
              <th>Barang Keluar</th>
              <th>Barang Retur</th>
              <th>Stok</th>
              <th>Tanggal</th>
          </tr>
      </thead>
      <tbody>
        <?php 

        $i=1; 
        $tot_dis = 0;

        foreach ($trn as $t): ?>
          <tr>
            <td align="center"><?= $i ?>.</td>
            <td align="center"><?= $t['barang_masuk'] ?></td>
            <td align="center"><?= $t['barang_keluar'] ?></td>
            <td align="center"><?= $t['barang_retur'] ?></td>
            <td align="center"><?= $stok ?></td>
            <td align="center"><?= nice_date($t['created_at'], 'd-M-Y H:i:s') ?></td>
          </tr>
        <?php $i++; $tot_dis += $t['discount']; 

            if ($t['barang_masuk'] == 0) {
                $stok = $stok + ($t['barang_keluar'] + $t['barang_retur']);
            } else {
                $stok = $stok - $t['barang_masuk'];
            }
            
        endforeach; ?>
      </tbody>
  </table>
  <br>

</body>

</html>