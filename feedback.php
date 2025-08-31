<?php
// feedback.php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'laundry_db';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
$nama  = $_POST['nama'] ?? '';
$pesan = $_POST['pesan'] ?? '';
if ($nama && $pesan) {
    $stmt = $conn->prepare("INSERT INTO feedback (nama, pesan, waktu) VALUES (?, ?, NOW())");
    $stmt->bind_param('ss', $nama, $pesan);
    if ($stmt->execute()) {
        echo 'Feedback berhasil disimpan!';
    } else {
        echo 'Gagal menyimpan feedback.';
    }
    $stmt->close();
} else {
    echo 'Data tidak lengkap.';
}
$conn->close();
?>
