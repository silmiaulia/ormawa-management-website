<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Pengurus.class.php");
include("includes/Divisi.class.php");
include("includes/Bidang_Divisi.class.php");

// instansiasi class pengurus
$pengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$pengurus->open();

if(isset($_POST['add'])){ //jika tombol add ditambah pada form

    $foto = $_FILES["uploadfile"]["name"]; //simpan file foto
    $tempname = $_FILES["uploadfile"]["tmp_name"]; //simpan file foto pada variabel temporary
    $folder = "assets/images/".$foto; //buat path untuk menyimpan file foto yg di upload

    move_uploaded_file($tempname, $folder); //pindahkan foto yg diupload ke folder

    $pengurus->add($_POST, $foto); //fungsi untuk menambahkan data pengurus
    header("location:index.php");

}

// instansiasi class divisi
$divisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
$divisi->open();
$divisi->getDivisi(); //untuk mendapatkan seluruh data divisi

// instansiasi class bidang_divisi
$jabatan = new Bidang_Divisi($db_host, $db_user, $db_pass, $db_name);
$jabatan->open();


$id_divisi = null;

if(!empty($_GET['id_divisi'])) { //jika id_divisi dari function script tidak kosong

    $id_divisi = $_GET["id_divisi"];         

    $jabatan->getJabatan_IdDivisi($id_divisi); //mendapatkan data bidang_divisi yang memiliki id_divisi =  $id_divisi
    
    echo '<option selected>Choose...</option>';

    while($row = $jabatan->getResult()){
        //menuliskan pilihan jabatan jabatan pada option
        echo '<option value="' . $row['id_bidang'] . '">' . $row['jabatan'] . '</option>';
    

    }


}


?>

<!-- Dokumen Add Pengurus -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
            
            .cardAdd-body{
                padding: 0 20px;
            }

            .cardAdd{
                width: 700px;
            }
    </style>
    
    <title>Tambah Pengurus</title>

</head>
<body>
    
    <!-- navbar start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-warning p-2 text-dark bg-opacity-50">
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

    
    <!-- form tambah data start -->
    <div class="container mt-5 mb-5 d-flex justify-content-center">
        <div class="cardAdd px-1 py-4">
            <div class="cardAdd-body">
                <h4 class="cardAdd-title mb-3">Tambah Data Pengurus</h4>
                <form action="addPengurus.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label">Nama</label> <input class="form-control" name="nama" type="text" placeholder="Masukan Nama..."> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label">Nim</label> 
                                <div class="input-group"> <input class="form-control" name="nim" type="text" placeholder="Masukan Nim..."> </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label">Semester</label> 
                                <div class="input-group"> <input class="form-control" name="semester" type="text" placeholder="Masukan Semester..."> </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label class="label">Divisi</label>
                                <div class="input-group">
                                    <select class="form-control" name="divisi" id="divisi-list">
                                        <option selected>Choose...</option>

                                        <?php
                                        // menampilkan seluruh data divisi pada input option
                                        while(list($id_divisi, $nama_divisi) = $divisi->getResult()){

                                               echo '<option value="' . $id_divisi . '">' . $nama_divisi . '</option>';
                                        }
                                        
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label class="label">Jabatan</label>
                                <div class="input-group">
                                    <select class="form-control" name="jabatan" id="jabatan-list">
                                        <option selected>Choose...</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <br>
                            <label class="label">Upload Foto</label>
                            <div class="form-group">
                                <div class="input-group">
                                <input class="form-control" type="file" name="uploadfile" value="" id="uploadfile">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=" d-flex flex-column text-center px-5 mt-3 mb-3"> 
                        <button class="btn btn-warning btn-block confirm-button" name="add">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- form tambah data end -->

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    // jQuery Function menggunakan AJAX 
    // untuk memunculkan pilihan pada input bidang_divisi berdasarkan pilihan dari input divisi
    $(document).ready(function() { 
        $("#divisi-list").on('change', function() { //fungsi dipanggil saat input option divisi dipilih
            var id_divisi = $(this).val(); //menyimpan value dari divisi yang dipilih

            $.ajax({
                method: "GET",
                url: "addPengurus.php", //link ke file addPengurus.php
                data: {
                    id_divisi: id_divisi 
                },
                datatype: "html",
                success: function(data) {
                    // menampilkan hasil data ke dokumen pada id jabatan-list
                    $("#jabatan-list").html(data);
                }
            });
        });

    });
</script>
</html>

