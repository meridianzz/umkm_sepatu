<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rute halaman utama untuk pengguna (user) dengan filter 'auth'
$routes->get('/', 'Home::login');
$routes->get('/beranda', 'User::index');
$routes->get('profil', 'User::profil',['filter' => 'authUser']);
$routes->post('/user/updateProfil', 'User::updateProfil',['filter' => 'authUser']);
$routes->get('/register', 'Home::register');
$routes->post('/registerproses', 'User::registerproses');
$routes->get('/verify-otp/(:num)', 'User::verifyOtp/$1');
$routes->post('/verify-otp-process', 'User::verifyOtpProcess');
$routes->get('/resend-otp/(:num)', 'User::resendOtp/$1');
$routes->get('/produk', 'Home::produk');
$routes->get('/produk/getUkuran/(:segment)', 'Home::getUkuran/$1');
$routes->get('/produk/getKodeBarang', 'Home::getKodeBarang');
$routes->get('/keranjang', 'Keranjang::viewCart',['filter' => 'authUser']);
$routes->post('/keranjang/add', 'Keranjang::addToCart');
$routes->post('/keranjang/editCart/(:num)', 'Keranjang::editCart/$1',['filter' => 'authUser']);
$routes->get('/keranjang/getUkuran/(:any)', 'Keranjang::getUkuran/$1');
$routes->delete('/keranjang/removeFromCart/(:num)', 'Keranjang::removeFromCart/$1',['filter' => 'authUser']);
$routes->get('/pesanan', 'Checkout::pesanan',['filter' => 'authUser']);
$routes->get('/pesanan/getBuktiBayar/(:num)', 'Checkout::getBuktiBayar/$1',['filter' => 'authUser']);
$routes->post('/checkout/process', 'Checkout::process');
$routes->get('/checkout/konfirmasi/(:num)', 'Checkout::konfirmasi/$1');
$routes->post('/checkout/uploadBukti', 'Checkout::uploadBukti');


$routes->post('/login', 'User::login');
$routes->get('/logout', 'User::logout');

// Rute login admin
$routes->get('admin', 'Admin::index');  // Menampilkan halaman login
$routes->post('/prosesadm', 'Admin::login');  // Proses login admin
$routes->get('/logoutadm', 'Admin::logout');    // Proses logout admin


// Rute admin dengan filter
$routes->get('/dbadmin', 'Admin::halamanAdmin',['filter' => 'authAdmin']);
$routes->get('/barang', 'Barang::index',['filter' => 'authAdmin']);
$routes->get('/barang/create', 'Barang::create',['filter' => 'authAdmin']);
$routes->post('/barang/store', 'Barang::store',['filter' => 'authAdmin']);
$routes->post('/barang/update/(:num)', 'Barang::update/$1',['filter' => 'authAdmin']);
$routes->get('/barang/delete/(:segment)', 'Barang::delete/$1',['filter' => 'authAdmin']);


// Rute user (beranda hanya untuk user login)
$routes->get('/beranda', 'UserController::index');


$routes->get('/datasepatu', 'Home::kelola_data_sepatu');


$routes->get('/supplier', 'Supplier::index');
$routes->get('/supplier/create', 'Supplier::create');
$routes->post('/supplier/store', 'Supplier::store');
$routes->get('/supplier/edit/(:num)', 'Supplier::edit/$1');
$routes->post('/supplier/update/(:num)', 'Supplier::update/$1');
$routes->get('/supplier/delete/(:num)', 'Supplier::delete/$1');

$routes->get('/datapelanggan', 'Pelanggan::index',['filter' => 'authAdmin']);
$routes->post('/datapelanggan/store', 'Pelanggan::store',['filter' => 'authAdmin']);
$routes->post('/datapelanggan/update/(:num)', 'Pelanggan::update/$1',['filter' => 'authAdmin']);
$routes->post('/datapelanggan/delete/(:num)', 'Pelanggan::delete/$1',['filter' => 'authAdmin']);

$routes->get('/kategori', 'Kategori::index',['filter' => 'authAdmin']);
$routes->post('/kategori/store', 'Kategori::store',['filter' => 'authAdmin']);
$routes->get('/kategori/edit/(:num)', 'Kategori::edit/$1',['filter' => 'authAdmin']);
$routes->post('/kategori/update', 'Kategori::update',['filter' => 'authAdmin']);
$routes->get('/kategori/delete/(:num)', 'Kategori::delete/$1',['filter' => 'authAdmin']);

$routes->get('/datapenjualan', 'Admin::penjualan',['filter' => 'authAdmin']);
$routes->get('/admin/penjualan/detail/(:num)', 'Admin::detailPenjualan/$1',['filter' => 'authAdmin']);
$routes->post('/admin/penjualan/update_status/(:num)', 'Admin::update_status/$1',['filter' => 'authAdmin']);

