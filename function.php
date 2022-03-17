<?php
// 
// id, nama, nim , email, jurusan , kelas, aksi

class Mahasiswa
{
	var $conn;

	function __construct()
	{
		session_start();

		$server = "localhost";
		$nama = "root";
		$pw = "";
		$db = "sekolahan3";
		$this->conn = mysqli_connect($server, $nama, $pw, $db);
	}

	public function getSiswa()
	{
		$query = "SELECT * FROM siswa JOIN kelas USING(id_kelas) JOIN guru ON siswa.guru_wali=guru.kd_guru JOIN jurusan on siswa.jurusan = jurusan.id_jurusan";
		return $this->conn->query($query);
	}
	public function getSiswa2($nis = "null")
	{
		$query = "SELECT * FROM siswa JOIN kelas USING(id_kelas) JOIN guru ON siswa.guru_wali=guru.kd_guru WHERE nis='$nis'";
		return $this->conn->query($query);
	}

	public function getKelas()
	{
		$query = "SELECT * FROM kelas JOIN guru on kelas.id_kelas = guru.wali_kelas";
		return $this->conn->query($query);
	}
	public function getKelas2($id_kelas = null)
	{
		$query = "SELECT * FROM kelas JOIN guru on kelas.id_kelas = guru.wali_kelas WHERE id_kelas = '$id_kelas'";
		return $this->conn->query($query);
	}
	public function getOnlyKelas()
	{
		$query = "SELECT * FROM kelas JOIN guru on kelas.id_kelas = guru.wali_kelas";
		return $this->conn->query($query);
	}

	public function getPembayaran()
	{
		$query = "SELECT * FROM bayar";
		return $this->conn->query($query);
	}

	public function getJurusan()
	{
		$query = "SELECT * FROM jurusan";
		return $this->conn->query($query);
	}
	public function getMatpel()
	{
		$query = "SELECT * FROM matapelajaran";
		return $this->conn->query($query);
	}
	public function getGuru()
	{
		$query = "SELECT * FROM guru JOIN kelas on guru.wali_kelas = kelas.id_kelas";
		return $this->conn->query($query);
	}

	public function getBayar()
	{
		$query = "SELECT * FROM siswa JOIN list_bayar on siswa.nis = list_bayar.nis JOIN kelas on list_bayar.id_kelas = kelas.id_kelas JOIN guru ON siswa.guru_wali=guru.kd_guru JOIN jurusan on siswa.jurusan = jurusan.id_jurusan";
		return $this->conn->query($query);
	}
	public function getBayar2($nis = null)
	{
		$query = "SELECT * FROM siswa JOIN list_bayar on siswa.nis = list_bayar.nis JOIN kelas on list_bayar.id_kelas = kelas.id_kelas JOIN guru ON siswa.guru_wali=guru.kd_guru JOIN jurusan on siswa.jurusan = jurusan.id_jurusan WHERE nis = '$nis'";
		return $this->conn->query($query);
	}

	public function getUser()
	{
		$query = "SELECT * FROM user JOIN roleuser on user.id_role = roleuser.id";
		return $this->conn->query($query);
	}
	public function getRoleuser()
	{
		$query = "SELECT * FROM roleuser";
		return $this->conn->query($query);
	}

	public function getUser2($id = null)
	{
		$query = "SELECT * FROM user WHERE id='$id'";
		return $this->conn->query($query);
	}

	public function getSuser($id = null)
	{
		$query = "SELECT * FROM siswa JOIN user on siswa.id_user = user.id JOIN kelas USING(id_kelas) JOIN guru ON siswa.guru_wali=guru.kd_guru WHERE user.id='$id'";
		return $this->conn->query($query);
	}
	public function getSuser2($id)
	{
		$query = "SELECT * FROM siswa JOIN user on siswa.id_user = user.id WHERE user.id='$id'";
		return $this->conn->query($query);
	}
	public function getGuser($id = null)
	{
		$query = "SELECT * FROM guru join user on guru.id_user=user.id join kelas on guru.wali_kelas = kelas.id_kelas WHERE id='$id'";
		return $this->conn->query($query);
	}

	public function getkGuru($kd_guru = null)
	{
		$query = "SELECT * FROM siswa JOIN guru on siswa.guru_wali = guru.kd_guru WHERE siswa.guru_wali = '$kd_guru'";
		return $this->conn->query($query);
	}

	public function getGuru2($kd)
	{
		$query = "SELECT * FROM guru JOIN siswa on guru.kd_guru = siswa.guru_wali JOIN";
		$this->conn->query($query);
	}

