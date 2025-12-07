<?= $this->extend('layout_admin') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h3 class="fw-bold text-dark mb-4">Data Sub Kriteria (Rating Scale)</h3>
    
    <div class="card card-custom">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Kriteria Induk</th>
                        <th>Nama Sub Kriteria / Kondisi</th>
                        <th>Nilai Rating (AHP)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $curr_kriteria = '';
                    foreach($sub as $row): 
                    ?>
                    <tr>
                        <?php if($curr_kriteria != $row['nama_kriteria']): ?>
                            <td class="fw-bold bg-light" rowspan="5"><?= $row['nama_kriteria'] ?></td>
                            <?php $curr_kriteria = $row['nama_kriteria']; ?>
                        <?php endif; ?>
                        
                        <td><?= $row['nama_sub'] ?></td>
                        <td class="fw-bold text-center"><?= number_format($row['nilai'], 3) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>