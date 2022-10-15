<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("location: login.php");
	exit;
}

require 'functions.php';
// cek apakah tombol submit sudah d tekan atau blm
if( isset($_POST["submit"]) ) {
	

	
	
	// cek apakah data berhasil di tambahkan atau tidak
	if( tambah($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil ditambahakan')
				document.location.href= 'index.php'
			</script>
			";
	} else {
		echo "<script>
				alert('data gagal ditambahakan')
				document.location.href= 'tambah.php'
			</script>";
	}

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Anggota</title><link href="/frost.industries/foto/icon/logo fi.png" rel="icon" type="image/png">
</head>
<body>
	<h1>Tambah Data Anggota</h1>
	
		<form action="" method="post" enctype="multipart/form-data">
			<ul>
				<li>
					<label for="nama">Nama :</label>
					<input type="text" name="nama" id="nama" required>
				</li>
				<li>
					<label for="no">No Hp :</label>
					<input type="text" name="no" id="no">
				</li>
				<li>
					<label for="email">Email :</label>
					<input type="text" name="email" id="email">
				</li>
				<li>
					<label for="hobby">Hobby :</label>
					<input type="text" name="hobby" id="hobby">
				</li>
				<li>
					<label for="gambar">Gambar :</label>
					<input type="file" name="gambar" id="gambar">
				</li>
				<li>
					<button type="submit" name="submit">Tambah Data</button>
				</li>
			</ul>
			
		</form>
	
	
	
	
<a href="index.php">Kembali</a>
</body>
</html>