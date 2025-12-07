<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Ahp::index');
$routes->get('/input', 'Ahp::input');
$routes->post('/simpan', 'Ahp::simpan');

// Rute Baru
$routes->get('/data-mahasiswa', 'Ahp::data_mahasiswa'); // Halaman tabel admin
$routes->get('/hapus/(:num)', 'Ahp::hapus/$1');        // Proses hapus
$routes->get('/edit/(:num)', 'Ahp::edit/$1');          // Halaman edit
$routes->post('/update', 'Ahp::update');               // Proses update

// Tambahkan di bawah routes yang sudah ada
$routes->get('/data-kriteria', 'Ahp::data_kriteria');
$routes->get('/data-sub', 'Ahp::data_sub');
$routes->get('/info-metode', 'Ahp::info_metode');
$routes->get('/proses-hitung', 'Ahp::proses_hitung');