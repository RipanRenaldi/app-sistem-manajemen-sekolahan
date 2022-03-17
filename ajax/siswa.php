<?php
require "../function.php";

$kata = $_GET['keyword'];

function search($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);;

    $tampung = [];
    while ($data = mysqli_fetch_assoc($result)) {
        $tampung[] = $data;
    }

    return $tampung;
}

function searchData()
{
    $conn = mysqli_connect("localhost", "root", "", "sekolahan3");
    global $kata;
    $query = "SELECT * FROM siswa JOIN kelas USING(id_kelas) JOIN guru ON siswa.guru_wali=guru.kd_guru JOIN jurusan on siswa.jurusan = jurusan.id_jurusan WHERE nm_siswa LIKE('%$kata%') || nis LIKE('%$kata%') || kelas LIKE('%$kata%') || nm_guru LIKE('%$kata%') || nm_jurusan LIKE('$kata')";
    $result = mysqli_query($conn, $query);
    $tampung = [];
    while ($data = mysqli_fetch_assoc($result)) {
        $tampung[] = $data;
    }
    return $tampung;
}


?>



<table class="table table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Kelas</th>
            <th>Wali Kelas</th>
            <th>Jurusan</th>



        </tr>
    </thead>
    <?php

    $siswa = searchData();
    $no = 1;
    ?>


    <?php foreach ($siswa as $row) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nm_siswa'] ?></td>
            <td><?= $row['nis'] ?></td>
            <td><?= $row['kelas'] ?></td>
            <td><?= $row['nm_guru'] ?></td>
            <td><?= $row['jurusan'] == 1 ? 'Matematika & Ilmu Alam' : ($row['jurusan'] == 2 ? 'Ilmu Ilmu Sosial ' : ($row['jurusan'] == 3 ? 'Ilmu Ilmu Sosial' : ($row['jurusan'] == 4 ? 'Keagamaan' : ''))) ?></td>
            <td>
                <a href="update.php?nis=<?= $row['nis']; ?>"><button class="btn btn-xs btn-success" style="display:inline-block">Edit</button></a>
                <a href="function.php?delete=<?= $row['nis'] ?>"><button class="btn btn-xs btn-danger" onclick="return confirm('apakah data tersebut akan dihapus?');">Delete</button></a>

            </td>
        </tr>
    <?php endforeach; ?>
</table>