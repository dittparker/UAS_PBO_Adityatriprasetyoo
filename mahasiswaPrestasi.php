<?php
require_once 'Mahasiswa.php';

class MahasiswaPrestasi extends Mahasiswa {
    // Properti tambahan spesifik
    private $namaInstansiBeasiswa;
    private $minimalIpkSyarat;

    // Constructor Subclass
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $namaInstansiBeasiswa, $minimalIpkSyarat) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
        $this->minimalIpkSyarat = $minimalIpkSyarat;
    }

    // =========================================================================
    // METODE QUERY SPESIFIK (SELECT + WHERE)
    // =========================================================================
    public static function getDaftarPrestasi($db) {
        $sql = "SELECT id_mahasiswa, nama_mahasiswa, nilai, semester, tarif_ukt, jenis_pembiayaan, nama_instansi_beasiswa, minimal_ipk_syarat 
                FROM tabel_mahasiswa 
                WHERE jenis_pembiayaan = 'prestasi'";
        return $db->query($sql);
    }

public function hitungTagihanSemester() {
    return $this->tarifUktNominal * 0.25;
}
    public function tampilkanSpesifikasiAkademik() { return ""; }
}
?>