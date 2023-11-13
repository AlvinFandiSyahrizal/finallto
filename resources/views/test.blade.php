<!DOCTYPE html>
<html> lang="en">
<head>
	<title>MENAMPILKAN DATA DARI DATABASE SESUAI TANGGAL DENGAN PHP - WWW.MALASNGODING.COM</title>
</head>
<body>

	<center>

		<h2>MENAMPILKAN DATA DARI DATABASE SESUAI TANGGAL DENGAN PHP<br/><a href="https://www.malasngoding.com">WWW.MALASNGODING.COM</a></h2>


		<?php
		include 'koneksi.php';
		?>

		<br/><br/><br/>

		<form method="get">
			<label>PILIH TANGGAL</label>
			<input type="date" name="tanggal">
			<input type="submit" value="FILTER">
		</form>

		<br/> <br/>

		<table border="1">
			<tr>
				<th>Jam</th>
				<th>Tanggal</th>
				<th>Part Number</th>
				<th>Jumlah</th>
			</tr>
			<?php
			$no = 1;

			if(isset($_GET['Tanggal'])){
				$tgl = $_GET['Tanggal'];
				$sql = mysqli_query($koneksi,"select * from jadwal_line2s");
			}else{
				$sql = mysqli_query($koneksi,"select * from jadwal_line2s");
			}

			while($data = mysqli_fetch_array($sql)){
			?>
			<tr>
				<td><?php echo $no++; ?></td>
                <td><?php echo $data['Jam']; ?></td>
				<td><?php echo $data['Tanggal']; ?></td>
				<td><?php echo $data['PartNumber']; ?></td>
				<td><?php echo $data['Quantity']; ?></td>
			</tr>
			<?php
			}
			?>
		</table>

	</center>
</body>
</html>
