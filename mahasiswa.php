<?php

// Menggunakan keyword 'abstract' agar kelas induk tidak bisa diinstansiasi secara langsung
abstract class Mahasiswa {
    
    // Properti Terenkapsulasi (protected) - Wajib dipetakan dari kolom database
    protected $id_mahasiswa;
    protected $nama_mahasiswa;
    protected $nim; // Properti tambahan sesuai instruksi class abstract
    protected $semester;
    protected $tarifUktNominal;

    /**
     * Constructor untuk memetakan nilai dari kolom database ke properti objek
     */
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal) {
        $this->id_mahasiswa    = $id_mahasiswa;
        $this->nama_mahasiswa  = $nama_mahasiswa;
        $this->nim             = $nim; // Bisa diisi NIM buatan atau dummy saat mapping dari database
        $this->semester        = $semester;
        $this->tarifUktNominal = $tarifUktNominal;
    }

    // =========================================================================
    // METODE ABSTRAK (Wajib murni tanpa isi / body / kurung kurawal)
    // =========================================================================
    
    // Menghitung tagihan semester yang berbeda-beda di tiap jenis pembiayaan
    abstract public function hitungTagihanSemester();

    // Menampilkan informasi spesifik akademik dari masing-masing jenis pembiayaan
    abstract public function tampilkanSpesifikasiAkademik();

    // =========================================================================
    // GETTER METHODS (Agar nilai protected tetap bisa diakses/dicetak di file luar)
    // =========================================================================
    public function getIdMahasiswa() { return $this->id_mahasiswa; }
    public function getNamaMahasiswa() { return $this->nama_mahasiswa; }
    public function getNim() { return $this->nim; }
    public function getSemester() { return $this->semester; }
    public function getTarifUktNominal() { return $this->tarifUktNominal; }
}

?>