	public function getGuru3($kd_guru = null)
	{
		$query = "SELECT * FROM guru WHERE kd_guru = '$kd_guru'";
		$this->conn->query($query);
	}


	public function getDetailpembayaran()
	{
		$query = "SELECT * FROM detail_pembayaran";
		return $this->conn->query($query);
	}

	public function getTipe()
	{
		$query = "SELECT * FROM tipe_guru";
		return $this->conn->query($query);
	}




	public function setSiswa()
	{

		$user_id = "SELECT id FROM user";
		$result = $this->conn->query($user_id);
		$tampung = [];
		while ($data = mysqli_fetch_assoc($result)) {
			$tampung[] = $data;
		}
		$id_user_baru = $tampung[count($tampung) - 1];
		foreach ($id_user_baru as $id_user) {
			$id_user_baru = $id_user;
		}
		// echo $id_user_baru;
		// die;

		$nis = $_POST['nis'];
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$id_kelas = $_POST['id_kelas'];
		$wali_kelas = $_POST['wali'];
		$id_jurusan = $_POST['id_jurusan'];

		$query = "INSERT INTO `siswa`(`nis`, `nm_siswa`, `email`, `id_kelas`, `guru_wali`,`jurusan`,`id_user`,`gambar`) VALUES ('$nis','$nama','$email','$id_kelas','$wali_kelas','$id_jurusan','$id_user_baru','nophoto.jpg')";
		$query2 = "INSERT INTO `list_bayar`(`nis`, `id_kelas`, `status_bayar`) VALUES ('$nis','$id_kelas',1)";

		$result = $this->conn->query($query);
		$result2 = $this->conn->query($query2);
		header("location: siswa.php");
	}

	public function addKelas()
	{

		$kelas = $_POST['kelas'];

		$query = "INSERT INTO kelas VALUES('','$kelas')";
		$result = $this->conn->query($query);
		header("location:kelas.php");
	}

	public function addGuru()
	{

		$user_id = "SELECT id FROM user";
		$result = $this->conn->query($user_id);
		$tampung = [];
		while ($data = mysqli_fetch_assoc($result)) {
			$tampung[] = $data;
		}
		$id_user_baru = $tampung[count($tampung) - 1];
		foreach ($id_user_baru as $id_user) {
			$id_user_baru = $id_user;
		}
		// echo "$id_user_baru";
		// die;
		$kd_guru = $_POST['kd_guru'];
		$nip = $_POST['nip'];
		$nm_guru = $_POST['nm_guru'];
		$wali = $_POST['wali'];
		$tipe = $_POST['tipe'];
		$nominal = $_POST['nominal'];
		$query = "INSERT INTO `guru`(`kd_guru`, `nip`, `nm_guru`, `wali_kelas`,`tipe`,`gaji`,`id_user`) VALUES ('$kd_guru','$nip','$nm_guru','$wali','$tipe','$nominal','$id_user_baru')";

		$result = $this->conn->query($query);


		header("location: guru.php");
	}

	public function addJurusan()
	{
		$kd_jurusan = $_POST['kd_jurusan'];
		$nm_jurusan = $_POST['nama_jurusan'];

		$query = "INSERT INTO jurusan VALUES('','$kd_jurusan','$nm_jurusan')";
		$this->conn->query($query);
		header("location: jurusan.php");
	}

	public function addMatapelajaran()
	{
		$nm_matpel = $_POST['nm_matpel'];
		$kd_matpel = $_POST['kd_matpel'];
		$jam = $_POST['jam'];

		$query = "INSERT INTO matapelajaran VALUES('','$kd_matpel','$nm_matpel','$jam')";
		$this->conn->query($query);
		header("location: mata_pelajaran.php");
	}


	public function deleteSiswa()
	{
		$nis = $_GET['delete'];

		$query = "DELETE FROM siswa where nis = '$nis'";
		$result = $this->conn->query($query);
		header("location: siswa.php");
	}

	public function deleteKelas()
	{
		$id = $_GET['delete_kelas'];
		$kd_guru = $_GET['kd'];
		$query = "DELETE FROM `kelas` WHERE id_kelas='$id'";
		$query2 = "DELETE FROM `guru` WHERE kd_guru='$kd_guru'";
		$this->conn->query($query);
		$this->conn->query($query2);


		header("location: kelas.php");
	}

	public function deleteGuru()
	{
		$kd_guru = $_GET['delete_guru'];
		$query = "DELETE FROM guru WHERE kd_guru='$kd_guru'";
		$this->conn->query($query);
		header("location: guru.php");
	}

