# Janji
Saya Syahraini Revita Puri dengan NIM 2301895 berjanji mengerjakan TP9 DPBO dengan keberkahan-Nya, maka saya tidak akan melakukan kecurangan sesuai yang telah di spesifikasikan, Aamiin

# Desain Program
Program ini adalah aplikasi manajemen data mahasiswa yang dibangun menggunakan pola arsitektur MVP (Model-View-Presenter). Dimana `model`: bertanggung jawab untuk akses data dan logika, `view` : bertanggung jawab untuk tampilan dan interaksi pengguna, dan `presenter` : bertanggung jawab sebagai perantara antara model dan view. Program sebelumnya hanya menampilkan data mahasiswa (Read) dengan kolom (nim, nama, tempat lahir, tanggal lahir, dan gender). Untuk itu dilakukan perubahan/penambahan :


**1. Penambahan Atribut Data:**
- Ditambahkan 2 kolom baru : `email` dan `telepon` yang sudah ada di database namun belum ditampilkan di aplikasi
- Kolom ini diambil dari tabel `mahasiswa` yang sudah memiliki field `email` dan `telp`

**2. Implementasi CRUD:**
- **Create:** Fitur untuk menambahkan data mahasiswa baru
- **Read:** Fitur untuk menampilkan data mahasiswa (sudah ada sebelumnya, ditambahkan kolom email dan telepon)
- **Update:** Fitur untuk menguubah data mahasiswa yang sudah ada
- **Delete:** Fitur untuk menghapus data mahasiswa

**3. Tampilan:** 
- Penambahan navbar untuk navigasi
- Form input dengan validasi untuk operasi create dan update
- Tombol aksi (edit dan delete) di setiap baris data
- Konfirmasi sebelum menghapus data

# Alur Program


**1.** `index.php` → include `TampilMahasiswa.php` → buat objek `TampilMahasiswa` → panggil `tampil()`

**2.** `TampilMahasiswa` *(View)*
- -> buat objek ProsesMahasiswa
- -> panggil handleRequest()

**3.** `handleRequest()` *(View)*
- Jika `POST['add']` -> buat objek Mahasiswa -> panggil `tambahMahasiswa()`
- Jika `POST['update']` -> buat objek Mahasiswa -> panggil `updateMahasiswa()`
- Jika `GET['delete']` -> ambil ID -> panggil `hapusMahasiswa()`

**4.** `ProsesMahasiswa` *(Presenter)*
- `open()` koneksi DB
- Panggil fungsi di Model (`addMahasiswa`, `updateMahasiswa`, `hapusMahasiswa`, `getMahasiswa`)
- `close()` koneksi DB

**5.** `TabelMahasiswa` *(Model)*
- Susun dan jalankan query SQL
- Kembalikan hasil ke Presenter

**6.** `tampil()` *(View)*
- Ambil data dari presenter -> render ke HTML template

# Dokumentasi

