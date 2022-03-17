<?php
include_once "function.php";

if ($_SESSION['role'] != 1) {
    echo "<script>alert('Akses ditolak');</script>";
    echo "<script>location='login.php'</script>";
}


function searchGuru()
{
    $conn = mysqli_connect("localhost", "root", "", "sekolahan3");
    $kata = $_POST['kata'];
    $query = "SELECT * FROM siswa JOIN list_bayar on siswa.nis = list_bayar.nis JOIN kelas on siswa.id_kelas = kelas.id_kelas WHERE nis LIKE('%$kata%') || nm_siswa LIKE('%$kata%') || kelas LIKE('%$kata%')";
    $result = mysqli_query($conn, $query);
    $tampung = [];


    while ($data = mysqli_fetch_assoc($result)) {
        $tampung[] = $data;
    }

    return $tampung;
}


function getKelas()
{
    $conn = mysqli_connect("localhost", "root", "", "sekolahan3");
    $query = "SELECT * FROM kelas";
    $result = mysqli_query($conn, $query);
    return $result;
}




?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets1/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets1/css/font-awesome.css" rel="stylesheet" />
    <!--CUSTOM BASIC STYLES-->
    <link href="assets1/css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="assets1/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="css/siswa.css">




</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard_admin.php">Admin</a>
            </div>
            <div class="header-right">
                <a href="function.php?logout" class="btn btn-danger" title="Logout" name="logout"><i class="fa fa-exclamation-circle fa-2x"></i></a>
            </div>
        </nav>

        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="dashboard_admin.php"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-dollar "></i>Transaksi<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="detail_pembayaran.php">Detail Pembayaran</a>
                                <a href="list_bayar.php" class="active-menu">List Bayar</a>
                                <a href="pguru.php">Penggajian Guru</a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href=" siswa.php">Siswa</a>
                    </li>
                    <li>
                        <a href="kelas.php">Kelas</a>
                    </li>
                    <li>
                        <a href="jurusan.php">Jurusan</a>
                    </li>
                    <li>
                        <a href="mata_pelajaran.php">Mata Pelajaran</a>
                    </li>
                    <li>
                        <a href="guru.php">Guru</a>
                    </li>

                    <li>
                        <a href="user.php">User</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <!-- Trigger/Open The Modal -->

                <!-- The Modal -->
                <!-- <form action="" method="POST"> -->
                <!-- <input type="text" name="kata" style="width:100px;" autofocus> -->
                <!-- <button type="submit" class="btn btn-primary" name="cari"><i class="glyphicon glyphicon-search"></i>Cari</button> -->
                <!-- </form> -->

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Status Bayar</th>
                            <th>Bukti Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php $list_bayar = $mhs->getBayar();




                    $no = 1;
                    if (isset($_POST['cari'])) {
                        $guru = searchGuru();
                    } ?>

                    <?php foreach ($list_bayar as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nis'] ?></td>
                            <td><?= $row['nm_siswa'] ?></td>
                            <td><?= $row['kelas'] ?></td>
                            <td><?= $row['status_bayar'] == 1 ? "Belum Bayar" : ($row['status_bayar'] == 2 ? "Sudah Upload" : ($row['status_bayar'] == 3 ? "Sudah Bayar" : "")) ?></td>
                            <td><?= $row['status_bayar'] == 2 || $row['status_bayar'] == 3 ? '<button class="btn btn-primary btn-sm" id="myBtn"><i class="fa fa-picture-o" aria-hidden="true"></i></button>' : '-' ?></td>
                            <td><?= $row['status_bayar'] == 2 ? '<a href="function.php?acc=' . $row['nis'] . '" class="btn btn-success btn-sm" id="myBtn"><i class="fa fa-check" aria-hidden="true"></i></a>' : '-' ?></td>
                            <td>
                                <div id="myModal" class="modal">

                                    <!-- Modal content -->
                                    <div class="modal-content" style="width:15%">
                                        <span class="close">&times;</span>
                                        <div class="gambar">
                                            <p>Bukti Bayar Anda</p>
                                            <img width="100" src="bukti/<?= $row['bukti_bayar'] ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>







            </div>
        </div>

    </div>








    <script src="assets2/js/jquery-1.10.2.js"></script>
    <script src="assets1/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets1/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets1/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets1/js/custom.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/siswa.js"></script>


</body>

</html>