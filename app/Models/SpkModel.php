<?php

namespace App\Models;

use CodeIgniter\Model;

class SpkModel extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // Fungsi 1: Ambil semua data mahasiswa (Parman, Neneng, dkk)
    public function getAlternatif()
    {
        return $this->db->table('alternatif')->get()->getResultArray();
    }

    // Fungsi 2: RUMUS SAKTI AHP (Hitung Skor)
    // Mengalikan Bobot Kriteria * Nilai Sub Kriteria pilihan mahasiswa
    public function getHitung($id_alternatif)
    {
        $query = $this->db->table('penilaian')
            ->select('SUM(kriteria.bobot * sub_kriteria.nilai) as total_nilai')
            ->join('kriteria', 'kriteria.id_kriteria = penilaian.id_kriteria')
            ->join('sub_kriteria', 'sub_kriteria.id_sub = penilaian.id_sub')
            ->where('penilaian.id_alternatif', $id_alternatif)
            ->get();
        
        $hasil = $query->getRow()->total_nilai;
        
        // Kalau belum ada nilai, anggap 0 biar gak error
        return ($hasil == null) ? 0 : $hasil;
    }
    // Fungsi Baru: Ambil Sub Kriteria berdasarkan ID Kriteria
    // Contoh: getSub(1) akan mengambil semua pilihan untuk "Pekerjaan"
    public function getSubKriteria($id_kriteria)
    {
        return $this->db->table('sub_kriteria')
            ->where('id_kriteria', $id_kriteria)
            ->get()
            ->getResultArray();
    }

    // Fungsi Baru: Simpan Data Mahasiswa
    public function simpanAlternatif($data)
    {
        $this->db->table('alternatif')->insert($data);
        return $this->db->insertID(); // Kembalikan ID mahasiswa baru (buat dipake di tabel penilaian)
    }

    // Fungsi Baru: Simpan Penilaian
    public function simpanPenilaian($data)
    {
        $this->db->table('penilaian')->insert($data);
    }
    // Ambil 1 data mahasiswa beserta nilai pilihannya (JOIN) buat diedit
    public function getDataEdit($id_mhs)
    {
        // Ambil data diri
        $mhs = $this->db->table('alternatif')->where('id_alternatif', $id_alternatif)->get()->getRowArray();
        
        // Ambil penilaian dia (Pekerjaan, Gaji, dll yang udah dipilih)
        $nilai = $this->db->table('penilaian')
                          ->where('id_alternatif', $id_alternatif)
                          ->get()->getResultArray();

        // Rapikan penilaian jadi array [id_kriteria => id_sub] biar gampang dipanggil di form
        $list_nilai = [];
        foreach($nilai as $n) {
            $list_nilai[$n['id_kriteria']] = $n['id_sub'];
        }

        return ['mhs' => $mhs, 'nilai' => $list_nilai];
    }

    // Fungsi Update Data
    public function updateAlternatif($id, $data)
    {
        return $this->db->table('alternatif')->where('id_alternatif', $id)->update($data);
    }

    // Fungsi Hapus Data (Hapus Mahasiswa + Penilaiannya sekaligus)
    public function hapusAlternatif($id)
    {
        // 1. Hapus penilaian dulu (Anaknya)
        $this->db->table('penilaian')->where('id_alternatif', $id)->delete();
        // 2. Baru hapus orangnya (Induknya)
        $this->db->table('alternatif')->where('id_alternatif', $id)->delete();
    }
}