	// public function deleteGuru()
	// {
	// 	$kd_guru = $_GET['delete_guru'];
	// 	$query = "DELETE FROM guru WHERE kd_guru = '$kd_guru'";
	// 	$this->conn->query($query);
	// 	header("location: guru.php");
	// }

	public function deleteJurusan()
	{
		$id = $_GET['delete_jurusan'];

		$query = "DELETE FROM jurusan WHERE id_jurusan='$id'";
		$this->conn->query($query);
		header("location: jurusan.php");
	}

	public function deleteMatapelajaran()
	{
		$id = $_GET['delete_matpel'];

		$query = "DELETE FROM matapelajaran WHERE id_matpel='$id'";
		$this->conn->query($query);
		header("location: mata_pelajaran.php");
	}

	public function updateMahasiswa()
	{
		$nama = $_POST['nama'];
		$nim = $_POST['nim'];
		$email = $_POST['email'];
		$kelas = $_POST['kelas'];
		$jurusan = $_POST['jurusan'];

		$query = "UPDATE mahasiswa2 SET nama= '$nama' , nim='$nim' , email='$email' , kelas='kelas', jurusan='$jurusan' WHERE nama = '$nama";
	}


	public function proses_registrasi()
	{
		if ($_POST['password'] != $_POST['password2']) {
			echo "<script>alert('password yang anda masukkan tidak sesuai');</script>";
			echo "<script>location='registrasi2.php';</script>";
		}

		$username = $_POST['username'];
		$role = $_POST['role'];
		$password = $_POST['password'];
		$query = "SELECT * FROM user WHERE username='$username'";
		$result = $this->conn->query($query);

		if (mysqli_fetch_assoc($result) > 0) {
			echo "<script>alert('username yang anda masukkan sudah ada');</script>";
			echo "<script>location='registrasi2.php'</script>";
		} else {
			$password = password_hash($password, PASSWORD_DEFAULT);
			$query = "INSERT INTO `user`(`username`, `password`, `id_role`) VALUES ('$username','$password','$role')";

			$this->conn->query($query);
			echo "<script>alert('anda telah berhasil registrasi');</script>";
			echo "<script>location='login.php'</script>";
		}
	}


	public function proses_registrasiG()
	{
	}


	public function proses_login()
	{


		$username = $_POST['username'];
		$password = $_POST['password'];
		$query = "SELECT * FROM user WHERE username='$username'";
		$result = $this->conn->query($query);
		$user = mysqli_fetch_assoc($result);
		$id = $user['id'];

		if (password_verify($password, $user['password'])) {
			$_SESSION['login'] = true;
			$_SESSION['role'] = $user['id_role'];
			$_SESSION['id_user'] = $user['id'];

			if ($_SESSION['role'] == 1) {
				header("location: dashboard_admin.php");
			} else if ($_SESSION['role'] == 2) {
				header("location: halguru.php");
			} else if ($_SESSION['role'] == 3) {
				$sql = "SELECT * FROM siswa JOIN user on siswa.id_user = user.id WHERE user.id=$id";
				$result1 = $this->conn->query($sql);
				$data = mysqli_fetch_assoc($result1);
				if (in_array($data['status_bayar'], [1, 2])) {
					header("location: indexsiswa.php");
				} else if (in_array($data['status_bayar'], [3])) {
					header("location: haluser.php");
				} else {
					header("location:indexsiswa.php");
				}
			}
		} else {
			echo "<script> alert('username atau password salah');</script>";
			echo "<script>location='login.php'; </script>";
		}
	}





	public function proses_logout()
	{
		session_destroy();
		echo "<script>alert('anda berhasil log out');</script>";
		echo "<script>location='login.php';</script>";
	}

	public function proses_logout2()
	{
		$date = $_GET['ll'];
		$id = $_SESSION['id_user'];
		$query = "SELECT * FROM user WHERE id='$id'";
		$result = $this->conn->query($query);
		$user = mysqli_fetch_assoc($result);

		$query = "UPDATE user SET last_login='$date' WHERE id=$id";
		$this->conn->query($query);
		session_destroy();

		echo "<script>alert('anda berhasil log out');</script>";
		echo "<script>location='login.php';</script>";
	}



	public function deletePay()
	{
		$id = $_GET['idpay'];
		$sql = "DELETE FROM bayar where id = $id";
		$result = $this->conn->query($sql);
		header("location: bayar.php");
	}

