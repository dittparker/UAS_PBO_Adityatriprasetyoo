<?php

class Koneksi {
    private $host     = "localhost";
    private $username = "root";
    private $password = "";
    // Menyesuaikan dengan database tabel_mahasiswa yang kita buat sebelumnya
    private $database = "DB_LATIHAN_PBO_TI-1D_Adityatriprasetyo"; 
    public $db;

    public function __construct() {
        try {
            // Membuka koneksi menggunakan MySQLi OOP
            $this->db = new mysqli($this->host, $this->username, $this->password, $this->database);

            // Cek jika koneksi error
            if ($this->db->connect_error) {
                throw new Exception("Koneksi gagal: " . $this->db->connect_error);
            }
        } catch (Exception $e) {
            echo "Terjadi kesalahan koneksi: " . $e->getMessage();
        }
    }
}
?>