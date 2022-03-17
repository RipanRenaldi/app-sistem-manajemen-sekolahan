<?php
include_once "function.php";

if ($_SESSION['role'] != 1) {
    echo "<script>alert('Akses ditolak');</script>";
    echo "<script>location='login.php'</script>";
}



function searchKelas()
{
    $conn = mysqli_connect("localhost", "root", "", "sekolahan3");
    $kata = $_POST['kata'];
    $query = "SELECT * FROM kelas JOIN guru on kelas.id_kelas = guru.wali_kelas WHERE nm_guru LIKE('%$kata%') || kelas LIKE('%$kata%')";
    $result = mysqli_query($conn, $query);
    $tampung = [];


    while ($data = mysqli_fetch_assoc($result)) {
        $tampung[] = $data;
    }

    return $tampung;
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
                        <a class="active-menu" href="kelas.php">Kelas</a>
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
                <button id="myBtn" class="btn btn-success" style="
                position:relative;
                left:900px;
                display:block">Tambah Data</button>

                <!-- The Modal -->
                <form action="function.php?tambah_kelas" method="POST">
                    <div id="myModal" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <div>
                                <label for="kelas">Masukkan Kelas : </label>
                                <input type="text" name="kelas" class="form-control" id="kelas">
                            </div>
                            <button type="submit" class="btn btn-success" name="confirm" style="margin-top:15px">Tambah</button>
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

                    <th>Nama Kelas</th>
                    <th>Wali Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php $kelas = $mhs->getKelas();
            $no = 1;
            if (isset($_POST['cari'])) {
                $kelas = searchKelas();
            } ?>
            <?php foreach ($kelas as $kls) : ?>
                <tr>
                    <td><?= $no++; ?></td>

                    <td><?= $kls['kelas'] ?></td>
                    <td><?= $kls['nm_guru'] ?></td>
                    <td>
                        <!-- <li><a href="#"><button class="btn btn-xs btn-success" style="display:inline-block">Edit</button></a></li> -->
                        <a href="function.php?delete_kelas=<?= $kls['id_kelas'] ?>&kd=<?= $kls['kd_guru'] ?>"><button class="btn btn-xs btn-danger" onclick="return confirm('apakah data tersebut akan dihapus?');">Delete</button></a>

                    </td>


                </tr>
            <?php endforeach; ?>
        </table>


        <!-- The Modal -->
        <form action="function.php" method="POST">
            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div>
                        <label for="nama">Masukkan Nama : </label>
                        <input type="text" name="nama" class="form-control" id="nama">
                    </div>
                    <div>
                        <label for="nis">Masukkan NIS : </label>
                        <input type="text" name="nis" class="form-control" id="nis">
                    </div>
                    <div>
                        <label for="email">Masukkan email : </label>
                        <input type="text" name="email" class="form-control" id="email">
                    </div>
                    <div>
                        <label for="kelas">Masukkan Kelas : </label>
                        <?php $kelas = $mhs->getOnlyKelas(); ?>
                        <select name="id_kelas" id="kelas">
                            <option disabled selected>Pilih Kelas</option>
                            <?php foreach ($kelas as $row) : ?>
                                <option value="<?= $row['id_kelas'] ?>"><?= $row['kelas'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="jurusan">Masukkan Jurusan : </label>
                        <?php $jurusan = $mhs->getJurusan(); ?>
                        <select name="id_jurusan" id="jurusan">
                            <option disabled selected>Pilih jurusan</option>
                            <?php foreach ($jurusan as $jrs) : ?>
                                <option value="<?= $jrs['id_jurusan'] ?>"><?= $jrs['nm_jurusan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="wali">Masukkan Wali Kelas : </label>
                        <?php $guru = $mhs->getGuru(); ?>
                        <select name="wali" id="wali">
                            <option disabled selected>Pilih Wali Kelas</option>
                            <?php foreach ($guru as $item) : ?>
                                <option value="<?= $item['kd_guru'] ?>"><?= $item['nm_guru'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success" name="submit">Tambah</button>
        </form>









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
    <script src="js/siswa.js"></script>

</body>

</html>