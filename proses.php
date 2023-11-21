<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['program_studi'];

    $update_query = "UPDATE mahasiswa SET nama = '$nama', program_studi = '$prodi' WHERE nim = '$nim'";
    $result = mysqli_query($conn, $update_query);

    if ($result) {
        echo '<script>alert("Data berhasil diubah.");</script>';
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
    exit();
}
?>
