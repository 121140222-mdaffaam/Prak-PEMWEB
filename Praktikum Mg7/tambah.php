<?php
include ('koneksi.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['program_studi'];

    $query = "INSERT INTO mahasiswa(nama,nim,program_studi) VALUES ('$nama','$nim','$prodi')";

    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Data telah berhasil ditambahkan.");</script>';
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>