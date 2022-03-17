<?php
include_once "function.php";

if ($_SESSION['role'] != 1) {
    echo "<script>alert('Akses ditolak');</script>";
    echo "<script>location='login.php'</script>";
}


function searchData()
{
    $conn = mysqli_connect("localhost", "root", "", "sekolahan3");
    $kata = $_POST['kata'];
    $query = "SELECT * FROM siswa JOIN kelas USING(id_kelas) JOIN guru ON siswa.guru_wali=guru.kd_guru WHERE nm_siswa LIKE('%$kata%') || nis LIKE('%$kata%')";
    $result = mysqli_query($conn, $query);
    $tampung = [];
    while ($data = mysqli_fetch_assoc($result)) {
        $tampung[] = $data;
    }
    return $tampung;
}



function getSiswa()
{
    $conn = mysqli_connect("localhost", "root", "", "sekolahan3");
    $query = "SELECT * FROM siswa JOIN kelas USING(id_kelas) JOIN guru ON siswa.guru_wali=guru.kd_guru";
    $result = mysqli_query($conn, $query);
    $tampung = [];
    while ($data = mysqli_fetch_assoc($result)) {
        $tampung[] = $data;
    }

    return $tampung;
};


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
                        <a href="#"><i class="fa fa-desktop "></i>Transaksi<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="pembayaran.php" class="active-menu">Pembayaran</a>
                                <a href="detail_pembayaran.php">Detail Pembayaran</a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="siswa.php">Siswa</a>
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
                <form action="" method="POST">
                    <input type="text" name="kata" style="width:100px;" autofocus>
                    <button class="btn btn-primary" name="cari" type="submit"><i class="glyphicon glyphicon-search"></i>Cari</button>
                </form>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Biaya</th>
                            <th>Sisa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php $siswa = getSiswa();
                    $no = 1;
                    if (isset($_POST['cari'])) {
                        $siswa = searchData();
                    } ?>
                    <?php foreach ($siswa as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nm_siswa'] ?></td>
                            <td><?= $row['nis'] ?></td>
                            <td><?= $row['biaya'] ?></td>
                            <td><?= $row['sisa'] ?></td>
                            <!-- Trigger/Open The Modal -->
                            <td>
                                <a href="ubayar.php?nis=<?= $row['nis']; ?>" class="btn btn-success">Pembayaran</a>
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