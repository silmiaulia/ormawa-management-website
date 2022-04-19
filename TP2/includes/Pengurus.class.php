<?php


class Pengurus extends DB{

    function getPengurus(){ //fungsi untuk mendapatkan seluruh data tabel

        $query = "SELECT * FROM pengurus";
        return $this->execute($query);
    }

    
    function getDetailPengurus($id){  //fungsi untuk select data dari tabel berdasarkan id_pengurus

        $query = "SELECT * FROM pengurus where  id_pengurus  = '$id'";
        return $this->execute($query);
    }

    function add($data, $foto){ //fungsi untuk menambahkan data

        $nim = $data['nim'];
        $nama = $data['nama'];
        $semester = $data['semester'];
        $id_bidang = $data['jabatan'];

        $query = "insert into pengurus values ('', '$nim', '$nama', '$semester', '$foto', '$id_bidang')";

        // Mengeksekusi query
        return $this->execute($query);

    }


    function delete($id) //fungsi delete data
    {

        $query = "DELETE FROM pengurus where id_pengurus = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function update($data, $foto){ //fungsi update data

        $id_pengurus = $data['key'];
        $nim = $data['nim'];
        $nama = $data['nama'];
        $semester = $data['semester'];
        $id_bidang = $data['jabatan'];

        $query = "update pengurus       
                  set nim = '$nim',
                  nama = '$nama',
                  semester = '$semester',
                  foto = '$foto',
                  id_bidang = '$id_bidang'
                  where id_pengurus = '$id_pengurus'";

        return $this->execute($query);

    }
}

    
?>