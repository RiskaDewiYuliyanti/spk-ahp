<?= $this->extend('layout_admin') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h3 class="fw-bold text-dark mb-4">Proses & Detail Perhitungan</h3>

    <div class="card card-custom mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">1. Matriks Perbandingan Berpasangan (Kriteria)</h5>
        </div>
        <div class="card-body">
            <p>Tabel ini menunjukkan bagaimana bobot kriteria diperoleh (Sesuai perhitungan manual Excel).</p>
            <div class="table-responsive">
                <table class="table table-bordered text-center table-sm" style="font-size: 0.9rem;">
                    <thead class="table-light">
                        <tr>
                            <th>Kriteria</th>
                            <th>C1 (Kerja)</th>
                            <th>C2 (Gaji)</th>
                            <th>C3 (Anak)</th>
                            <th>C4 (Lokasi)</th>
                            <th>C5 (Hunian)</th>
                            <th class="bg-warning text-dark">Bobot Hasil (Eigen)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><th>C1</th><td>1</td><td>0.33</td><td>3</td><td>5</td><td>2</td><td class="fw-bold bg-warning text-dark">0.229</td></tr>
                        <tr><th>C2</th><td>3</td><td>1</td><td>5</td><td>7</td><td>4</td><td class="fw-bold bg-warning text-dark">0.484</td></tr>
                        <tr><th>C3</th><td>0.33</td><td>0.20</td><td>1</td><td>3</td><td>0.50</td><td class="fw-bold bg-warning text-dark">0.095</td></tr>
                        <tr><th>C4</th><td>0.20</td><td>0.14</td><td>0.33</td><td>1</td><td>0.25</td><td class="fw-bold bg-warning text-dark">0.045</td></tr>
                        <tr><th>C5</th><td>0.50</td><td>0.25</td><td>2</td><td>4</td><td>1</td><td class="fw-bold bg-warning text-dark">0.147</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card card-custom">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">2. Detail Perhitungan Skor Akhir</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-secondary">
                Rumus: <strong>∑ (Bobot Kriteria × Nilai Sub Kriteria Pilihan)</strong>
            </div>

            <?php foreach($mahasiswa as $mhs): ?>
                <div class="border rounded p-3 mb-3 bg-light">
                    <h5 class="fw-bold text-primary mb-3">
                        <i class="fas fa-user"></i> <?= $mhs['nama'] ?> (<?= $mhs['nim'] ?>)
                    </h5>
                    
                    <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr class="table-secondary">
                                <th>Kriteria</th>
                                <th>Pilihan Kondisi</th>
                                <th>Nilai Sub (A)</th>
                                <th>Bobot Kriteria (B)</th>
                                <th>Hasil (A × B)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total_skor = 0;
                            // Cek apakah mahasiswa ini sudah dinilai
                            if(isset($detail[$mhs['id_alternatif']])):
                                foreach($detail[$mhs['id_alternatif']] as $d): 
                                    $sub_skor = $d['nilai'] * $d['bobot'];
                                    $total_skor += $sub_skor;
                            ?>
                            <tr>
                                <td><?= $d['nama_kriteria'] ?></td>
                                <td><?= $d['nama_sub'] ?></td>
                                <td class="text-center"><?= $d['nilai'] ?></td>
                                <td class="text-center"><?= $d['bobot'] ?></td>
                                <td class="text-center fw-bold"><?= number_format($sub_skor, 4) ?></td>
                            </tr>
                            <?php endforeach; endif; ?>
                            <tr class="table-dark">
                                <td colspan="4" class="text-end fw-bold">TOTAL SKOR AKHIR:</td>
                                <td class="text-center fw-bold text-warning"><?= number_format($total_skor, 4) ?></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>

<?= $this->endSection() ?>