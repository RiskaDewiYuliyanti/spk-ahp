<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?= include('layout_menu.php'); ?>

<div class="container mb-5">
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h4>Edit Data: <?= $mhs['nama'] ?></h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('/update') ?>" method="post">
                <input type="hidden" name="id_alternatif" value="<?= $mhs['id_alternatif'] ?>">

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= $mhs['nama'] ?>" required>
                </div>
                <div class="mb-3">
                    <label>NIM</label>
                    <input type="text" name="nim" class="form-control" value="<?= $mhs['nim'] ?>" required>
                </div>
                <hr>

                <div class="mb-3">
                    <label>Pekerjaan Orang Tua</label>
                    <select name="id_sub_pekerjaan" class="form-select" required>
                        <?php foreach($opt_pekerjaan as $row): ?>
                            <option value="<?= $row['id_sub'] ?>" <?= ($nilai[1] == $row['id_sub']) ? 'selected' : '' ?>>
                                <?= $row['nama_sub'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Penghasilan</label>
                    <select name="id_sub_penghasilan" class="form-select" required>
                        <?php foreach($opt_penghasilan as $row): ?>
                            <option value="<?= $row['id_sub'] ?>" <?= ($nilai[2] == $row['id_sub']) ? 'selected' : '' ?>>
                                <?= $row['nama_sub'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label>Tanggungan</label>
                    <select name="id_sub_tanggungan" class="form-select" required>
                        <?php foreach($opt_tanggungan as $row): ?>
                            <option value="<?= $row['id_sub'] ?>" <?= ($nilai[3] == $row['id_sub']) ? 'selected' : '' ?>>
                                <?= $row['nama_sub'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                 <div class="mb-3">
                    <label>Lokasi</label>
                    <select name="id_sub_lokasi" class="form-select" required>
                        <?php foreach($opt_lokasi as $row): ?>
                            <option value="<?= $row['id_sub'] ?>" <?= ($nilai[4] == $row['id_sub']) ? 'selected' : '' ?>>
                                <?= $row['nama_sub'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                 <div class="mb-3">
                    <label>Hunian</label>
                    <select name="id_sub_hunian" class="form-select" required>
                        <?php foreach($opt_hunian as $row): ?>
                            <option value="<?= $row['id_sub'] ?>" <?= ($nilai[5] == $row['id_sub']) ? 'selected' : '' ?>>
                                <?= $row['nama_sub'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="<?= base_url('/data-mahasiswa') ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>