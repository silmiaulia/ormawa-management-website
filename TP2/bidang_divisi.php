<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Bidang_Divisi.class.php");
include("includes/Divisi.class.php");


// instansiasi class bidang_divisi
$jabatan = new Bidang_Divisi($db_host, $db_user, $db_pass, $db_name);
$jabatan->open();

// instansiasi class divisi
$divisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
$divisi->open();
$divisi->getDivisi(); //untuk mendapatkan seluruh data divisi

$data_input = null;

if (empty($_GET['id_edit'])) { //jika id_edit belum didapatkan 

    $data_divisi = null;                                                  
                                                
    while(list($id_divisi, $nama_divisi) = $divisi->getResult()){
    
        //simpan hasil eksekusi select seleruh data  divisi                                                   
        $data_divisi .= "<option value=' ". $id_divisi . "'>" .$nama_divisi . "</option>";
    
    }

    // simpan form input data divisi
    $data_input .= "<form action='bidang_divisi.php' method='POST' enctype='multipart/form-data'>
                        <div class='row'>
                            <div class='col-sm-12'>
                                <div class='form-group'>
                                    <label class='label'>Nama Jabatan</label> 
                                    <input class='form-control' name='jabatan' type='text' placeholder='Masukan jabatan...'> 
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-12'>
                                <div class='form-group'>
                                <label class='label'>Divisi</label>
                                    <div class='input-group'>
                                        <select class='form-control' name='divisi' id='divisi-list'>
                                            <option selected>Choose...</option>
                                                " .$data_divisi ."
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='button-tambah'>
                            <button class='btn btn-warning btn-block confirm-button' name='add'>Tambah</button>
                        </div>
                    </form>";
}

if (!empty($_GET['id_hapus'])) { //jika tombol delete di klik

    $id = $_GET['id_hapus']; //simpan id_hapus

    $jabatan->delete($id); //memanggil fungsi untuk menghapus data divisi dari tabel database
    header("location:bidang_divisi.php");
}


if (isset($_GET['id_edit'])) { //jika tombol edit diklik

    $id = $_GET['id_edit']; //simpan id_edit

    $jabatan->getJabatan($id); //dapatkan data bidang_divisi berdasarkan id_bidangnya

    $data_jabatan = $jabatan->getResult(); //simpan data hasil eksekusi

    $data_divisi = null;  
    
    $divisi->getDivisi(); //dapatkan seluruh data divisi

    while(list($id_divisi, $nama_divisi) = $divisi->getResult()){

        if ($data_jabatan['id_divisi'] == $id_divisi) { //jika id_divisi pada tabel dari data hasil eksekusi sama dengan id_divisi pada data_jabatan
            $select="selected";
        }else{
            $select="";
        }
            //simpan option divisi pada data_divisi
            $data_divisi .= "<option value='$id_divisi' $select>$nama_divisi</option>";
    }

    // simpan form update dengan input field yang sudah terisi dengan nilai dari hasil eksekusi query
    $data_input .= "<form action='bidang_divisi.php' method='POST' enctype='multipart/form-data'>
                        <div class='row'>
                            <div class='col-sm-12'>
                                <div class='form-group'>
                                    <input type='hidden' name='id_bidang' value='". $data_jabatan['id_bidang'] ."'>
                                    <label class='label'>Nama Jabatan</label> <input class='form-control' name='jabatan' type='text' value=' ".$data_jabatan['jabatan'] ."'> 
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-12'>
                                <div class='form-group'>
                                <label class='label'>Divisi</label>
                                    <div class='input-group'>
                                        <select class='form-control' name='divisi' id='divisi-list'>
                                                " .$data_divisi ."
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='button-tambah'>
                            <button class='btn btn-warning btn-block confirm-button' name='update'>Update</button>
                        </div>
                    </form>";


}


if(isset($_POST['update'])){ //jika tombol update pada form input update diklik

    $jabatan->update($_POST); //fungsi untuk melakukan update data bidang_divisi
    header("location:bidang_divisi.php");

}

if(isset($_POST['add'])){ //jika tombol tambah pada form input add diklik

    $jabatan->add($_POST); //fungsi untuk melakukan tambah data bidang_divisi
    header("location:bidang_divisi.php");

}

$data = null;
$no = 1;

$jabatan->getBidangDivisi(); //dapatkan seluruh data bidang_divisi

while($data_jabatan = $jabatan->getResult()){ 

    $divisi->getDivisiName($data_jabatan['id_divisi']); //dapatkan data divisi berdasarkan id_divisi dari data bidang_divisi
    $data_divisi = $divisi->getResult(); //simpan hasil eksekusi

    // simpan tabel daftar bidang_divisi
    $data .= "<tr>
                <td class='table-warning' align='center'>" . $no++ . "</td>
                <td class='table-warning' align='center'>" . $data_jabatan['jabatan'] . "</td>
                <td class='table-warning' align='center'>" . $data_divisi['nama_divisi'] . "</td>
                <td class='table-warning' align='center'>
                    <a href='bidang_divisi.php?id_edit=". $data_jabatan['id_bidang'] . " id='text-edit' class='text-edit'><i id='edit' class='fa fa-fw fa-edit'></i> Edit</a> |
                    <a href='bidang_divisi.php?id_hapus=". $data_jabatan['id_bidang'] . " id='text-delete' class='text-delete'><i id='delete' class='fa fa-fw fa-trash'></i> Delete</a> 
                </td>
            </tr>";

}


$jabatan->close();
$tpl = new Template("template/bidang_divisi.html");
//replace dan write data tabel dan data input ke template
$tpl->replace("INPUT", $data_input);
$tpl->replace("DATA_TABEL", $data);
$tpl->write();


