<?php
require_once 'Mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa {
    // Properti tambahan spesifik
    private $golonganUkt;
    private $namaWali;

    // Constructor Subclass
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $golonganUkt, $namaWali) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->golonganUkt = $golonganUkt;
        $this->namaWali = $namaWali;
    }

    // =========================================================================
    // METODE QUERY SPESIFIK (SELECT + WHERE)
    // =========================================================================
    public static function getDaftarMandiri($db) {
        $sql = "SELECT id_mahasiswa, nama_mahasiswa, nilai, semester, tarif_ukt, jenis_pembiayaan, golongan_ukt, nama_wali 
                FROM tabel_mahasiswa 
                WHERE jenis_pembiayaan = 'mandiri'";
        return $db->query($sql);
    }

public function hitungTagihanSemester() {
    return $this->tarifUktNominal + 100000;
}
    public function tampilkanSpesifikasiAkademik() { return ""; }
}
?>