<?php

include_once "function.php";

if($_SESSION['role'] != 1){
    echo "<script>alert('Akses ditolak');</script>";
    echo "<script>location='login.php'</script>";
}


$nis = $_GET['nis'];
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




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body >
  	<center><h1>Form Pembayaran</h1></center>
  	<div class="container shadow p-3 mb-5 bg-body rounded" >
  		<?php $siswa = $mhs->getSiswa2($nis); 
  		foreach ($siswa as $row):
  		endforeach; ?>
    <form action="function.php?proses_bayar" method="POST">
  	<div class="form">
        <label for="nama">Nama :</label>
        <input type="text" class = "form-control" name="nama" value="<?= $row['nm_siswa']; ?>" disabled selected>
    </div>
    <div class="form">
        <label for="biaya">Biaya :</label>
        <input type="text" class = "form-control" name="biaya" value="<?= $row['biaya']; ?>" disabled selected>
    </div>
    <div class="form">
        <label for="sisa">Sisa :</label>
        <input type="text" class = "form-control" name="sisa" value="<?= $row['sisa']; ?>" disabled selected>
    </div>
    <div class="form">
        <label for="dibayar">Dibayar :</label>
        <input type="text" class = "form-control" name="dibayar" value="<?= $row['dibayar']; ?>" disabled selected>
    </div>
    <div class="form" hidden>
        <label for="nis">Nis :</label>
        <input type="text" class = "form-control" name="nis" value="<?= $row['nis']; ?>">
    </div>
    <div class="form" >
        <label for="terbayar">Jumlah Bayar :</label>
        <input type="text" class ="form-control" name="terbayar" >
    </div>
  <button type="submit" class="btn btn-primary" name="confirm">Submit</button>

</form>
</div>

   

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

   
  </body>
</html>

<script type="text/javascript" src = "asset/js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>
</html>