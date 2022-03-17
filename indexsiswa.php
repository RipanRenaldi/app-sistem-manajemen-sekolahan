<?php
include_once "function.php";

$hours = date_default_timezone_set("Asia/Jakarta");
$date = date('Y-m-d H:i:s');
$id = $_SESSION['id_user'];


$status = $mhs->getBsiswa($id);

if ($_SESSION['role'] != 3) {
    echo "<script>alert('Akses ditolak');</script>";
    echo "<script>location='login.php'</script>";
}


foreach ($status as $sts) {
}

if (isset($sts['bukti_bayar'])) {
    if ($sts['status_bayar'] == "1" || $sts['status_bayar'] == "2") {
        echo "<script>alert('Anda belum upload/bukti bayar belum dikonfirmasi '); </script>";
        // echo "<script>location='indexsiswa.php'</script>";
    } else {
        echo "<script>alert('bukti bayar telah dikonfirmasi'); </script>";
        echo "<script>location='haluser.php'</script>";
    }
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

    <link href="assets1/css/wizard/normalize.css" rel="stylesheet" />
    <link href="assets1/css/wizard/wizardMain.css" rel="stylesheet" />
    <link href="assets1/css/wizard/jquery.steps.css" rel="stylesheet" />


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
                            <?php $thisuser = $mhs->getSuser($id);
                            $data = mysqli_fetch_assoc($thisuser);
                            ?>


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

                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <?php $nis = $item['nis']; ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Panduan Pembayaran : </h3>
                            </div>
                            <div class="panel-body">


                                <div id="wizardV">
                                    <h2>Langkah Ke-1</h2>
                                    <section>
                                        <p>Pergi ke bank terkait.</p>
                                    </section>

                                    <h2>Langkah Ke-2</h2>
                                    <section>
                                        <p>Masukkan kartu atm pada mesin atm</p>
                                    </section>

                                    <h2>Langkah Ke-3</h2>
                                    <section>
                                        <p>Masuk ke menu pembayaran dan masukkan nomor pembayaran(<?= "$nis" ?>) beserta nominal sesuai dengan nominal yang tertera</p>
                                    </section>

                                    <h2>Langkah ke-4</h2>
                                    <section id="terakhir">
                                        <p>Ketika sudah mendapatkan bukti bayar, upload bukti bayar pada halaman ini</p>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- The Modal -->
                <form action="function.php?upload" method="POST" enctype="multipart/form-data">
                    <div id="myModal" class="modal">

                        <input type="hidden" name="nis" value="<?= $data['nis']; ?>">

                        <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <div>
                                <label for="kelas" style="font-style:italic;">Notes : Pastikan pembayaran sebesar Rp.175.000</label>
                            </div>
                            <div>
                                <label for="bukti">Masukkan bukti pembayaran: </label>
                                <input type="file" name="bukti" class="form-control" id="bukti">
                            </div>
                            <button type="submit" class="btn btn-success" name="upload" style="margin-top:15px">upload</button>
                </form>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Yang akan didapatkan :
                    </div>
                    <div class="panel-body">
                        <ul style="margin-bottom:50px">
                            <li>Paket LKS</li>
                            <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. </li>
                            <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit asds. </li>
                        </ul>

                        <center><button id="myBtn" class="btn btn-success">Upload</button></center>




                    </div>
                </div>
            </div>
        </div>







    </div>
    </div>

    </div>






    <script src="assets1/js/wizard/modernizr-2.6.2.min.js"></script>
    <script src="assets1/js/wizard/jquery.cookie-1.3.1.js"></script>
    <script src="assets1/js/wizard/jquery.steps.js"></script>

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