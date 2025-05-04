<?php

// Kelas yang berisikan tabel dari mahasiswa
class TabelMahasiswa extends DB
{
    function getMahasiswa()
    {
        // Query mysql select data mahasiswa
        $query = "SELECT * FROM mahasiswa";
        
        // Mengeksekusi query
        return $this->execute($query);
    }
    
    function getMahasiswaById($id)
    {
        // Query mysql select data mahasiswa by id
        $query = "SELECT * FROM mahasiswa WHERE id = '$id'";
        
        // Mengeksekusi query
        return $this->execute($query);
    }
    
    function addMahasiswa($data)
    {
        // Query untuk insert data mahasiswa
        $nim = $data->getNim();
        $nama = $data->getNama();
        $tempat = $data->getTempat();
        $tl = $data->getTl();
        $gender = $data->getGender();
        $email = $data->getEmail();
        $telp = $data->getTelp();
        
        $query = "INSERT INTO mahasiswa VALUES ('', '$nim', '$nama', '$tempat', '$tl', '$gender', '$email', '$telp')";
        
        // Mengeksekusi query
        return $this->execute($query);
    }
    
    function updateMahasiswa($data)
    {
        // Query untuk update data mahasiswa
        $id = $data->getId();
        $nim = $data->getNim();
        $nama = $data->getNama();
        $tempat = $data->getTempat();
        $tl = $data->getTl();
        $gender = $data->getGender();
        $email = $data->getEmail();
        $telp = $data->getTelp();
        
        $query = "UPDATE mahasiswa 
                 SET nim = '$nim', 
                     nama = '$nama', 
                     tempat = '$tempat', 
                     tl = '$tl', 
                     gender = '$gender', 
                     email = '$email', 
                     telp = '$telp' 
                 WHERE id = '$id'";
        
        // Mengeksekusi query
        return $this->execute($query);
    }
    
    function deleteMahasiswa($id)
    {
        // Query untuk delete data mahasiswa
        $query = "DELETE FROM mahasiswa WHERE id = '$id'";
        
        // Mengeksekusi query
        return $this->execute($query);
    }
}