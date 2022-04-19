<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Divisi.class.php");

// instansiasi class divisi
$divisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
$divisi->open();

$data_input = null;

if (empty($_GET['id_edit'])) { //jika id_edit masih kosong (tampilkan form input data divisi)
    // simpan form ke $variabel data_input
    $data_input .= "<form action='divisi.php' method='POST' enctype='multipart/form-data'>
                        <div class='row'>
                            <div class='col-sm-12'>
                                <div class='form-group'>
                                    <label class='label'>Nama Divisi</label> <input class='form-control' name='nama_divisi' type='text' placeholder='Masukan nama divisi...'> </div>
                            </div>
                        </div>
                        <div class='button-tambah'>
                            <button class='btn btn-warning btn-block confirm-button' name='add'>Tambah</button>
                        </div>
                    </form>";
}


if (!empty($_GET['id_hapus'])) { //jika tombol delete di klik

    $id = $_GET['id_hapus']; //dapatkan id_divisi yang akan dihapus

    $divisi->delete($id); //fungsi untuk menghapus data divisi 
    header("location:divisi.php");
}


if (isset($_GET['id_edit'])) { //jika tombol edit di klik

    $id = $_GET['id_edit']; //dapatkan id_divisi yang akan di update

    $divisi->getDivisiName($id); //dapatkan data divisi berdasarkan id_divisinya

    while (list($id_divisi, $nama_divisi) = $divisi->getResult()){ 

        //simpan form update dengan input field yang sudah terisi dengan nilai dari hasil eksekusi query
        $data_input .= "<form action='divisi.php' method='POST' enctype='multipart/form-data'>
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <div class='form-group'>
                                        <input type='hidden' name='id_divisi' value='$id_divisi'>
                                        <label class='label'>Nama Divisi</label> <input class='form-control' name='nama_divisi' type='text' value='$nama_divisi'> </div>
                                </div>
                            </div>
                            <div class='button-tambah'>
                                <button class='btn btn-warning btn-block confirm-button' name='update'>Update</button>
                            </div>
                        </form>";
    }

}

if(isset($_POST['update'])){ //jika tombol update pada form update diklik

    $divisi->update($_POST); //panggil fungsi untuk melakukan update divisi
    header("location:divisi.php");

}


if(isset($_POST['add'])){ //jika tombol tambah pada form add diklik

    $divisi->add($_POST);
    header("location:divisi.php");

}

$data = null;
$no = 1;

$divisi->getDivisi(); //dapatkan seluruh data divisi
while (list($id_divisi, $nama_divisi) = $divisi->getResult()){
    //menampilkan data divisi hasil eksekusi ke dalam tabel dan disimpan pada variabel data
    $data .= "<tr>
                <td class='table-warning' align='center'>" . $no++ . "</td>
                <td class='table-warning' align='center'>" . $nama_divisi . "</td>
                <td class='table-warning' align='center'>
                    <a href='divisi.php?id_edit=". $id_divisi . " id='text-edit' class='text-edit'><i id='edit' class='fa fa-fw fa-edit'></i> Edit</a> |
                    <a href='divisi.php?id_hapus=". $id_divisi . " id='text-delete' class='text-delete'><i id='delete' class='fa fa-fw fa-trash'></i> Delete</a> 
                </td>
            </tr>";

}

$divisi->close();
//replace dan write data tabel dan data input ke template
$tpl = new Template("template/divisi.html");
$tpl->replace("INPUT", $data_input);
$tpl->replace("DATA_TABEL", $data);
$tpl->write();

