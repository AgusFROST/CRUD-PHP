<?php
//klo pengen ada jeda
usleep(500000);
require '../functions.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM user
				WHERE
				nama LIKE '%$keyword%' OR
				no LIKE '%$keyword%' OR
				email LIKE '%$keyword%' OR
				gambar LIKE '%$keyword%'
				";
$user = query($query);
?>
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
	<?php foreach( $user as $row ) : ?>
	<tr>
		<td><?= $i; ?></td>
		<td>
			<a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
			<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('apakah anda yakin ingin menghapus??')";>Hapus</a>
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