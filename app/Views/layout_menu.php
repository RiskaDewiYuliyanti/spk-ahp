<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= base_url('/') ?>">SPK KIP KULIAH</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('/') ?>">Dashboard & Hasil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('/data-mahasiswa') ?>">Data Mahasiswa (Edit/Hapus)</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-warning text-dark ms-2 fw-bold" href="<?= base_url('/input') ?>">+ Tambah Baru</a>
        </li>
      </ul>
    </div>
  </div>
</nav>