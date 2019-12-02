
<?php 
	include('config.php');
	$d = new DB();

	function upload() {
		$namafile = $_FILES['gambar']['name'];
		$ukuranfile = $_FILES['gambar']['size'];
		$error = $_FILES['gambar']['error'];
		$tmpname = $_FILES['gambar']['tmp_name'];

		// cek apakah ada gambar
		if($error === 4) {
			echo "<script>alert('pilih gambar terlebih dahulu')</script>";
			return false;
		}

		// cek apakah gamabar yang di upload
		$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
		$ekstensiGambar = explode('.', $namafile);
		$ekstensiGambar = strtolower(end($ekstensiGambar));
		if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
			echo "<script>alert('yang anda upload bukan gambar')</script>";
			return false;
		}

		//cek jika ukurannya terlalu besar
		if($ukuranfile > 1000000) {
			echo "<script>alert('ukuran gambar terlalu besar')</script>";
			return false;
		}

		// generate nama baru
		$namaFileBaru = uniqid();
		$namaFileBaru .= $namafile;
		// var_dump($namaFileBaru); die();
		// jika lolos
		move_uploaded_file($tmpname, 'img/' . $namaFileBaru);
		return $namaFileBaru;

	}

	// upload dan insert data
	if(isset($_POST['submit'])) {
		$gambar = upload();
		if (!$gambar){
			// header("location: view.php");
			return false;
		}

		$sql = "INSERT INTO `image` (`id`, `name`, `image`) VALUES (NULL, '".$_POST['nama']."', '".$gambar."')";
		$d->query($sql);
		echo "<script>alert('data berhasil ditambahkan')</script>";
        header("location: view.php");
	} elseif (isset($_POST['update'])) {
		$gambarLama = $_POST['gambarLama'];

		// cek apakah user pilih gambar
		if($_FILES['gambar']['error'] === 4) {
			$gambar = $gambarLama;
		} else {
			$gambar = upload();
		}
		$sql = "UPDATE `image` SET `name` = '".$_POST['nama']."', `image` = '".$gambar."' WHERE `id` = ".$_POST['id'];
		$d->query($sql);
		echo "<script>alert('data berhasil diubah')</script>";
        header("location: view.php");
	}

?>