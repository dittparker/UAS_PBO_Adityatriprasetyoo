<?php
require_once 'Mahasiswa.php';

class MahasiswaBidikmisi extends Mahasiswa {
    // Properti tambahan spesifik
    private $nomorKipKuliah;
    private $danaSakuSubsidi; // Tambahan komponen dana saku subsidi

    // Constructor Subclass
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $nomorKipKuliah, $danaSakuSubsidi = 0) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->nomorKipKuliah = $nomorKipKuliah;
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }

    // =========================================================================
    // METODE QUERY SPESIFIK (SELECT + WHERE)
    // =========================================================================
    public static function getDaftarBidikmisi($db) {
        $sql = "SELECT id_mahasiswa, nama_mahasiswa, nilai, semester, tarif_ukt, jenis_pembiayaan, nomor_kip_kuliah 
                FROM tabel_mahasiswa 
                WHERE jenis_pembiayaan = 'bidikmisi'";
        return $db->query($sql);
    }

public function hitungTagihanSemester() {
    return 0;
}
public function tampilkanSpesifikasiAkademik() {
    return "Nomor KIP-K: " . $this->nomorKipKuliah;
}
?>