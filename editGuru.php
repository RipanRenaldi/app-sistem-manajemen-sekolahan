<?php
include_once "function.php";

if (!isset($_SESSION['login'])) {
    echo "<script>alert('anda belum login, silahkan login terlebih dahulu');</script>";
    echo "<script>location='login.php'</script>";
}



$kd_guru = $_GET['kd_guru'];

$conn = mysqli_connect("localhost", "root", "", "sekolahan3");
$query = "SELECT * FROM guru JOIN kelas on guru.wali_kelas = kelas.id_kelas  WHERE kd_guru='$kd_guru'";

$result = mysqli_query($conn, $query);
$tampung = [];

while ($row = mysqli_fetch_assoc($result)) {
    $tampung[] = $row;
}


foreach ($tampung as $guru) {
}

?>

<?php

function ubahData()
{
    global $conn;
    global $id_kelas;
    global $kd_guru;

    $nm_guru = $_POST['nm_guru'];
    $wali = $_POST['wali'];


    $query2 = "UPDATE guru SET nm_guru='$nm_guru', wali_kelas = '$wali' WHERE kd_guru = '$kd_guru'";
    mysqli_query($conn, $query2);

    return mysqli_affected_rows($conn);
}

function getKelas()
{
    $conn = mysqli_connect("localhost", "root", "", "sekolahan3");
    $query = "SELECT * FROM kelas";
    $result = mysqli_query($conn, $query);
    return $result;
}



if (isset($_POST['confirm'])) {
    $test = ubahData();
    if ($test > 0) {
        header("location: guru.php");
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
        <h1 class="text-center">Update Data Guru</h1>

        <div class="container">


            <div class="shadow p-3 mb-5 bg-body rounded">

                <div>
                    <label for="nm_guru">Masukan Nama Guru : </label>
                    <input type="text" name="nm_guru" id="nm_guru" class="form-control" value=<?= $guru['nm_guru'] ?>>
                </div>
                <div>
                    <label for="wali">Masukkan Wali Dari Kelas : </label>
                    <?php $guru = getKelas(); ?>
                    <select name="wali" id="wali">
                        <option disabled selected>Pilih Kelas</option>
                        <?php foreach ($guru as $item) : ?>
                            <option value="<?= $item['id_kelas'] ?>"><?= $item['kelas'] ?></option>
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