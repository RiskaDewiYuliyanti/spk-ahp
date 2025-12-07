<?= $this->extend('layout_admin') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="mb-0 text-gray-800 fw-bold">Kelola Data Alternatif (Mahasiswa)</h3>
        <a href="<?= base_url('/input') ?>" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Baru
        </a>
    </div>

    <div class="card card-custom shadow mb-4">
        <div class="card-header py-3 bg-white border-bottom">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Mahasiswa Terdaftar</h6>
        </div>
        <div class="card-body">
            
            <?php if(session()->getFlashdata('pesan')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-1"></i> <?= session()->getFlashdata('pesan') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Lengkap</th>
                            <th>NIM</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($mahasiswa as $row): ?>
                        <tr>
                            <td class="text-center fw-bold"><?= $no++ ?></td>
                            <td><?= esc($row['nama']) ?></td>
                            <td class="text-center"><?= esc($row['nim']) ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('/edit/'.$row['id_alternatif']) ?>" class="btn btn-sm btn-info text-white shadow-sm me-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?= base_url('/hapus/'.$row['id_alternatif']) ?>" 
                                   class="btn btn-sm btn-danger shadow-sm"
                                   onclick="return confirm('Yakin mau hapus data <?= $row['nama'] ?>? Data tidak bisa kembali!')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($mahasiswa)): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted fst-italic py-4">
                                Belum ada data mahasiswa. Silakan input data baru.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>