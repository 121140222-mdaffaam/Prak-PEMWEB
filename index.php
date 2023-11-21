<?php
include ('koneksi.php');

function getMahasiswa($conn, $prodi = null)
{
    $sql = "SELECT * FROM mahasiswa";
    if ($prodi) {
        $sql .= " WHERE program_studi = '$prodi'";
    }

    $result = mysqli_query($conn, $sql);

    $mahasiswa = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $mahasiswa[] = $row;
    }

    return $mahasiswa;
}

function tambahMahasiswa($conn, $nama, $nim, $prodi)
{
    $sql = "INSERT INTO mahasiswa (nama, nim, program_studi) VALUES ('$nama', '$nim', '$prodi')";
    return mysqli_query($conn, $sql);
}

function hapusMahasiswa($conn, $id)
{
    $sql = "DELETE FROM mahasiswa WHERE id = $id";
    return mysqli_query($conn, $sql);
}

function editMahasiswa($conn, $id, $nama, $nim, $prodi)
{
    $sql = "UPDATE mahasiswa SET nama = '$nama', nim = '$nim', program_studi = '$prodi' WHERE id = $id";
    return mysqli_query($conn, $sql);
}

$action = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$prodi = isset($_GET['program_studi']) ? $_GET['program_studi'] : '';

if ($action == 'tambah' && isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['program_studi'];

    tambahMahasiswa($conn, $nama, $nim, $prodi);
    header("Location: index.php");
}

if ($action == 'edit' && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['program_studi'];

    editMahasiswa($conn, $id, $nama, $nim, $prodi);
    header("Location: index.php");
}

if ($action == 'hapus') {
    $id = $_GET['id'];
    hapusMahasiswa($conn, $id);
    header("Location: index.php");
}

$mahasiswa = getMahasiswa($conn, $prodi);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Mahasiswa</title>
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #3498db, #2ecc71);
                margin: 0;
                padding: 0;
            }

            .container {
                width: 80%;
                margin: 50px auto;
                background-color: #fff;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            }

            h1, h2 {
                text-align: center;
                color: #2c3e50;
            }

            form {
                max-width: 400px;
                margin: 20px auto;
            }

            label {
                display: block;
                margin-bottom: 10px;
                color: #34495e;
            }

            input, select {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                box-sizing: border-box;
                border: 1px solid #3498db;
                border-radius: 5px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px auto;
            }

            th, td {
                border: 1px solid #3498db;
                padding: 12px;
                text-align: left;
                color: #2c3e50;
            }

            th {
                background-color: #ecf0f1;
            }

            a {
                text-decoration: none;
                color: #3498db;
                margin-right: 10px;
                transition: color 0.3s ease;
            }

            a:hover {
                color: #2980b9;
            }

            .button-form {
                display: flex;
            }

            button {
                padding: 10px;
                background-color: #2ecc71;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            button:hover {
                background-color: #27ae60;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Data Mahasiswa</h1>
            <form action="index.php" method="get">
                <label for="program_studi">Cari berdasarkan Program Studi:</label>
                <select name="program_studi" id="program_studi" onchange="this.form.submit()">
                    <option value="">---Pilih Prodi---</option>
                    <option value="Teknik Informatika" <?php echo ($prodi == 'Teknik Informatika') ? 'selected' : ''; ?>>Teknik Informatika</option>
                    <option value="Teknik Sipil" <?php echo ($prodi == 'Teknik Sipil') ? 'selected' : ''; ?>>Teknik Sipil</option>
                    <option value="Teknik Elektro" <?php echo ($prodi == 'Teknik Elektro') ? 'selected' : ''; ?>>Teknik Elektro</option>
                    <option value="Teknik Kimia" <?php echo ($prodi == 'Teknik Kimia') ? 'selected' : ''; ?>>Teknik Kimia</option>
                    <option value="Teknik Mesin" <?php echo ($prodi == 'Teknik Mesin') ? 'selected' : ''; ?>>Teknik Mesin</option>
                </select>
            </form>

            <table>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Program Studi</th>
                    <th>Aksi</th>
                </tr>
                <?php foreach ($mahasiswa as $mhs) : ?>
                    <tr>
                        <td><?php echo $mhs['nama']; ?></td>
                        <td><?php echo $mhs['nim']; ?></td>
                        <td><?php echo $mhs['program_studi']; ?></td>
                        <td class="button-form">
                            <form action="hapus.php" method="get">
                                <input type="hidden" name="del" value="<?php echo $mhs['nim']; ?>">
                                <button type="submit">Hapus</button>
                            </form>
                            <form action="edit.php" method="get">
                                <input type="hidden" name="edit" value="<?php echo $mhs['nim']; ?>">
                                <button type="submit">Edit</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <form action="tambah.php" method="post">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" required>
                <label for="nim">NIM:</label>
                <input type="text" name="nim" required>
                <label for="prodi">Program Studi:</label>
                <select name="program_studi" id="program_studi">
                    <option value="">---Pilih Prodi---</option>
                    <option value="Teknik Informatika" <?php echo ($prodi == 'Teknik Informatika') ? 'selected' : ''; ?>>Teknik Informatika</option>
                    <option value="Teknik Sipil" <?php echo ($prodi == 'Teknik Sipil') ? 'selected' : ''; ?>>Teknik Sipil</option>
                    <option value="Teknik Elektro" <?php echo ($prodi == 'Teknik Elektro') ? 'selected' : ''; ?>>Teknik Elektro</option>
                    <option value="Teknik Kimia" <?php echo ($prodi == 'Teknik Kimia') ? 'selected' : ''; ?>>Teknik Kimia</option>
                    <option value="Teknik Mesin" <?php echo ($prodi == 'Teknik Mesin') ? 'selected' : ''; ?>>Teknik Mesin</option>
                <input type="submit" value="Tambahkan">
            </form>
        </div>
    </body>
</html>
