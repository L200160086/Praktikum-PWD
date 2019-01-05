<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Data Mahasiswa</title>
</head>
<body>
	<?php
	 $koneksi = mysqli_connect('Localhost','root','','informatika');
	?>
	<center>
		<?php
		if(isset($_GET['aksi'])){
			if($_GET['aksi'] == "ubah"){
			$ambil = mysqli_fetch_row(mysqli_query($koneksi,"select * from mahasiswa where NIM='".$_GET['NIM']."'"));
		?>
		<h3>Update Data Mahasiswa : </h3>
		<table border="0" width="30%">
		<form method="post" action="">
			<tr>
				<td width="25%">NIM</td>
				<td width="5%">:</td>
				<td width="65%">
					<input type="text" name="NIMX" size="10" value="<?php echo $ambil[0] ?>" disabled>
					<input type="hidden" name="NIM" size="10" value="<?php echo $ambil[0] ?>">
				</td>
			</tr>
			<tr>
				<td width="25%">Nama</td>
				<td width="5%">:</td>
				<td width="65%">
					<input type="text" name="Nama" size="30" value="<?php echo $ambil[1] ?>">
				</td>
			</tr>
			<tr>
				<td width="25%">Kelas</td>
				<td width="5%">:</td>
				<td width="65%">
					<input type="radio" value="A" name="Kelas" <?php if($ambil[2] == "A"){echo "checked";} ?>>A
					<input type="radio" value="B" name="Kelas" <?php if($ambil[2] == "B"){echo "checked";} ?>>B
					<input type="radio" value="C" name="Kelas" <?php if($ambil[2] == "C"){echo "checked";} ?>>C
				</td>
			</tr>
			<tr>
				<td width="25%">Alamat</td>
				<td width="5%">:</td>
				<td width="65%">
					<input type="text" name="Alamat" size="40" value="<?php echo $ambil[3] ?>">
				</td>
			</tr>
		</table>
		<input type="submit" value="Update" name="update">
		</form>
		<?php
			if(isset($_POST['update'])){
				$NIM = $_POST['NIM'];
				$Nama = $_POST['Nama'];
				$Kelas = $_POST['Kelas'];
				$Alamat = $_POST['Alamat'];

				$perintah = mysqli_query($koneksi,"update mahasiswa set Nama='".$Nama."',Kelas='".$Kelas."',Alamat='".$Alamat."' where NIM='".$NIM."'");
				echo "<br>Data Berhasil diupdate";
				header("location:Modul5 2.php");
			}
			}
		}else{
		?>
		<h3>Masukkan Data Mahasiswa : </h3>
		<table border="0" width="30%">
		<form method="post" action="">
			<tr>
				<td width="25%">NIM</td>
				<td width="5%">:</td>
				<td width="65%">
					<input type="text" name="NIM" size="10">
				</td>
			</tr>
			<tr>
				<td width="25%">Nama</td>
				<td width="5%">:</td>
				<td width="65%">
					<input type="text" name="Nama" size="30">
				</td>
			</tr>
			<tr>
				<td width="25%">Kelas</td>
				<td width="5%">:</td>
				<td width="65%">
					<input type="radio" value="A" name="Kelas" checked>A
					<input type="radio" value="B" name="Kelas">B
					<input type="radio" value="C" name="Kelas">C
				</td>
			</tr>
			<tr>
				<td width="25%">Alamat</td>
				<td width="5%">:</td>
				<td width="65%">
					<input type="text" name="Alamat" size="40">
				</td>
			</tr>
		</table>
		<input type="submit" value="Masukkan" name="submit">
		</form>
		<?php
		}
		if(isset($_POST['submit'])){
			$NIM = $_POST['NIM'];
			$Nama = $_POST['Nama'];
			$Kelas = $_POST['Kelas'];
			$Alamat = $_POST['Alamat'];

			$perintah = "insert into mahasiswa (NIM,Nama,Kelas,Alamat) values ('".$NIM."','".$Nama."','".$Kelas."','".$Alamat."')";
			if(isset($_POST['submit']) && $NIM == ""){
				echo "<br>NIM tidak boleh kosong, diisi dulu";
			}elseif($Alamat == ""){
				echo "<br>Alamat tidak boleh kosong, diisi dulu";
			}elseif($Nama == ""){
				echo "<br>Nama tidak boleh kosong, diisi dulu";
			}else{
				mysqli_query($perintah);
				echo "<br>Data berhasil dimasukkan";
			}
		}
		?>
		<hr>
		<h3>Data Mahasiswa</h3>
		<table border="1" width="50%">
			<tr>
				<td align="center" width="20%">NIM</td>
				<td align="center" width="20%">Nama</td>
				<td align="center" width="10%">Kelas</td>
				<td align="center" width="20%">Alamat</td>
				<td align="center" width="20%">Keterangan</td>
			</tr>
			<?php
			$cari = "select * from Mahasiswa order by NIM";
			$hasil_cari = mysqli_query($koneksi,$cari);
			while($data=mysqli_fetch_row($hasil_cari)){
			?>
			<tr>
				<td align="center" width="20%"><?php echo $data[0] ?></td>
				<td align="center" width="20%"><?php echo $data[1] ?></td>
				<td align="center" width="10%"><?php echo $data[2] ?></td>
				<td align="center" width="20%"><?php echo $data[3] ?></td>
				<td align="center" width="20%"><a href="?NIM=<?php echo $data[0] ?>&aksi=ubah">Ubah</a></td>
			</tr>
			<?php
			}
			?>
		</table>
	</center>
</body>
</html>