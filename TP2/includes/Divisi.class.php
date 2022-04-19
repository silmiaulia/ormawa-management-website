<?php


class Divisi extends DB{

    function getDivisi(){ //fungsi untuk mendapatkan seluruh data tabel

        $query = "SELECT * FROM divisi";
        return $this->execute($query);
    }

    function add($data){ //fungsi untuk menambahkan data

        $nama_divisi = $data['nama_divisi'];

        $query = "insert into divisi values ('', '$nama_divisi')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function getDivisiName($id){  //fungsi untuk select data dari tabel berdasarkan id_divisi

        $query = "SELECT * FROM divisi where id_divisi  = '$id'";
        
        return $this->execute($query);
    }

    function delete($id) //fungsi delete data
    {

        $query = "DELETE FROM divisi where id_divisi = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function update($data) //fungsi update data
    {
        $id_divisi = $data['id_divisi'];
        $nama_divisi = $data['nama_divisi'];

        $query = "update divisi       
                  set nama_divisi = '$nama_divisi'
                  where id_divisi = '$id_divisi'";

        return $this->execute($query);
    }

}

    

?>