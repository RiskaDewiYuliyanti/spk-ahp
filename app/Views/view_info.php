<?= $this->extend('layout_admin') ?>

<?= $this->section('content') ?>

<style>
    /* CSS KHUSUS UNTUK DIAGRAM HIRARKI */
    .hierarchy-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        border: 1px solid #e3e6f0;
        overflow-x: auto; /* Biar bisa discroll kalau layar kecil */
    }

    .level-box {
        background: white;
        border: 2px solid #4e73df;
        border-radius: 8px;
        padding: 10px 20px;
        text-align: center;
        font-weight: bold;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        position: relative;
        z-index: 2;
        min-width: 150px;
    }

    .level-goal { background: #4e73df; color: white; border-color: #224abe; width: 300px; }
    .level-kriteria { background: #1cc88a; color: white; border-color: #169b6b; font-size: 0.9rem; }
    .level-sub { background: #f6c23e; color: black; border-color: #dda20a; font-size: 0.8rem; text-align: left; }
    .level-alternatif { background: #36b9cc; color: white; border-color: #258391; width: 80%; }

    /* GARIS PENGHUBUNG (CONNECTOR) */
    .line-vertical {
        width: 2px;
        background-color: #858796;
        height: 30px;
        margin: 0 auto;
    }

    .line-horizontal-container {
        display: flex;
        justify-content: center;
        width: 100%;
        position: relative;
        height: 20px;
    }

    .line-horizontal {
        height: 2px;
        background-color: #858796;
        width: 80%; /* Lebar garis horizontal penghubung kriteria */
        position: absolute;
        top: 0;
    }

    .branch-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        width: 100%;
        margin-top: -2px; /* Nempel ke garis horizontal */
    }

    .branch {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
    }

    .arrow-down {
        color: #858796;
        font-size: 14px;
        margin-bottom: 5px;
    }
</style>

<div class="container-fluid">
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="mb-0 text-gray-800 fw-bold">Penjelasan Metode AHP</h3>
        <span class="badge bg-primary fs-6">Referensi: Thomas L. Saaty</span>
    </div>

    <div class="row mb-5">
        
        <div class="col-lg-8">
            <div class="card card-custom shadow h-100">
                <div class="card-header py-3 bg-white border-bottom">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-book-open me-2"></i> Konsep Dasar AHP</h6>
                </div>
                <div class="card-body">
                    <p class="text-justify">
                        <strong>Analytic Hierarchy Process (AHP)</strong> adalah metode pengambilan keputusan multikriteria yang dikembangkan oleh <strong>Prof. Thomas L. Saaty</strong>. AHP memecah masalah kompleks menjadi struktur hierarki: <strong>Goal (Tujuan)</strong>, <strong>Criteria (Kriteria)</strong>, <strong>Sub-Criteria</strong>, dan <strong>Alternatives (Alternatif)</strong>.
                    </p>
                    
                    <h6 class="fw-bold text-dark mt-3">Algoritma Perhitungan:</h6>
                    <ol class="small">
                        <li>Menyusun Hierarki Masalah.</li>
                        <li>Membuat Matriks Perbandingan Berpasangan (Pairwise Comparison).</li>
                        <li>Menghitung Nilai Eigen (Bobot Prioritas).</li>
                        <li>Uji Konsistensi (Consistency Ratio / CR < 0.1).</li>
                        <li>Perankingan Alternatif berdasarkan bobot global.</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-custom shadow h-100">
                <div class="card-header py-3 bg-dark text-white">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-table me-2"></i> Skala Saaty (1-9)</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-sm mb-0 text-center small">
                        <thead class="table-secondary">
                            <tr><th>Nilai</th><th>Keterangan</th></tr>
                        </thead>
                        <tbody>
                            <tr><td class="fw-bold">1</td><td>Sama Penting</td></tr>
                            <tr><td class="fw-bold">3</td><td>Sedikit Lebih Penting</td></tr>
                            <tr><td class="fw-bold">5</td><td>Lebih Penting</td></tr>
                            <tr><td class="fw-bold">7</td><td>Sangat Penting</td></tr>
                            <tr><td class="fw-bold">9</td><td>Mutlak Lebih Penting</td></tr>
                            <tr><td class="fw-bold">2,4,6,8</td><td>Nilai Antara</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="card card-custom shadow mb-4 border-left-info">
        <div class="card-header py-3 bg-info text-white">
            <h5 class="m-0 font-weight-bold"><i class="fas fa-sitemap me-2"></i> Hierarki Studi Kasus: Politeknik Jatiluhur</h5>
        </div>
        <div class="card-body">
            
            <div class="hierarchy-container">
                
                <div class="level-box level-goal">
                    GOAL:<br>Prioritas Penerima Beasiswa KIP-K
                </div>
                
                <div class="line-vertical"></div>
                <i class="fas fa-chevron-down arrow-down"></i>

                <div class="line-horizontal-container">
                    <div class="line-horizontal"></div>
                </div>

                <div class="branch-container">
                    
                    <div class="branch">
                        <div class="line-vertical" style="height: 15px;"></div>
                        <div class="level-box level-kriteria">
                            C1: Pekerjaan<br><small>(Bobot: 0.229)</small>
                        </div>
                        <div class="line-vertical" style="height: 15px;"></div>
                        <i class="fas fa-chevron-down arrow-down"></i>
                        
                        <div class="level-box level-sub">
                            <ul class="ps-3 mb-0">
                                <li>Pengangguran</li>
                                <li>Buruh/Petani</li>
                                <li>Sopir/Pedagang</li>
                                <li>Wiraswasta</li>
                                <li>PNS/Pejabat</li>
                            </ul>
                        </div>
                    </div>

                    <div class="branch">
                        <div class="line-vertical" style="height: 15px;"></div>
                        <div class="level-box level-kriteria">
                            C2: Penghasilan<br><small>(Bobot: 0.484)</small>
                        </div>
                        <div class="line-vertical" style="height: 15px;"></div>
                        <i class="fas fa-chevron-down arrow-down"></i>

                        <div class="level-box level-sub">
                            <ul class="ps-3 mb-0">
                                <li>< 1 Juta</li>
                                <li>1 - 1.5 Juta</li>
                                <li>1.5 - 2 Juta</li>
                                <li>2 - 3 Juta</li>
                                <li>> 4 Juta</li>
                            </ul>
                        </div>
                    </div>

                    <div class="branch">
                        <div class="line-vertical" style="height: 15px;"></div>
                        <div class="level-box level-kriteria">
                            C3: Tanggungan<br><small>(Bobot: 0.095)</small>
                        </div>
                        <div class="line-vertical" style="height: 15px;"></div>
                        <i class="fas fa-chevron-down arrow-down"></i>

                        <div class="level-box level-sub">
                            <ul class="ps-3 mb-0">
                                <li>> 5 Anak</li>
                                <li>4 - 5 Anak</li>
                                <li>3 Anak</li>
                                <li>1 - 2 Anak</li>
                                <li>Tunggal/Nihil</li>
                            </ul>
                        </div>
                    </div>

                    <div class="branch">
                        <div class="line-vertical" style="height: 15px;"></div>
                        <div class="level-box level-kriteria">
                            C4: Lokasi<br><small>(Bobot: 0.045)</small>
                        </div>
                        <div class="line-vertical" style="height: 15px;"></div>
                        <i class="fas fa-chevron-down arrow-down"></i>

                        <div class="level-box level-sub">
                            <ul class="ps-3 mb-0">
                                <li>Daerah 3T</li>
                                <li>Desa Terpencil</li>
                                <li>Luar Kota</li>
                                <li>Pinggiran</li>
                                <li>Dalam Kota</li>
                            </ul>
                        </div>
                    </div>

                    <div class="branch">
                        <div class="line-vertical" style="height: 15px;"></div>
                        <div class="level-box level-kriteria">
                            C5: Hunian<br><small>(Bobot: 0.147)</small>
                        </div>
                        <div class="line-vertical" style="height: 15px;"></div>
                        <i class="fas fa-chevron-down arrow-down"></i>

                        <div class="level-box level-sub">
                            <ul class="ps-3 mb-0">
                                <li>Menumpang</li>
                                <li>Sewa/Kontrak</li>
                                <li>Milik Sendiri (RSS)</li>
                                <li>Milik Sendiri (Std)</li>
                                <li>Milik Sendiri (Mewah)</li>
                            </ul>
                        </div>
                    </div>

                </div> <div class="d-flex justify-content-center w-100 mt-3">
                    <i class="fas fa-chevron-down arrow-down"></i>
                </div>
                <div class="line-vertical" style="height: 20px;"></div>

                <div class="level-box level-alternatif">
                    ALTERNATIF MAHASISWA<br>
                    <small class="fw-normal">(Parman, Neneng, Indah, Nanto, Sukitman, Layla, dll)</small>
                </div>
            </div>
        </div>
    </div>
<div class="row">
        <div class="col-12">
            <div class="card card-custom shadow mb-4 border-left-warning">
                <div class="card-header py-3 bg-warning text-dark">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-square-root-alt me-2"></i> Model Matematis Perhitungan</h6>
                </div>
                <div class="card-body bg-light">
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h6 class="fw-bold text-primary">1. Normalisasi Matriks</h6>
                                    <p class="small text-muted">Setiap nilai baris dibagi dengan total nilai kolom yang bersangkutan.</p>
                                    <div class="bg-dark text-white p-3 rounded text-center font-monospace">
                                        r<sub>ij</sub> = a<sub>ij</sub> / Σ a<sub>ij</sub>
                                    </div>
                                    <small class="fst-italic text-secondary d-block mt-2">
                                        *Dimana a<sub>ij</sub> adalah nilai perbandingan, dan Σ a<sub>ij</sub> adalah total kolom.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h6 class="fw-bold text-primary">2. Menghitung Bobot (Eigen Vector)</h6>
                                    <p class="small text-muted">Rata-rata dari baris matriks yang telah dinormalisasi.</p>
                                    <div class="bg-dark text-white p-3 rounded text-center font-monospace">
                                        W<sub>i</sub> = (Σ r<sub>ij</sub>) / n
                                    </div>
                                    <small class="fst-italic text-secondary d-block mt-2">
                                        *Dimana n adalah jumlah kriteria (5). Hasil ini adalah Bobot Prioritas (%).
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h6 class="fw-bold text-danger">3. Uji Konsistensi (CR)</h6>
                                    <p class="small text-muted">Menentukan validitas jawaban kuesioner/matriks.</p>
                                    
                                    <ul class="list-group list-group-flush small">
                                        <li class="list-group-item">
                                            <strong>Langkah A (Lambda Max):</strong><br>
                                            <code>λ<sub>max</sub> = Σ (Total Kolom × Bobot Kriteria)</code>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Langkah B (Consistency Index):</strong><br>
                                            <code>CI = (λ<sub>max</sub> - n) / (n - 1)</code>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Langkah C (Consistency Ratio):</strong><br>
                                            <code>CR = CI / IR</code>
                                            <br><span class="text-danger fw-bold">*Syarat Valid: CR < 0.1</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h6 class="fw-bold text-success">4. Ranking (Metode Rating Scale)</h6>
                                    <p class="small text-muted">Perhitungan akhir untuk menentukan kelayakan mahasiswa.</p>
                                    <div class="bg-dark text-white p-3 rounded text-center font-monospace mb-2">
                                        S = Σ (W<sub>j</sub> × x<sub>ij</sub>)
                                    </div>
                                    <p class="small text-secondary mb-0">Keterangan:</p>
                                    <ul class="small text-muted">
                                        <li><strong>S</strong> = Skor Akhir Mahasiswa</li>
                                        <li><strong>W<sub>j</sub></strong> = Bobot Kriteria (Gaji, Pekerjaan, dll)</li>
                                        <li><strong>x<sub>ij</sub></strong> = Nilai Rating Sub-Kriteria (0.503, 0.260, dst)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="alert alert-secondary mb-0">
                                <h6 class="fw-bold mb-2"><i class="fas fa-table me-2"></i> Tabel Index Random (IR) Saaty</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm text-center mb-0 bg-white">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>n (Jumlah Kriteria)</th>
                                                <th>1</th><th>2</th><th>3</th><th>4</th>
                                                <th class="bg-warning text-dark border border-dark">5</th>
                                                <th>6</th><th>7</th><th>8</th><th>9</th><th>10</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="fw-bold">Nilai IR</td>
                                                <td>0.00</td><td>0.00</td><td>0.58</td><td>0.90</td>
                                                <td class="fw-bold bg-warning text-dark border border-dark">1.12</td>
                                                <td>1.24</td><td>1.32</td><td>1.41</td><td>1.45</td><td>1.49</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <small class="text-muted mt-2 d-block">*Karena studi kasus ini menggunakan <strong>5 Kriteria</strong>, maka nilai IR yang digunakan adalah <strong>1.12</strong>.</small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>