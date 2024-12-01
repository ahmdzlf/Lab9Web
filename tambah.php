<?php 
require('header.php');
include_once 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;

    if ($file_gambar['error'] == 0) {
        $filename = str_replace(' ', '_', $file_gambar['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;
        if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
            $gambar = 'gambar/' . $filename;
        }
    }

    $sql = 'INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok, gambar) ';
    $sql .= "VALUES ('{$nama}', '{$kategori}', '{$harga_jual}', '{$harga_beli}', '{$stok}', '{$gambar}')";
    $result = mysqli_query($conn, $sql);

    header('location: index.php');
}
?>
<div class="main">
    <h2>Tambah Barang</h2>
    <form method="post" action="tambah.php" enctype="multipart/form-data">
        <div>
            <label>Nama Barang</label>
            <input type="text" name="nama">
        </div>
        <div>
            <label>Kategori</label>
            <select name="kategori">
                <option value="Komputer">Komputer</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Hand Phone">Hand Phone</option>
            </select>
        </div>
        <div>
            <label>Harga Jual</label>
            <input type="text" name="harga_jual">
        </div>
        <div>
            <label>Harga Beli</label>
            <input type="text" name="harga_beli">
        </div>
        <div>
            <label>Stok</label>
            <input type="text" name="stok">
        </div>
        <div>
            <label>File Gambar</label>
            <input type="file" name="file_gambar">
        </div>
        <div>
            <input type="submit" name="submit" value="Simpan">
        </div>
    </form>
</div>
<?php require('footer.php'); ?>
