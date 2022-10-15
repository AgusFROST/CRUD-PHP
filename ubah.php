<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("location: login.php");
	exit;
}

require 'functions.php';

// ambil data di urldecode
$id = $_GET["id"];


// query data user berdasarkan id
$us = query("SELECT * FROM user WHERE id = $id")[0];


// cek apakah tombol submit sudah d tekan atau blm
if( isset($_POST["submit"]) ) {


	// cek apakah data berhasil di tambahkan atau tidak
	if( ubah($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil diubah')
				document.location.href= 'index.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('data gagal diubah')
				document.location.href= 'ubah.php'
			</script>";
	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ubah Data Anggota</title><link href="/frost.industries/foto/icon/logo fi.png" rel="icon" type="image/png">
</head>
<body>
	<h1>Ubah Data Anggota</h1>
	
		<form action="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?= $us["id"]; ?>">
			<input type="hidden" name="gambarLama" value="<?= $us["gambar"]; ?>">
			<ul>
				<li>
					<label for="nama">Nama :</label>
					<input type="text" name="nama" id="nama" value="<?= $us["nama"]; ?>">
				</li>
				<li>
					<label for="no">No Hp :</label>
					<input type="text" name="no" id="no" value="<?= $us["no"]; ?>">
				</li>
				<li>
					<label for="email">Email :</label>
					<input type="text" name="email" id="email" required value="<?= $us["email"]; ?>">
				</li>
				<li>
					<label for="hobby">Hobby :</label>
					<input type="text" name="hobby" id="hobby" value="<?= $us["hobby"]; ?>">
				</li>
				<li>
					<label for="gambar">Gambar :</label> <br>
					<img src="img/<?= $us['gambar']; ?> "> <br>
					<input type="file" name="gambar" id="gambar">
				</li>
				<li>
					<button type="submit" name="submit">Ubah Data</button>
				</li>
			</ul>
			
		</form>
	
	
	
	
<a href="index.php">Kembali</a>
</body>
</html>