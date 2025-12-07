<?= $this->extend('layout_admin') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h3 class="fw-bold text-dark mb-4">Data Kriteria & Bobot</h3>
    
    <div class="card card-custom">
        <div class="card-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Bobot ini didapatkan dari hasil perhitungan Matriks Perbandingan Berpasangan AHP.
            </div>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot Prioritas (Vector)</th>
                        <th>Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($kriteria as $row): ?>
                    <tr>
                        <td class="fw-bold text-center"><?= $row['kode'] ?></td>
                        <td><?= $row['nama_kriteria'] ?></td>
                        <td class="fw-bold text-primary"><?= $row['bobot'] ?></td>
                        <td><?= round($row['bobot'] * 100, 2) ?>%</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>