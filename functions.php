<?php
// koneksi ke database
$conn = mysqli_connect("localhost","root","","phpdasar");

// ambil data dari tabel user
function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

// ambil data dari tiap elemen form
function tambah($data) { 
	global $conn;
	
	$nama = htmlspecialchars($data["nama"]);
	$no = htmlspecialchars($data["no"]);
	$email = htmlspecialchars($data["email"]);
	$hobby = htmlspecialchars($data["hobby"]);
	
	//upload gambar
	$gambar = upload();
	if( !$gambar ) {
		return false;
	}
	
	// query insert data
	$query = "INSERT INTO user
			VALUES
			('','$nama','$no','$email','$hobby','$gambar')
			";
	mysqli_query($conn, $query);
	
	return mysqli_affected_rows($conn);
}

function upload() {
	
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];
	
	// cek apakah tidak ada gambar yg diupload
	if( $error === 4 ) {
		echo "<script>
				alert('pilih gambar terlebih dahulu')
			</script>";
		return false;
	}
	
	//  cek apakah yg diupload adl gambar
	$ekstensiGambarValid = ['jpg','jpeg','png','gif'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid ) ) {
		echo "<script>
				alert('Yang anda upload bukan gambar')
			</script>";
			return false;
	}
	
	// cek jika ukuran terlalu besar
	if( $ukuranFile > 2000000 ) {
		echo "<script>
				alert('Ukuran gambar terlalu besar')
			</script>";
		return false;
	}
	
	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;
	
	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

	return $namaFileBaru;
	
}




function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM user WHERE id = $id");
	
	return mysqli_affected_rows($conn);
}

function ubah($data) {
	global $conn;
	
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$no = htmlspecialchars($data["no"]);
	$email = htmlspecialchars($data["email"]);
	$hobby = htmlspecialchars($data["hobby"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);
	
	//cek apakah user pilih gambar baru atau tidak
	if( $_FILES['gambar']['error'] === 4 ) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}
	// query insert data
	$query = "UPDATE user SET
			nama = '$nama',
			no = '$no',
			email = '$email',
			hobby = '$hobby',
			gambar = '$gambar'
			WHERE id = $id
			";
	mysqli_query($conn, $query);
	
	return mysqli_affected_rows($conn);
}


function cari($keyword) {
	$query = "SELECT * FROM user
				WHERE
				nama LIKE '%$keyword%' OR
				no LIKE '%$keyword%' OR
				email LIKE '%$keyword%' OR
				gambar LIKE '%$keyword%'
				";
	return query($query);
}



function registrasi($data) {
	global $conn;
	
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn,$data["password"]);
	$password2 = mysqli_real_escape_string($conn,$data["password2"]);
	
	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM akun WHERE username = '$username'");
	
	if( mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('Username sudah terdaftar!')
			</script>";
		return false;
	}
	
	
	// cek konfirmasi password
	if( $password !== $password2 ) {
		echo "<script>
				alert('Konfirmasi password tidak sesuai')
			</script>";
			return false;
	}
	
	// enkripsi password paling aman // 	//enkripsi agak aman, tinggal salin kode enkripsi ke google\/$password = md5($password); 
	$password = password_hash($password, PASSWORD_DEFAULT);
	
	// tambahkan user baru ke database
	mysqli_query($conn, "INSERT INTO akun VALUES('','$username', '$password')");
	
	return mysqli_affected_rows($conn);
	
}







?>