	public function prosesBayar()
	{
		$nis = $_POST['nis'];
		$siswa = $this->getSiswa2($nis);
		foreach ($siswa as $row) {
			$biaya = $row['biaya'];
		}
		$terbayar = $_POST['terbayar'];
		$dibayar = $row['dibayar'] + $terbayar;
		$sisa = $biaya - $dibayar;




		$query = "UPDATE siswa SET dibayar=$dibayar+$terbayar,sisa='$sisa' WHERE nis = '$nis'";
		$this->conn->query($query);

		header("location: pembayaran.php");
	}

	public function upload()
	{
		date_default_timezone_set("Asia/Jakarta");



		$nis = $_POST['nis'];
		$siswa = $this->getSiswa2($nis);
		foreach ($siswa as $row) {
			$nis = $row['nis'];
		}
		$namaFile = $_FILES['bukti']['name'];
		$tmpName = $_FILES['bukti']['tmp_name'];


		// cek 
		$ekstensi = ['jpg', 'jpeg', 'png'];
		$ekstensigambar = explode(".", $namaFile);
		$ekstensigambar = strtolower(end($ekstensigambar));

		if (!in_array($ekstensigambar, $ekstensi)) {
			echo "<script>alert('yang anda upload bukan gambar');</script>";
			return false;
		}
		$namaFileBaru = $nis . 'a' . $nis;
		$namaFileBaru .= '.';
		$namaFileBaru .= $ekstensigambar;

		// lolos di cek
		move_uploaded_file($tmpName, "bukti/" . $namaFileBaru);


		$nis = $_POST['nis'];
		$query = "UPDATE list_bayar SET bukti_bayar='$namaFileBaru', status_bayar = 2 WHERE nis='$nis' ";
		$query2 = "INSERT INTO `detail_pembayaran`(`nis`) VALUES ('$nis')";

		$this->conn->query($query2);
		$this->conn->query($query);




		header("location: indexsiswa.php");
	}

	public function accPayment()
	{
		$nis = $_GET['acc'];
		$query = "UPDATE list_bayar SET status_bayar = 3 WHERE nis='$nis'";
		$this->conn->query($query);
		header("location: list_bayar.php");
	}

	public function getBsiswa($id = null)
	{
		$query = "SELECT * FROM siswa join list_bayar on siswa.nis = list_bayar.nis WHERE id_user='$id'";
		return $this->conn->query($query);
	}

	public function gajiGuru()
	{
		$kd_guru = $_POST['check'];
		$hitung_guru = count($kd_guru);
		for ($i = 0; $i < $hitung_guru; $i++) {

			$query = "UPDATE guru SET status_gaji=2 WHERE kd_guru = '$kd_guru[$i]'";
			$this->conn->query($query);
		}

		header("location: pguru.php");
	}


	public function konfirmasi_gaji()
	{
		$kd_guru = $_GET['konfirmasi_gaji'];
		$query = "UPDATE guru SET status_gaji = '1' WHERE kd_guru='$kd_guru'";
		$this->conn->query($query);
		header("location: halguru.php");
	}
}


$mhs = new Mahasiswa();

if (isset($_POST['submit'])) {
	$mhs->setsiswa();
}

if (isset($_POST['add_guru'])) {
	$mhs->addGuru();
	$mhs->proses_registrasiG();
}

if (isset($_GET['add_jurusan'])) {
	$mhs->addJurusan();
}

if (isset($_GET['add_matpel'])) {
	$mhs->addMatapelajaran();
}

if (isset($_GET['tambah_kelas'])) {
	$mhs->addKelas();
}

if (isset($_GET['delete'])) {
	$mhs->deleteSiswa();
}

if (isset($_GET['proses_login'])) {
	$mhs->proses_login();
}

if (isset($_GET['proses_regist'])) {
	$mhs->proses_registrasi();
}

if (isset($_GET['logout'])) {
	$mhs->proses_logout();
}

if (isset($_GET['logout2'])) {
	$mhs->proses_logout2();
}


if (isset($_GET['idpay'])) {
	$mhs->deletePay();
}

if (isset($_GET['delete_guru'])) {
	$mhs->deleteGuru();
}

if (isset($_GET['delete_kelas'])) {
	$mhs->deleteKelas();
}

if (isset($_GET['delete_jurusan'])) {
	$mhs->deleteJurusan();
}

if (isset($_GET['delete_matpel'])) {
	$mhs->deleteMatapelajaran();
}

if (isset($_GET['proses_bayar'])) {
	$mhs->prosesBayar();
}

if (isset($_GET['upload'])) {
	$mhs->upload();
}

if (isset($_GET['acc'])) {
	$mhs->accPayment();
}

if (isset($_POST['gaji'])) {
	$mhs->gajiGuru();
}

if (isset($_GET['konfirmasi_gaji'])) {
	$mhs->konfirmasi_gaji();
}
