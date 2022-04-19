<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Pengurus.class.php");
include("includes/Divisi.class.php");
include("includes/Bidang_Divisi.class.php");

$id_pengurus = $_GET['id_pengurus']; //simpan id_pengurus

// instansiasi class pengurus, divisi, dan bidang_divsi
$pengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$pengurus->open();
$divisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
$divisi->open();
$bidang_divisi = new Bidang_Divisi($db_host, $db_user, $db_pass, $db_name);
$bidang_divisi->open();

// untuk select data pengurus berdasarkan id_pengurusnya
$pengurus->getDetailPengurus($id_pengurus);
// simpan hasil eksekusi select nya
$data = $pengurus->getResult();

// untuk select data bidang_divisi berdasarkan id_bidang dari tabel pengurus
$bidang_divisi->getJabatan($data['id_bidang']);
// simpan hasil eksekusi select nya
$jabatan = $bidang_divisi->getResult();

// untuk select data divisi berdasarkan id_divisi dari tabel bidang_divisi
$divisi->getDivisiName($jabatan['id_divisi']);
// simpan hasil eksekusi select nya
$nama_divisi = $divisi->getResult();


if (!empty($_GET['id_hapus'])) {
    // jika tombol delete di klik

    $id = $_GET['id_hapus'];

    $pengurus->delete($id); //fungsi untuk menghapus data dari database
    header("location:index.php");
}


?>

<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Detail Pengurus</title>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="assets/css/style.css">

        <script type='text/javascript' src=''></script>
        <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
        <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>


</head>
<body>

  <!-- navbar start -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-warning p-2 text-dark">
      <div class="container-fluid">
          <a class="navbar-brand" href="index.php">
            <img src="assets/images/ormawa.png" width="130" height="60" class="d-inline-block align-top" alt="">
          </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Pengurus</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="divisi.php">Divisi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="bidang_divisi.php">Jabatan</a>
            </li>
          </ul>
        </div>
      </div>
  </nav>
  <!-- navbar end -->

  <!-- card detail -->
  <div class="container mt-5 mb-5 element">
    <div class="col-md-5">
        <div class="card p-2 py-3 text-center">
            <div class="img mb-2"> <img src="assets/images/<?= $data['foto'] ?>" width="110" height="110" class="rounded-circle"> </div>
            <h5 class='mb-0'><strong> <?= $data['nama'] ?> </strong></h5> 
            <small> <?= $data['nim'] ?></small>
            <small>Semester  <?= $data['semester'] ?></small>
            <small> <?= $jabatan['jabatan'] ?></small>
            <small>Divisi  <?= $nama_divisi['nama_divisi'] ?></small>
            <div class="mt-4 apointment"> 
                <button class="btn btn-warning text-uppercase"> <a href="editPengurus.php?id_edit=<?= $data['id_pengurus'] ?>">Edit</button> 
                <button class="btn btn-warning text-uppercase"><a href="detailPengurus.php?id_hapus=<?= $data['id_pengurus'] ?>">Delete</button> 
            </div>
        </div>
    </div>
  </div>

</body>
</html>

