<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Dokter</title>
</head>
<body>
    <h1>CRUD Dokter</h1>
    <form method="POST">
        <label for="kodeDokter">Kode Dokter</label>
        <input type="text" name="kodeDokter" required>

        <label for="namaDokter">Nama Dokter</label>
        <input type="text" name="namaDokter">

        <label for="jenisKelamin">Jenis Kelamin</label>
        <input type="radio" name="jenisKelamin" value="L" required> Laki-laki
        <input type="radio" name="jenisKelamin" value="P" required> Perempuan

        <label for="kodeSpesialisasi">Spesialisasi</label>
        <select name="kodeSpesialisasi">
            <?php foreach ($specializations as $spec) : ?>
                <option value="<?= $spec['KodeSpesialisasi'] ?>"><?= $spec['NamaSpesialisasi'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="handphone">No Handphone</label>
        <input type="text" name="handphone">

        <input type="submit" name="create" value="Simpan">
    </form>

    <h2>Daftar Dokter</h2>
    <table border="1">
        <tr>
            <th>Kode Dokter</th>
            <th>Nama Dokter</th>
            <th>Jenis Kelamin</th>
            <th>Spesialisasi</th>
            <th>No Handphone</th>
            <th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT t_dokter.*, t_spesialisasi.NamaSpesialisasi FROM t_dokter
                LEFT JOIN t_spesialisasi ON t_dokter.KodeSpesialisasi = t_spesialisasi.KodeSpesialisasi";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['KodeDokter'] . "</td>";
                echo "<td>" . $row['NamaDokter'] . "</td>";
                echo "<td>" . $row['JenisKelamin'] . "</td>";
                echo "<td>" . $row['NamaSpesialisasi'] . "</td>";
                echo "<td>" . $row['Handphone'] . "</td>";
                echo "<td>
                        <form method='POST'>
                            <input type='hidden' name='kodeDokter' value='" . $row['KodeDokter'] . "'>
                            <input type='submit' name='update' value='Edit'>
                            <input type='submit' name='delete' value='Hapus'>
                        </form>
                      </td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>
</html>
