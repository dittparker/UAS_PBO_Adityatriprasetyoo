<?php
// 1. Memanggil semua file komponen OOP yang diperlukan
require_once 'koneksi.php';
require_once 'MahasiswaMandiri.php';
require_once 'MahasiswaBidikmisi.php';
require_once 'MahasiswaPrestasi.php';

// 2. Inisialisasi objek koneksi database
$koneksiObj = new Koneksi();
$db = $koneksiObj->db;

// Menghentikan aplikasi secara aman jika koneksi bermasalah (mencegah error NULL)
if (!$db) {
    die("<h3 style='color:red; text-align:center; font-family:sans-serif;'>Koneksi database terputus atau NULL. Periksa file koneksi.php!</h3>");
}

// 3. Mengambil data terpisah per kategori menggunakan method query dari subclass
$resultMandiri   = MahasiswaMandiri::getDaftarMandiri($db);
$resultBidikmisi = MahasiswaBidikmisi::getDaftarBidikmisi($db);
$resultPrestasi  = MahasiswaPrestasi::getDaftarPrestasi($db);

// Array untuk menyimpan objek konkrit hasil instansiasi
$daftarMandiri   = [];
$daftarBidikmisi = [];
$daftarPrestasi  = [];

// 4. Mapping data Mahasiswa Mandiri (Set NIM dummy/urut karena di database belum ada kolom NIM)
if ($resultMandiri && $resultMandiri->num_rows > 0) {
    $i = 1;
    while ($row = $resultMandiri->fetch_assoc()) {
        $nimDummy = "220101" . str_pad($i, 3, "0", STR_PAD_LEFT);
        $daftarMandiri[] = new MahasiswaMandiri(
            $row['id_mahasiswa'], $row['nama_mahasiswa'], $nimDummy, 
            $row['semester'], $row['tarif_ukt'], 
            $row['golongan_ukt'], $row['nama_wali']
        );
        $i++;
    }
}

// 5. Mapping data Mahasiswa Bidikmisi
if ($resultBidikmisi && $resultBidikmisi->num_rows > 0) {
    $i = 1;
    while ($row = $resultBidikmisi->fetch_assoc()) {
        $nimDummy = "220202" . str_pad($i, 3, "0", STR_PAD_LEFT);
        $daftarBidikmisi[] = new MahasiswaBidikmisi(
            $row['id_mahasiswa'], $row['nama_mahasiswa'], $nimDummy, 
            $row['semester'], $row['tarif_ukt'], 
            $row['nomor_kip_kuliah'], 
            650000 // Contoh komponen dana saku subsidi yang dimasukkan ke properti anak
        );
        $i++;
    }
}

