<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit'])) {

  $nama = $_POST['nama'];
  $kategori = $_POST['kategori'];
  $harga_jual = $_POST['harga_jual'];
  $harga_beli = $_POST['harga_beli'];
  $stok = $_POST['stok'];
  $file_gambar = $_FILES['gambar'];

  $file = $_FILES['gambar'];
  $filename = $file['name'];
  $filetmp = $file['tmp_name'];
  $filetype = $file['type'];
  $filesize = $file['size'];
  $fileerror = $file['error'];

  $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
  if (in_array($filetype, $allowed_types)) {

    if ($filesize <= 7000000) {
      $new_filename = uniqid('', true) . '.' . pathinfo($filename, PATHINFO_EXTENSION);
      $destination = 'gambar/' . $new_filename;
      // Move gambar file to destination folder
     if (move_gambar_file($filetmp, $destination)) {
        // Insert data into database
        $sql = "INSERT INTO data_barang (kategori, nama, gambar, harga_beli, harga_jual, stok) 
                VALUES ('{$kategori}', '{$nama}', '{$destination}', '{$harga_beli}', '{$harga_jual}', '{$stok}')";

        if (mysqli_query($conn, $sql)) {
          header('location: index.php');
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      } else {
        echo 'Error uploading file.';
      }
    } else {
      echo 'File size exceeds limit.';
    }
  } else {
    echo 'File type not allowed.';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css"/>
  <title>Tambah Barang</title>
</head>

<body>
  <div class="container">
    <h1 id="sub">Tambah Barang</h1>
    <div class="main">

      <form method="post" action="tambah.php" enctype="multipart/form-data">

        <div class="input">
          <label>Nama Barang</label>
          <input type="text" name="nama" />
        </div>
        <div class="input">
          <label>Kategori</label>
          <select name="kategori">
            <option value="Komputer">Komputer</option>
            <option value="Elektronik">Elektronik</option>
            <option value="Hand Phone">Hand Phone</option>
          </select>
        </div>
        <div class="input">
          <label>Harga Jual</label>
          <input type="text" name="harga_jual" />
        </div>
        <div class="input">
          <label>Harga Beli</label>
          <input type="text" name="harga_beli" />
        </div>
        <div class="input">
          <label>Stok</label>
          <input type="text" name="stok" />
        </div>
        <div class="input">
          <label>File Gambar</label>
          <input type="file" name="gambar">
        </div>
        <div class="submit">
          <input type="submit" name="submit" value="Simpan" />
          <input type="submit" name="cancel" value="Clear" />
        </div>
      </form>
      <form class="cancel" action="home.php">
        <input type="submit" value="Cancel"/>
      </form>
    </div>
  </div>
</body>

</html>