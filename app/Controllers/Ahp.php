<?php

namespace App\Controllers;

use App\Models\SpkModel;

class Ahp extends BaseController
{
    public function index()
    {
        $model = new SpkModel();
        
        // 1. Ambil semua data mahasiswa
        $mahasiswa = $model->getAlternatif();
        $hasil_akhir = [];

// 2. Hitung nilai masing-masing
        foreach ($mahasiswa as $mhs) {
            $nilai_total = $model->getHitung($mhs['id_alternatif']);

            // LOGIKA BARU: Passing Grade 0.150 (Lebih Ketat)
            
            if ($nilai_total >= 0.300) {
                // Kategori 1: Prioritas Utama (Nilai Gede Banget)
                $status = 'SANGAT LAYAK (Prioritas)';
                $warna  = 'success'; // Hijau Tua
            
            } elseif ($nilai_total >= 0.150) {
                // Kategori 2: Layak (Nilai di atas 0.150 tapi dibawah 0.3)
                $status = 'LAYAK (Diterima)';
                $warna  = 'primary'; // Biru
            
            } else {
                // Kategori 3: Gagal (Di bawah 0.150)
                $status = 'TIDAK LAYAK';
                $warna  = 'danger'; // Merah
            }

            // ... simpan ke array hasil
            $hasil_akhir[] = [
                'nama'   => $mhs['nama'],
                'nim'    => $mhs['nim'],
                'nilai'  => $nilai_total,
                'status' => $status,
                'warna'  => $warna
            ];
        }

        // 4. Sorting: Urutkan dari Nilai Terbesar ke Terkecil (Ranking)
        usort($hasil_akhir, function($a, $b) {
            return $b['nilai'] <=> $a['nilai'];
        });

        // 5. Kirim data ke View
        $data['tabel_hasil'] = $hasil_akhir;
        return view('tampil_hasil', $data);
    }
    public function input()
    {
        $model = new SpkModel();

        // Kita kirim data pilihan dropdown ke View
        // Ingat ID Kriteria di database kita: 
        // 1=Pekerjaan, 2=Gaji, 3=Tanggungan, 4=Lokasi, 5=Hunian
        $data['opt_pekerjaan']  = $model->getSubKriteria(1);
        $data['opt_penghasilan']= $model->getSubKriteria(2);
        $data['opt_tanggungan'] = $model->getSubKriteria(3);
        $data['opt_lokasi']     = $model->getSubKriteria(4);
        $data['opt_hunian']     = $model->getSubKriteria(5);

        return view('form_input', $data);
    }

    public function simpan()
    {
        $model = new SpkModel();

        // 1. Simpan Data Diri Mahasiswa dulu ke tabel 'alternatif'
        $dataMhs = [
            'nama' => $this->request->getPost('nama'),
            'nim'  => $this->request->getPost('nim')
        ];
        $id_mhs_baru = $model->simpanAlternatif($dataMhs);

        // 2. Siapkan data penilaian dari form dropdown
        // Format array: [id_kriteria => id_sub_yang_dipilih]
        $pilihan = [
            1 => $this->request->getPost('id_sub_pekerjaan'),
            2 => $this->request->getPost('id_sub_penghasilan'),
            3 => $this->request->getPost('id_sub_tanggungan'),
            4 => $this->request->getPost('id_sub_lokasi'),
            5 => $this->request->getPost('id_sub_hunian'),
        ];

        // 3. Loop simpan ke tabel 'penilaian'
        foreach ($pilihan as $kriteria => $sub) {
            $dataNilai = [
                'id_alternatif' => $id_mhs_baru,
                'id_kriteria'   => $kriteria,
                'id_sub'        => $sub
            ];
            $model->simpanPenilaian($dataNilai);
        }

        // 4. Balikin ke halaman utama
        return redirect()->to('/');
    }
    // Halaman List Data Mahasiswa (Buat Admin)
    public function data_mahasiswa()
    {
        $model = new SpkModel();
        $data['mahasiswa'] = $model->getAlternatif();
        return view('view_data', $data);
    }

    // Proses Hapus Data
    public function hapus($id)
    {
        $model = new SpkModel();
        $model->hapusAlternatif($id);
        
        // Kasih notifikasi dan balik ke halaman data
        session()->setFlashdata('pesan', 'Data berhasil dihapus!');
        return redirect()->to('/data-mahasiswa');
    }

