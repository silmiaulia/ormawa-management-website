<?php


class Bidang_Divisi extends DB{

    
    function getBidangDivisi(){ //fungsi untuk mendapatkan seluruh data tabel bidang_divisi

        $query = " select * from bidang_divisi";

        return $this->execute($query);
    }

    function add($data){ //fungsi untuk menambahkan data

        $jabatan = $data['jabatan'];
        $id_divisi = $data['divisi'];

        $query = "INSERT INTO bidang_divisi  values ('', '$jabatan', '$id_divisi')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    
    function delete($id) //fungsi delete data
    {

        $query = "DELETE FROM bidang_divisi where id_bidang = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function update($data) //fungsi update data
    {
        $id_bidang = $data['id_bidang'];
        $jabatan = $data['jabatan'];
        $id_divisi = $data['divisi'];

        $query = "update bidang_divisi       
                  set jabatan = '$jabatan',
                  id_divisi = '$id_divisi'
                  where id_bidang = '$id_bidang'";

        return $this->execute($query);
    }

    function getJabatan($id){ //fungsi untuk select data dari tabel berdasarkan id_bidang

        $query = "SELECT * FROM bidang_divisi where id_bidang  = '$id'";
        
        return $this->execute($query);
    }


    function getJabatan_IdDivisi($id){ //fungsi untuk select data dari tabel berdarkan id_divisi
        
        $query = "SELECT * FROM bidang_divisi where id_divisi  = '$id'";
        
        return $this->execute($query);
    }
}

    

?>