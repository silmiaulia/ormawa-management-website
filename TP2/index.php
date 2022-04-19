<?php

// inport
include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Pengurus.class.php");
include("includes/Divisi.class.php");
include("includes/Bidang_Divisi.class.php");

// instansiasi class pengurus
$pengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$pengurus->open();
$pengurus->getPengurus(); //untuk mendapatkan data seluruh pengurus

// instansiasi class divisi
$divisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
$divisi->open();

// instansiasi class bidang_divisi
$bidang_divisi = new Bidang_Divisi($db_host, $db_user, $db_pass, $db_name);
$bidang_divisi->open();


$data = null; //untuk menyimpan data pengurus
$no = 1;

// perulanagan untuk mengambil dan menampilkan data pengurus
while (list($id_pengurus, $nim, $nama, $semester, $foto, $id_bidang) = $pengurus->getResult()){
    
    $bidang_divisi->getJabatan($id_bidang); //untuk select data dari tabel bidang_divisi berdasarkan id_bidang dari tabel pengurus
    $jabatan = $bidang_divisi->getResult(); //menyimpan hasil eksekusi 

    $divisi->getDivisiName($jabatan['id_divisi']); //untuk select data dari tabel divisi berdasarkan id_divisi data tabel bidang_divisi
    $nama_divisi = $divisi->getResult(); // menyimpan hasil eksekusi


    // simpan data card pengurus
    $data .= " <div class='col-md-3'>
                <a href='detailPengurus.php?id_pengurus=" . $id_pengurus . "'>
                    <div class='card p-2 py-3 text-center'>
                        <div class='img mb-2'> <img src='assets/images/". $foto ."' width='110' height='110' class='rounded-circle'></div>
                        <h5 class='mb-0'><strong> ". $nama ." </strong></h5> 

                        <small>". $jabatan['jabatan'] ."</small>
                        <small>Divisi ". $nama_divisi['nama_divisi'] ."</small>
                        <div class='mt-4 apointment'> <button class='btn btn-warning btn-opacity-50 text-uppercase'>Detail</button> </div>
                    </div>
                </a>
            </div> ";

}

$pengurus->close(); 
//replace dan write data ke template
$tpl = new Template("template/pengurus.html");
$tpl->replace("DATA_DAFTAR_PENGURUS", $data); 
$tpl->write();

