<?= $this->extend('layout_admin') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="mb-0 text-gray-800 fw-bold">Input Data Mahasiswa</h3>
        <a href="<?= base_url('/data-mahasiswa') ?>" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card card-custom shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold"><i class="fas fa-user-plus me-2"></i> Form Seleksi KIP Kuliah</h6>
        </div>
        <div class="card-body">
            
            <form action="<?= base_url('/simpan') ?>" method="post">
                
                <h5 class="text-primary fw-bold mb-3 border-bottom pb-2"><i class="fas fa-id-card me-2"></i> A. Data Diri Mahasiswa</h5>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="fw-bold text-dark">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required placeholder="Masukkan Nama Lengkap...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="fw-bold text-dark">NIM</label>
                            <input type="text" name="nim" class="form-control" required placeholder="Masukkan NIM...">
                        </div>
                    </div>
                </div>

                <h5 class="text-success fw-bold mb-3 border-bottom pb-2"><i class="fas fa-chart-bar me-2"></i> B. Data Ekonomi & Kondisi (Kriteria AHP)</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">1. Pekerjaan Orang Tua</label>
                        <select name="id_sub_pekerjaan" class="form-select" required>
                            <option value="">-- Pilih Pekerjaan --</option>
                            <?php foreach($opt_pekerjaan as $row): ?>
                                <option value="<?= $row['id_sub'] ?>"><?= $row['nama_sub'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">2. Penghasilan Orang Tua</label>
                        <select name="id_sub_penghasilan" class="form-select" required>
                            <option value="">-- Pilih Rentang Gaji --</option>
                            <?php foreach($opt_penghasilan as $row): ?>
                                <option value="<?= $row['id_sub'] ?>"><?= $row['nama_sub'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">3. Jumlah Tanggungan</label>
                        <select name="id_sub_tanggungan" class="form-select" required>
                            <option value="">-- Pilih Jumlah Anak --</option>
                            <?php foreach($opt_tanggungan as $row): ?>
                                <option value="<?= $row['id_sub'] ?>"><?= $row['nama_sub'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">4. Lokasi Tempat Tinggal</label>
                        <select name="id_sub_lokasi" class="form-select" required>
                            <option value="">-- Pilih Lokasi --</option>
                            <?php foreach($opt_lokasi as $row): ?>
                                <option value="<?= $row['id_sub'] ?>"><?= $row['nama_sub'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">5. Kondisi Hunian</label>
                        <select name="id_sub_hunian" class="form-select" required>
                            <option value="">-- Pilih Kondisi Rumah --</option>
                            <?php foreach($opt_hunian as $row): ?>
                                <option value="<?= $row['id_sub'] ?>"><?= $row['nama_sub'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                        <i class="fas fa-calculator me-2"></i> SIMPAN & HITUNG AHP
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>