<?php
include('koneksi.php');

if (isset($_GET['edit'])) {
    $Edit = $_GET['edit'];

    $query = "SELECT * FROM mahasiswa WHERE nim = '$Edit'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $mahasiswa = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Data Mahasiswa</title>
            <style>
            body {
                font-family: Arial, sans-serif;
                background: linear-gradient(135deg, #3498db, #2ecc71);
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            h2 {
                text-align: center;
                color: #333;
            }

            form {
                max-width: 600px;
                margin: 20px auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            label {
                display: block;
                margin-bottom: 8px;
                color: #333;
            }

            input[type="text"], select {
                width: 100%;
                padding: 8px;
                margin-bottom: 16px;
                box-sizing: border-box;
            }

            input[type="submit"] {
                background-color: #4caf50;
                color: #fff;
                padding: 10px 15px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }

            input[type="submit"]:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <h2>Edit Data Mahasiswa</h2>
        <form action="proses.php" method="post" onsubmit="showSuccessPopup()">
            <input type="hidden" name="nim" value="<?php echo $mahasiswa['nim']; ?>">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" value="<?php echo $mahasiswa['nama']; ?>" required>

            <label for="nim">NIM:</label>
            <input type="text" name="nim" value="<?php echo $mahasiswa['nim']; ?>" required readonly>

            <label for="program_studi">Program Studi:</label>
            <select name="program_studi" required>
                <option value="">---Pilih Prodi---</option>
                <option value="Teknik Informatika" <?php echo ($mahasiswa['program_studi'] == 'Teknik Informatika') ? 'selected' : ''; ?>>Teknik Informatika</option>
                <option value="Teknik Sipil" <?php echo ($mahasiswa['program_studi'] == 'Teknik Sipil') ? 'selected' : ''; ?>>Teknik Sipil</option>
                <option value="Teknik Elektro" <?php echo ($mahasiswa['program_studi'] == 'Teknik Elektro') ? 'selected' : ''; ?>>Teknik Elektro</option>
                <option value="Teknik Kimia" <?php echo ($mahasiswa['program_studi'] == 'Teknik Kimia') ? 'selected' : ''; ?>>Teknik Kimia</option>
                <option value="Teknik Mesin" <?php echo ($mahasiswa['program_studi'] == 'Teknik Mesin') ? 'selected' : ''; ?>>Teknik Mesin</option>
            <input type="submit" value="Simpan Perubahan">
        </form>
    </body>
</html>
