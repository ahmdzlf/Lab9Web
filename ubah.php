<?php 
require('header.php');
include_once 'koneksi.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
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

    $sql = 'UPDATE data_barang SET ';
    $sql .= "nama = '{$nama}', kategori = '{$kategori}', ";
    $sql .= "harga_jual = '{$harga_jual}', harga_beli = '{$harga_beli}', stok = '{$stok}' ";
    if (!empty($gambar)) {
        $sql .= ", gambar = '{$gambar}' ";
    }
    $sql .= "WHERE id_barang = '{$id}'";
    $result = mysqli_query($conn, $sql);

    header('location: index.php');
}

$id = $_GET['id'];
$sql = "SELECT * FROM data_barang WHERE id_barang = '{$id}'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);
?>
<div class="main">
    <h2>Ubah Barang</h2>
    <form method="post" action="ubah.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $data['id_barang']; ?>">
        <div>
            <label>Nama Barang</label>
            <input type="text" name="nama" value="<?= $data['nama']; ?>">
        </div>
        <div>
            <label>Kategori</label>
            <select name="kategori">
                <option value="Komputer" <?= $data['kategori'] == 'Komputer' ? 'selected' : ''; ?>>Komputer</option>
                <option value="Elektronik" <?= $data['kategori'] == 'Elektronik' ? 'selected' : ''; ?>>Elektronik</option>
                <option value="Hand Phone" <?= $data['kategori'] == 'Hand Phone' ? 'selected' : ''; ?>>Hand Phone</option>
            </select>
        </div>
        <div>
            <label>Harga Jual</label>
            <input type="text" name="harga_jual" value="<?= $data['harga_jual']; ?>">
        </div>
        <div>
            <label>Harga Beli</label>
            <input type="text" name="harga_beli" value="<?= $data['harga_beli']; ?>">
        </div>
        <div>
            <label>Stok</label>
            <input type="text" name="stok" value="<?= $data['stok']; ?>">
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
