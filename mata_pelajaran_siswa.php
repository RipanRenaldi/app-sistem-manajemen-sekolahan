<?php
include_once "function.php";

$hours = date_default_timezone_set("Asia/Jakarta");
$date = date('Y-m-d H:i:s');
$id = $_SESSION['id_user'];


if ($_SESSION['role'] != 3) {
    echo "<script>alert('Akses ditolak');</script>";
    echo "<script>location='login.php'</script>";
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


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="assets1/js/jquery-1.10.2.js"></script>


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
                <a class="navbar-brand" href="#.php">Siswa</a>
            </div>
            <div class="header-right">
                <a href="function.php?logout2&&ll=<?= $date ?>" class="btn btn-danger" title="Logout" name="logout"><i class="fa fa-exclamation-circle fa-2x"></i></a>
            </div>
        </nav>

        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <?php $thisuser = $mhs->getSuser($id); ?>


                            <?php foreach ($thisuser as $item) : ?>
                                <img src="img/<?= $item['gambar'] ?>" class="img-thumbnail" />
                            <?php endforeach; ?>

                            <div class="inner-text">
                                <h4><?= $item['nm_siswa']; ?></h5>

                                    <h5>Wali Kelas : <?= $item['nm_guru'] ?></h5>
                                    <br />
                                    <?php
                                    $user = $mhs->getUser2($id);
                                    foreach ($user as $row) : ?>
                                        <small>Last Login : <?= $row['last_login']; ?></small>
                                    <?php endforeach; ?>
                            </div>
                        </div>

                    </li>
                    <li><a href="haluser.php" class="">Daftar Guru</a></li>
                    <li><a href="mata_pelajaran_siswa.php" class="active-menu">Mata Pelajaran</a></li>
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Mata Pelajaran</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Jam</th>
                        </tr>
                    </thead>
                    <?php $matpel = $mhs->getMatpel();
                    $no = 1;
                    if (isset($_POST['cari'])) {
                        $matpel = searchMatpel();
                    } ?>
                    <?php foreach ($matpel as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['kd_matpel'] ?></td>
                            <td><?= $row['nm_matpel'] ?></td>
                            <td><?= $row['jam'] ?></td>
                            <td>
                                <a href="function.php?delete_matpel=<?= $row['id_matpel'] ?>"><button class="btn btn-xs btn-danger" onclick="return confirm('apakah data tersebut akan dihapus?');">Delete</button></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

        </div>










    </div>
    </div>

    </div>










    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/piexif.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/sortable.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/fileinput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/locales/LANG.js"></script>




    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets1/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets1/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets1/js/custom.js"></script>
    <script src="js/siswa.js"></script>
    <script>
        $("#bukti").fileinput({
            'showUpload': false,
            'previewFileType': 'any'
        });
    </script>


</body>

</html>