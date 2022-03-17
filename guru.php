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
    $query = "SELECT * FROM guru JOIN kelas on guru.wali_kelas = kelas.id_kelas WHERE kd_guru LIKE('%$kata%') || nip LIKE('%$kata%') || nm_guru LIKE('%$kata%') || kelas LIKE('%$kata%')";
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
                                <a href="list_bayar.php">List Bayar</a>
                                <a href="pguru.php">Penggajian Guru</a>
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
                        <a class="active-menu" href="guru.php">Guru</a>
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


                <!-- The Modal -->
                <form action="function.php?add_guru" method="POST">
                    <div id="myModal" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <div>
                                <label for="kd_guru">Kode Guru : </label>
                                <input type="text" name="kd_guru" class="form-control" id="kd_guru">
                            </div>
                            <div>
                                <label for="nip">NIP : </label>
                                <input type="text" name="nip" class="form-control" id="nip">
                            </div>
                            <div>
                                <label for="nm_guru">Masukkan Nama Guru : </label>
                                <input type="text" name="nm_guru" class="form-control" id="nm_guru">
                            </div>

                            <div>
                                <label for="Tipe Guru">Tipe Guru : </label>
                                <select name="tipe" id="tipe">
                                    <option value="" selected disabled>Tipe Guru</option>
                                    <?php
                                    $tipe = $mhs->getTipe();
                                    foreach ($tipe as $item) : ?>
                                        <option value="<?= $item['id_tipe'] ?>"><?= $item['tipe_guru'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div id="gaji-guru">
                                <label for="nominal">Masukkan Nominal Gaji : </label>
                                <input type="number" name="nominal" class="form-control" id="nominal">
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

                            <button type="submit" class="btn btn-success" name="confirm">Tambah</button>
                </form>
            </div>

        </div>
        <form action="" method="POST">
            <input type="text" name="kata" style="width:100px;" autofocus>
            <button type="submit" class="btn btn-primary" name="cari"><i class="glyphicon glyphicon-search"></i>Cari</button>
        </form>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Guru</th>
                    <th>Nama Guru</th>
                    <th>Wali Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php $guru = $mhs->getGuru();
            $no = 1;
            if (isset($_POST['cari'])) {
                $guru = searchGuru();
            } ?>
            <?php foreach ($guru as $row) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['kd_guru'] ?></td>
                    <td><?= $row['nm_guru'] ?></td>
                    <td><?= $row['kelas'] ?></td>
                    <td><a href="editGuru.php?kd_guru=<?= $row['kd_guru'] ?>"><button class="btn btn-xs btn-success">Edit</button></a>
                        <a href="function.php?delete_guru=<?= $row['kd_guru'] ?>"><button class="btn btn-xs btn-danger" onclick="return confirm('apakah data tersebut akan dihapus?');">Delete</button></a>
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