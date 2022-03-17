<?php
include_once "function.php";

if (!isset($_SESSION['login'])) {
	echo "<script>alert('anda belum login, silahkan login terlebih dahulu');</script>";
	echo "<script>location='login.php'</script>";
}



$nis = $_GET['nis'];

$conn = mysqli_connect("localhost", "root", "", "sekolahan3");
$query = "SELECT * FROM siswa JOIN kelas USING(id_kelas) JOIN guru ON siswa.guru_wali=guru.kd_guru WHERE nis='$nis'";

$result = mysqli_query($conn, $query);
$tampung = [];

while ($row = mysqli_fetch_assoc($result)) {
	$tampung[] = $row;
}


foreach ($tampung as $siswa) {
	$nm_siswa = $siswa['nm_siswa'];
	$nis = $siswa['nis'];
	$email = $siswa['email'];
	$kelas = $siswa['kelas'];
	$id_kelas = $siswa['id_kelas'];
	$kd_guru = $siswa['kd_guru'];
}



?>

<?php

function ubahData()
{
	global $conn;
	global $nis;
	global $kd_guru;

	$nm_siswa = $_POST['nm_siswa'];
	$nis = $_POST['nis'];
	$email = $_POST['email'];
	$kelas = $_POST['kelas'];
	$id_kelas = $_POST['kelas'];
	$kd_guru = $_POST['wali'];

	$query = "UPDATE siswa SET nm_siswa= '$nm_siswa', nis='$nis', email='$email', id_kelas='$id_kelas', guru_wali='$kd_guru' WHERE nis = '$nis'";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function getKelas()
{
	global $conn;
	$query = "SELECT * FROM kelas";
	return mysqli_query($conn, $query);
}


if (isset($_POST['confirm'])) {
	$test = ubahData();
	if ($test > 0) {
		header("location: siswa.php");
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.css">
	<style type="text/css">
		div {
			margin-bottom: 15px;
		}
	</style>
</head>

<body>


	<form action="" method="POST">
		<h1 class="text-center">Update Data Siswa</h1>

		<div class="container">
			<div class="shadow p-3 mb-5 bg-body rounded">
				<div>
					<label for="nm_siswa">Masukan nm_siswa Siswa : </label>
					<input type="text" name="nm_siswa" id="nm_siswa" class="form-control" value=<?= $nm_siswa ?>>
				</div>
				<div hidden>
					<label for="nis">Masukan NIS : </label>
					<input type="text" name="nis" id="nis" class="form-control" value=<?= $nis ?>>
				</div>
				<div>
					<label for="email">Masukan Email : </label>
					<input type="text" name="email" id="email" class="form-control" value=<?= $email ?>>
				</div>
				<div>
					<label for="wali">Masukan Wali Kelas : </label>
					<select name="wali" id="wali" class="form-control">
						<option disabled selected>Pilih wali Kelas</option>
						<?php
						$wali = $mhs->getGuru();
						foreach ($wali as $row) : ?>
							<option value="<?= $row['kd_guru']; ?>"><?= $row['nm_guru']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div>
					<label for="kelas">Masukan kelas : </label>
					<select name="kelas" id="kelas" class="form-control">
						<option disabled selected>Pilih Kelas</option>
						<?php
						$kelas = getKelas();
						foreach ($kelas as $kls) : ?>
							<option value="<?= $kls['id_kelas']; ?>"><?= $kls['kelas']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div>
					<button type="submit" class="btn btn-success" name="confirm">Simpan</button>
				</div>
			</div>

		</div>



		<script type="text/javascript" src="asset/js/bootstrap.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>