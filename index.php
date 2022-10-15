<?php
session_start();

if (!isset($_SESSION["login"])) {
	header("location: login.php");
	exit;
}

require 'functions.php';
$user = query("SELECT * FROM user");

// tombol cari ditekan
if (isset($_POST["cari"])) {
	$user = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Halaman Admin</title>
	<link href="/icon/logo fi.png" rel="icon" type="image/png">
	<style>
		.loader {
			width: 70px;
			position: absolute;
			top: 110px;
			z-index: -1;
			display: none;

				{
	</style>
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/script.js"></script>
</head>

<body>

	<a href="logout.php">Logout</a>

	<h1>Daftar Anggota</h1>

	<a href="tambah.php">Tambah Data Anggota</a>
	<br><br>

	<form action="" method="post">

		<input type="text" name="keyword" size="30" autofocus placeholder="Masukan Username..." autocomplete="off" id="keyword">
		<button type="submit" name="cari" id="tombol-cari">Cari</button>

		<img src="img/loader.gif" class="loader">

	</form>

	<br><br>
	<div id="container">
		<table border="1" cellpadding="10" cellspacing="0">

			<tr>
				<th>No.</th>
				<th>Aksi</th>
				<th>Gambar</th>
				<th>Nama</th>
				<th>No Hp</th>
				<th>Email</th>
				<th>Hobby</th>
			</tr>

			<?php $i = 1; ?>
			<?php foreach ($user as $row) : ?>
				<tr>
					<td><?= $i; ?></td>
					<td>
						<a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
						<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('apakah anda yakin ingin menghapus??')" ;>Hapus</a>
					</td>
					<td><img src="img/<?= $row["gambar"]; ?>"></td>
					<td><?= $row["nama"]; ?></td>
					<td><?= $row["no"]; ?></td>
					<td><?= $row["email"]; ?></td>
					<td><?= $row["hobby"]; ?></td>
				</tr>
				<?php $i++; ?>
			<?php endforeach; ?>

		</table>
	</div>


</body>

</html>