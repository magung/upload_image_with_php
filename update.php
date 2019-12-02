<?php 
	include('config.php');
	$d = new DB();
	$sql = 'SELECT * FROM `image` WHERE id ='. $_REQUEST['id'];
	$result = $d->getList($sql);
	// var_dump($result);
?>
<style type="text/css">
		img {
		  border: 1px solid #ddd;
		  border-radius: 4px;
		  padding: 5px;
		  width: 150px;
		}
</style>

<form action='functions.php' method='post' enctype='multipart/form-data'>
	<input type="hidden" name="id" value=<?= $_REQUEST['id'] ?>>
	<input type="hidden" name="gambarLama" value=<?= $result[0]['image'] ?>>
	<label>Nama</label>
	<input type="text" name="nama" value=<?= $result[0]['name'] ?>><br>
	<label>Gambar</label>
	<input type="file" name="gambar"><br>
	<img <?php  echo 'src="img/'.$result[0]['image'].'"'; ?> ><br>
	<input type="submit" name="update" value='Update'>
</form>
<a href="view.php"><button>Lihat Gambar</button></a>