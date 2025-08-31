<?php
// order.php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'laundry_db';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
// Ambil data dari form
$nama    = $_POST['nama'] ?? '';
$telepon = $_POST['telepon'] ?? '';
$alamat  = $_POST['alamat'] ?? '';
$layanan = $_POST['layanan'] ?? '';
$jumlah  = $_POST['jumlah'] ?? '';
// Validasi sederhana
if ($nama && $telepon && $alamat && $layanan && $jumlah) {
    $stmt = $conn->prepare("INSERT INTO pesanan (nama, telepon, alamat, layanan, jumlah, waktu) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param('ssssi', $nama, $telepon, $alamat, $layanan, $jumlah);
    if ($stmt->execute()) {
        echo 'Pesanan berhasil disimpan!';
    } else {
        echo 'Gagal menyimpan pesanan.';
    }
    $stmt->close();
} else {
    echo 'Data tidak lengkap.';
}
$conn->close();
?>
