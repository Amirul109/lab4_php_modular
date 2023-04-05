<?php
include("koneksi.php");
// query untuk menampilkan data
$sql = 'SELECT * FROM data_barang';
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan</title>
    <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
      <div class="container">
        <h1>Data Barang</h1>
        <div class="main">
        
          <table>
          <tr>
            <th>Gambar</th>
            <th>Nama Barang</th>
            <th>Katagori</th>
            <th>Harga Jual</th>
            <th>Harga Beli</th>
            <th>Stok</th>
            <th>Aksi</th>
          </tr>
          <?php if ($result) : ?>
          <?php while ($row = mysqli_fetch_array($result)) : ?>
          <tr>
            <td><img src="<?= $row['gambar']; ?>" alt="<?=
      $row['nama']; ?>"></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['kategori']; ?></td>
            <td><?= $row['harga_jual']; ?></td>
            <td><?= $row['harga_beli']; ?></td>
            <td><?= $row['stok']; ?></td>
            <td><a href="ubah.php?id=<?= $row['id_barang']; ?>">Change</a> <a href="hapus.php?id=<?= $row['id_barang']; ?>">Delete</a></td>
          </tr>
          <?php endwhile; else : ?>
          <tr>
            <td colspan="7">Belum ada data</td>
          </tr>
          <?php endif; ?>
          </table>
          <td><a class="button" type="submit" href="tambah.php">Tambah Barang</a>
        </div>
      </div>
    </body>
</html>