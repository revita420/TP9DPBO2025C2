<?php

include("KontrakView.php");
include("presenter/ProsesMahasiswa.php");

class TampilMahasiswa implements KontrakView
{
    private $prosesmahasiswa; // Presenter yang dapat berinteraksi langsung dengan view
    private $tpl;

    function __construct()
    {
        //konstruktor
        $this->prosesmahasiswa = new ProsesMahasiswa();
        
        //CRUD 
        $this->handleRequest();
    }
    
    function handleRequest()
    {
        if (isset($_POST['add'])) {
            //  add 
            $mahasiswa = new Mahasiswa();
            $mahasiswa->setNim($_POST['nim']);
            $mahasiswa->setNama($_POST['nama']);
            $mahasiswa->setTempat($_POST['tempat']);
            $mahasiswa->setTl($_POST['tl']);
            $mahasiswa->setGender($_POST['gender']);
            $mahasiswa->setEmail($_POST['email']);
            $mahasiswa->setTelp($_POST['telp']);
            
            $this->prosesmahasiswa->tambahMahasiswa($mahasiswa);
            header("Location: index.php");
        } else if (isset($_POST['update'])) {
            // update 
            $mahasiswa = new Mahasiswa();
            $mahasiswa->setId($_POST['id']);
            $mahasiswa->setNim($_POST['nim']);
            $mahasiswa->setNama($_POST['nama']);
            $mahasiswa->setTempat($_POST['tempat']);
            $mahasiswa->setTl($_POST['tl']);
            $mahasiswa->setGender($_POST['gender']);
            $mahasiswa->setEmail($_POST['email']);
            $mahasiswa->setTelp($_POST['telp']);
            
            $this->prosesmahasiswa->updateMahasiswa($mahasiswa);
            header("Location: index.php");
        } else if (isset($_GET['delete'])) {
            // delete
            $id = $_GET['delete'];
            $this->prosesmahasiswa->hapusMahasiswa($id);
            header("Location: index.php");
        }
    }

    function tampil()
    {
        $this->prosesmahasiswa->prosesDataMahasiswa();
        $data = null;

        //semua terkait tampilan adalah tanggung jawab view
        for ($i = 0; $i < $this->prosesmahasiswa->getSize(); $i++) {
            $no = $i + 1;
            $data .= "<tr>
            <td>" . $no . "</td>
            <td>" . $this->prosesmahasiswa->getNim($i) . "</td>
            <td>" . $this->prosesmahasiswa->getNama($i) . "</td>
            <td>" . $this->prosesmahasiswa->getTempat($i) . "</td>
            <td>" . $this->prosesmahasiswa->getTl($i) . "</td>
            <td>" . $this->prosesmahasiswa->getGender($i) . "</td>
            <td>" . $this->prosesmahasiswa->getEmail($i) . "</td>
            <td>" . $this->prosesmahasiswa->getTelp($i) . "</td>
            <td>
                <a href='index.php?edit=" . $this->prosesmahasiswa->getId($i) . "' class='btn btn-warning btn-sm'>Edit</a>
                <a href='index.php?delete=" . $this->prosesmahasiswa->getId($i) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin hapus data?');\">Delete</a>
            </td>
            </tr>";
        }
        
        $formHTML = "";
        if (isset($_GET['add'])) {
            $formHTML = $this->tampilForm("add");
        } else if (isset($_GET['edit'])) {
            $id = $_GET['edit'];
            $mhs = $this->prosesmahasiswa->getMahasiswaById($id);
            $formHTML = $this->tampilForm("edit", $mhs);
        }
        
        // Membaca template skin.html
        $this->tpl = new Template("templates/skin.html");

        // Mengganti kode Data_Tabel dengan data yang sudah diproses
        $this->tpl->replace("DATA_TABEL", $data);
        $this->tpl->replace("DATA_FORM", $formHTML);

        // Menampilkan ke layar
        $this->tpl->write();
    }
    
    function tampilForm($action, $mhs = null)
    {
        $titleForm = ($action == "add") ? "TAMBAH DATA MAHASISWA" : "EDIT DATA MAHASISWA";
        $submitLabel = ($action == "add") ? "Tambah" : "Update";
        $submitName = ($action == "add") ? "add" : "update";
        
        $id = "";
        $nim = "";
        $nama = "";
        $tempat = "";
        $tl = "";
        $gender = "";
        $email = "";
        $telp = "";
        
        if ($mhs != null) {
            $id = $mhs->getId();
            $nim = $mhs->getNim();
            $nama = $mhs->getNama();
            $tempat = $mhs->getTempat();
            $tl = $mhs->getTl();
            $gender = $mhs->getGender();
            $email = $mhs->getEmail();
            $telp = $mhs->getTelp();
        }
        
        $html = "
        <div class='row'>
            <div class='col-12'>
                <div class='card mb-4'>
                    <div class='card-header bg-primary text-white'>
                        <h4 class='mb-0'>$titleForm</h4>
                    </div>
                    <div class='card-body'>
                        <form method='post' action='index.php'>
                            <input type='hidden' name='id' value='$id'>
                            <div class='form-group row'>
                                <label class='col-sm-2 col-form-label'>NIM</label>
                                <div class='col-sm-10'>
                                    <input type='text' class='form-control' name='nim' value='$nim' required>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-sm-2 col-form-label'>Nama</label>
                                <div class='col-sm-10'>
                                    <input type='text' class='form-control' name='nama' value='$nama' required>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-sm-2 col-form-label'>Tempat Lahir</label>
                                <div class='col-sm-10'>
                                    <input type='text' class='form-control' name='tempat' value='$tempat' required>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-sm-2 col-form-label'>Tanggal Lahir</label>
                                <div class='col-sm-10'>
                                    <input type='date' class='form-control' name='tl' value='$tl' required>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-sm-2 col-form-label'>Gender</label>
                                <div class='col-sm-10'>
                                    <select class='form-control' name='gender' required>
                                        <option value=''>Pilih Gender</option>
                                        <option value='Laki-laki' " . ($gender == 'Laki-laki' ? 'selected' : '') . ">Laki-laki</option>
                                        <option value='Perempuan' " . ($gender == 'Perempuan' ? 'selected' : '') . ">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-sm-2 col-form-label'>Email</label>
                                <div class='col-sm-10'>
                                    <input type='email' class='form-control' name='email' value='$email' required>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-sm-2 col-form-label'>No. Telepon</label>
                                <div class='col-sm-10'>
                                    <input type='text' class='form-control' name='telp' value='$telp' required>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <div class='col-sm-10 offset-sm-2'>
                                    <button type='submit' class='btn btn-primary' name='$submitName'>$submitLabel</button>
                                    <a href='index.php' class='btn btn-secondary'>Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>";
        
        return $html;
    }
}