// 6. Mapping data Mahasiswa Prestasi
if ($resultPrestasi && $resultPrestasi->num_rows > 0) {
    $i = 1;
    while ($row = $resultPrestasi->fetch_assoc()) {
        $nimDummy = "220303" . str_pad($i, 3, "0", STR_PAD_LEFT);
        $daftarPrestasi[] = new MahasiswaPrestasi(
            $row['id_mahasiswa'], $row['nama_mahasiswa'], $nimDummy, 
            $row['semester'], $row['tarif_ukt'], 
            $row['nama_instansi_beasiswa'], $row['minimal_ipk_syarat']
        );
        $i++;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Pembayaran Kuliah Mahasiswa</title>
    <style>
        body { 
            font-family: 'Segoe UI', system-ui, sans-serif; 
            background-color: #f1f5f9; 
            margin: 15px; 
            font-size: 11px; 
            color: #334155;
        }
        .container { max-width: 1200px; margin: 0 auto; }
        h2 { 
            text-align: center; 
            color: #0f172a; 
            font-size: 16px; 
            margin: 10px 0 20px 0;
            font-weight: 600;
            text-transform: uppercase;
        }
        .section-title {
            font-size: 12px;
            font-weight: 600;
            margin: 20px 0 8px 0;
            padding-left: 8px;
            text-transform: uppercase;
        }
        .mandiri-title { border-left: 4px solid #0284c7; color: #0284c7; }
        .bidikmisi-title { border-left: 4px solid #16a34a; color: #16a34a; }
        .prestasi-title { border-left: 4px solid #d97706; color: #d97706; }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            background: white; 
            box-shadow: 0 1px 3px rgba(0,0,0,0.05); 
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 15px;
        }
        th, td { 
            padding: 5px 8px; 
            text-align: left; 
            border-bottom: 1px solid #e2e8f0; 
            line-height: 1.3;
        }
        th { 
            color: #f8fafc; 
            font-size: 11px; 
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .mandiri-table th { background-color: #0284c7; }
        .bidikmisi-table th { background-color: #16a34a; }
        .prestasi-table th { background-color: #d97706; }

        tr:hover { background-color: #f8fafc; }
        
        .badge { 
            padding: 1px 4px; 
            border-radius: 3px; 
            font-weight: bold; 
            font-size: 9px; 
            text-transform: uppercase; 
            display: inline-block;
        }
        .badge-man { background-color: #e0f2fe; color: #0369a1; }
        .badge-bm { background-color: #dcfce7; color: #15803d; }
        .badge-pres { background-color: #fef3c7; color: #b45309; }

        td strong { color: #0f172a; }
    </style>
</head>
<body>

<div class="container">
    <h2>REKAP REGISTRASI PEMBAYARAN UKT MAHASISWA - POLIMORFISME</h2>

    <div class="section-title mandiri-title">Kategori Pembiayaan: Mandiri</div>
    <table class="mandiri-table">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="12%">NIM</th>
                <th width="23%">Nama Mahasiswa</th>
                <th width="8%">Semester</th>
                <th width="15%">Tarif UKT Dasar</th>
                <th width="22%">Spesifikasi Akademik / Atribut Unik</th>
                <th width="15%">Total Tagihan Akhir (Overriding)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daftarMandiri as $mhs): ?>
                <tr>
                    <td><?= $mhs->getIdMahasiswa(); ?></td>
                    <td><strong><?= $mhs->getNim(); ?></strong></td>
                    <td><?= htmlspecialchars($mhs->getNamaMahasiswa()); ?></td>
                    <td>Sms <?= $mhs->getSemester(); ?></td>
                    <td>Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.'); ?></td>
                    <td><span class="badge badge-man">Mandiri</span></td>
                    <td><strong>Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.'); ?></strong> <small style="color:#0369a1;">(+100k prktk)</small></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="section-title bidikmisi-title">Kategori Pembiayaan: Bidikmisi / KIP-K</div>
    <table class="bidikmisi-table">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="12%">NIM</th>
                <th width="23%">Nama Mahasiswa</th>
                <th width="8%">Semester</th>
                <th width="15%">Tarif UKT Dasar</th>
                <th width="22%">Spesifikasi Akademik / Atribut Unik</th>
                <th width="15%">Total Tagihan Akhir (Overriding)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daftarBidikmisi as $mhs): ?>
                <tr>
                    <td><?= $mhs->getIdMahasiswa(); ?></td>
                    <td><strong><?= $mhs->getNim(); ?></strong></td>
                    <td><?= htmlspecialchars($mhs->getNamaMahasiswa()); ?></td>
                    <td>Sms <?= $mhs->getSemester(); ?></td>
                    <td>Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.'); ?></td>
                    <td><span class="badge badge-bm">Subsidi Negara</span></td>
                    <td><strong style="color: #16a34a;">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.'); ?></strong> <small style="color:#15803d; font-weight:bold;">(Gratis)</small></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="section-title prestasi-title">Kategori Pembiayaan: Beasiswa Prestasi</div>
    <table class="prestasi-table">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="12%">NIM</th>
                <th width="23%">Nama Mahasiswa</th>
                <th width="8%">Semester</th>
                <th width="15%">Tarif UKT Dasar</th>
                <th width="22%">Spesifikasi Akademik / Atribut Unik</th>
                <th width="15%">Total Tagihan Akhir (Overriding)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daftarPrestasi as $mhs): ?>
                <tr>
                    <td><?= $mhs->getIdMahasiswa(); ?></td>
                    <td><strong><?= $mhs->getNim(); ?></strong></td>
                    <td><?= htmlspecialchars($mhs->getNamaMahasiswa()); ?></td>
                    <td>Sms <?= $mhs->getSemester(); ?></td>
                    <td>Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.'); ?></td>
                    <td><span class="badge badge-pres">Beasiswa Instansi</span></td>
                    <td><strong>Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.'); ?></strong> <small style="color:#d97706; font-weight:bold;">(Cukup bayar 25%)</small></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>