    // Halaman Form Edit (Mirip Input tapi isinya udah ada)
    public function edit($id)
    {
        $model = new SpkModel();
        
        // Ambil data dropdown buat pilihan
        $data['opt_pekerjaan']  = $model->getSubKriteria(1);
        $data['opt_penghasilan']= $model->getSubKriteria(2);
        $data['opt_tanggungan'] = $model->getSubKriteria(3);
        $data['opt_lokasi']     = $model->getSubKriteria(4);
        $data['opt_hunian']     = $model->getSubKriteria(5);

        // Ambil data si mahasiswa yang mau diedit
        $data_edit = $model->getDataEdit($id);
        $data['mhs'] = $data_edit['mhs'];      // Nama & NIM
        $data['nilai'] = $data_edit['nilai'];  // Pilihan dia sebelumnya (Array)

        return view('form_edit', $data);
    }

    // Proses Simpan Perubahan (Update)
    public function update()
    {
        $model = new SpkModel();
        $id_mhs = $this->request->getPost('id_alternatif');

        // 1. Update Data Diri
        $dataMhs = [
            'nama' => $this->request->getPost('nama'),
            'nim'  => $this->request->getPost('nim')
        ];
        $model->updateAlternatif($id_mhs, $dataMhs);

        // 2. Update Penilaian (Cara gampang: Hapus nilai lama, input nilai baru)
        // Hapus dulu nilai lama
        $db = \Config\Database::connect();
        $db->table('penilaian')->where('id_alternatif', $id_mhs)->delete();

        // Input nilai baru
        $pilihan = [
            1 => $this->request->getPost('id_sub_pekerjaan'),
            2 => $this->request->getPost('id_sub_penghasilan'),
            3 => $this->request->getPost('id_sub_tanggungan'),
            4 => $this->request->getPost('id_sub_lokasi'),
            5 => $this->request->getPost('id_sub_hunian'),
        ];

        foreach ($pilihan as $kriteria => $sub) {
            $dataNilai = [
                'id_alternatif' => $id_mhs,
                'id_kriteria'   => $kriteria,
                'id_sub'        => $sub
            ];
            $model->simpanPenilaian($dataNilai);
        }

        session()->setFlashdata('pesan', 'Data berhasil diperbarui!');
        return redirect()->to('/data-mahasiswa');
    }
    // 1. Halaman Lihat Data Kriteria
    public function data_kriteria()
    {
        $db = \Config\Database::connect();
        $data['kriteria'] = $db->table('kriteria')->get()->getResultArray();
        return view('view_kriteria', $data);
    }

    // 2. Halaman Lihat Data Sub Kriteria
    public function data_sub()
    {
        $db = \Config\Database::connect();
        // Join biar muncul nama kriterianya juga
        $data['sub'] = $db->table('sub_kriteria')
                          ->select('sub_kriteria.*, kriteria.nama_kriteria')
                          ->join('kriteria', 'kriteria.id_kriteria = sub_kriteria.id_kriteria')
                          ->orderBy('kriteria.id_kriteria', 'ASC')
                          ->orderBy('sub_kriteria.nilai', 'DESC')
                          ->get()->getResultArray();
        return view('view_sub', $data);
    }

    // 3. Halaman Penjelasan Metode AHP (Teori)
    public function info_metode()
    {
        return view('view_info');
    }

    // 4. Halaman PROSES PERHITUNGAN (RUMUS & MATRIKS)
public function proses_hitung()
    {
        // Pastikan Model dipanggil dengan benar
        $model = new \App\Models\SpkModel(); 
        $db = \Config\Database::connect();

        // 1. Ambil Data Kriteria
        $data['kriteria'] = $db->table('kriteria')->get()->getResultArray();
        
        // 2. Ambil Data Mahasiswa
        $data['mahasiswa'] = $model->getAlternatif(); 
        
        // 3. Ambil Detail Nilai (Biar gak error, kita cek dulu)
        $detail_nilai = [];
        if(!empty($data['mahasiswa'])) {
            foreach($data['mahasiswa'] as $mhs) {
                $nilai = $db->table('penilaian')
                            ->select('sub_kriteria.nilai, sub_kriteria.nama_sub, kriteria.nama_kriteria, kriteria.bobot')
                            ->join('sub_kriteria', 'sub_kriteria.id_sub = penilaian.id_sub')
                            ->join('kriteria', 'kriteria.id_kriteria = penilaian.id_kriteria') // JOIN KE KRITERIA JUGA
                            ->where('penilaian.id_alternatif', $mhs['id_alternatif'])
                            ->get()->getResultArray();
                $detail_nilai[$mhs['id_alternatif']] = $nilai;
            }
        }
        $data['detail'] = $detail_nilai;

        return view('view_proses', $data);
    }
}