<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-transform: capitalize;
    }

    .container {
      max-width: 8000px;
      margin: 0 auto;
      padding: 20px;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .header img {
      width: 100%;
      height: auto;
    }

    .table-container {
      margin-top: 20px;
    }

    table {
      width: 100%; 
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #000;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
    }

    td:nth-child(2) {
      text-align: center;
      text-transform: capitalize;
    }

    td:nth-child(4) {
      text-align: center;
      text-transform: capitalize;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Laporan Penjualan</h1>
    </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Nama Barang</th>
            <th class="text-center">QTY</th>
            <th class="text-center">Total Harga Pengeluaran</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $total_pengeluaran = 0;
          $total_qty = 0;
          $no = 1;
          foreach ($data as $dataa) {
            $total_pengeluaran += $dataa->total_harga; 
            $total_qty += $dataa->qty; 
            ?>
            <tr>
              <td class="text-capitalize text-center"><?php echo $dataa->tanggal_laporan?></td>
              <td class="text-capitalize text-center"><?php echo $dataa->nama_barang?></td>
              <td class="text-center text-capitalize text-dark text-success"><?php echo $dataa->qty?></td>
              <td class="text-capitalize text-center">Rp <?php echo number_format($dataa->total_harga, 2, ',', '.'); ?></td>
            </tr>
          <?php }?>
          <tr>
              <td class="text-capitalize text-center" colspan="2"><b>TOTAL :</b></td>
              <td class="text-capitalize text-center"><b><?php echo($total_qty); ?></b></td>
              <td class="text-capitalize text-center"><b>Rp <?php echo number_format($total_pengeluaran, 2, ',', '.'); ?></b></td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    window.print();
  </script>
</body>
</html>
