<!DOCTYPE html>
<html>
<head>
	<title>Dokumen</title>
	<style type="text/css">
		img {
		  border: 1px solid #ddd;
		  border-radius: 4px;
		  padding: 5px;
		  width: 150px;
		}
	</style>
</head>
<body>
<?php 
include('config.php');
$d = new DB();

$sql = 'SELECT * FROM `image`';
$result = $d->getList($sql);
 ?>

 <table>
 	<thead>
 		<tr>
 			<th>Nama</th>
 			<th>Gambar</th>
 			<th>Aksi</th>
 		</tr>
 	</thead>
 	<tbody>
 		<?php 
 			for($i = 0; $i < count($result); $i++){
 				echo '<tr><td>'.$result[$i]['name'].'</td><td><img src="img/'.$result[$i]['image'].'"></td><td><a href="update.php?id='.$result[$i]['id'].'">Ubah</a> | <a href="view.php?action=delete&id='.$result[$i]['id'].'&image='.$result[$i]['image'].'">Hapus</a></td></tr>';
 			}
 		 ?>

 	</tbody>
 </table>
<a href="index.php"><button>Tambah Gambar</button></a>
</body>
</html>

<?php 
	$action = (!isset($_REQUEST["action"])) ? null : $_REQUEST["action"];
 	if ($action == 'delete') {
		$gambar = $_REQUEST['image'];
		unlink("img/".$gambar);
		$sql = "DELETE FROM `image` WHERE `image`.`id` =". $_REQUEST['id'];
		$d->query($sql);
        header("location: view.php");
	}

 ?>