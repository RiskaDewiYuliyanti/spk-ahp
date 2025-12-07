<?= $this->extend('layout_admin') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="mb-0 text-gray-800 fw-bold">Dashboard Hasil Seleksi</h3>
        <a href="<?= base_url('/input') ?>" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Mahasiswa
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-custom border-left-primary h-100 py-2 bg-white">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Mahasiswa</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= count($tabel_hasil) ?> Orang</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-custom border-left-success h-100 py-2 bg-success text-white">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Status LOLOS</div>
                            <div class="h3 mb-0 font-weight-bold">
                                <?php 
                                $lolos = 0;
                                foreach($tabel_hasil as $x) if($x['nilai'] >= 0.1) $lolos++;
                                echo $lolos;
                                ?> Orang
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-custom border-left-danger h-100 py-2 bg-danger text-white">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Status GAGAL</div>
                            <div class="h3 mb-0 font-weight-bold">
                                <?= count($tabel_hasil) - $lolos ?> Orang
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-custom bg-white">
        <div class="card-header py-3 bg-white border-bottom">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Perangkingan AHP</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>Rank</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Nilai Akhir</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($tabel_hasil as $row): ?>
                        <tr>
                            <td class="fw-bold">#<?= $no++ ?></td>
                            <td class="fw-bold"><?= $row['nama'] ?></td>
                            <td><?= $row['nim'] ?></td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <?= ($row['nilai'] == 0) ? '0.000' : number_format($row['nilai'], 4) ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-<?= $row['warna'] ?> rounded-pill px-3">
                                    <?= $row['status'] ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>