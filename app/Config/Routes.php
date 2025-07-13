<?php

namespace Config;
// Create a new instance of our RouteCollection class.
$routes = Services::routes();
/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// AUTH ROUTES
// This is where you define your routes for the application.
$routes->get('/', 'Home::index');
$routes->get('registration', 'Auth\Registration::index');
$routes->post('registration/store', 'Auth\Registration::store');
$routes->get('email-verification', 'Auth\EmailVerification::verifyEmailRegistration');
$routes->get('email-verification/resend', 'Auth\EmailVerification::viewResendEmailVerification');
$routes->post('email-verification/resend', 'Auth\EmailVerification::resendEmailVerification');
$routes->get('login', 'Auth\Login::index');
$routes->post('login/authenticate', 'Auth\Login::authenticate');
$routes->get('logout', 'Auth\Logout::index');
$routes->post('logout', 'Auth\Logout::index');
$routes->get('forgot-password', 'Auth\ForgotPassword::index');
$routes->post('forgot-password/reset-password', 'Auth\ForgotPassword::resetPassword');
$routes->get('reset-password', 'Auth\EmailVerification::VerifyEmailForgotPassword');
$routes->get('change-password', 'Auth\ChangePassword::index');
$routes->post('change-password/update-forgot-password', 'Auth\ChangePassword::updateForgotPassword');

// OWNER ROUTES
$routes->group('owner', function ($routes) {

    // Di app/Config/Routes.php
    $routes->get('user/create', 'Owner\User::create');
    $routes->post('user/store', 'Owner\User::store');

    $routes->get('dashboard', 'Owner\Dashboard::index');
    $routes->get('user', 'Owner\User::index');
    $routes->get('user/aktifkan/(:num)', 'Owner\User::aktifkan/$1');
    $routes->get('user/nonaktifkan/(:num)', 'Owner\User::nonaktifkan/$1');
    $routes->get('laporan-transaksi', 'Owner\Dashboard::laporanTransaksi');
    $routes->get('laporan-stok', 'Owner\Dashboard::laporanStok');
    // Tambahan:
    $routes->get('statistik/total-omzet', 'Owner\Dashboard::totalOmzet');
    $routes->get('statistik/menu-terlaris', 'Owner\Dashboard::menuTerlaris');

    // PDF EXPORT
    $routes->get('export/pdf/omzet-weekly', 'Owner\Dashboard::exportOmzetWeekly');
    $routes->get('export/pdf/omzet-monthly', 'Owner\Dashboard::exportOmzetMonthly');
    $routes->get('export/pdf/omzet-yearly', 'Owner\Dashboard::exportOmzetYearly');
});

// KASIR ROUTES
$routes->group('kasir', function ($routes) {
    $routes->get('dashboard', 'Kasir\Dashboard::index');

    // TRANSAKSI
    $routes->get('transaksi', 'Kasir\Transaksi::index');
    $routes->get('transaksi/bayar/(:num)', 'Kasir\Transaksi::bayar/$1');
    $routes->post('transaksi/simpan', 'Kasir\Transaksi::simpan');
    $routes->get('transaksi/view/(:num)', 'Kasir\Transaksi::view/$1');
    $routes->get('transaksi/scan', 'Kasir\Transaksi::scan');
    $routes->get('transaksi/riwayat', 'Kasir\Transaksi::riwayat');
    $routes->get('transaksi/siap-belum-dibayar', 'Kasir\Transaksi::siapBelumDibayar');

    // MEJA
    $routes->get('meja', 'Kasir\Meja::index');
    $routes->get('meja/create', 'Kasir\Meja::create');
    $routes->post('meja/store', 'Kasir\Meja::store');
    $routes->get('meja/edit/(:num)', 'Kasir\Meja::edit/$1');
    $routes->post('meja/update/(:num)', 'Kasir\Meja::update/$1');
    $routes->post('meja/delete/(:num)', 'Kasir\Meja::delete/$1');
});
// CHEF ROUTES
$routes->group('chef', function ($routes) {

    $routes->get('dashboard', 'Chef\Dashboard::index');

    // Pesanan
    $routes->get('pesanan', 'Chef\Pesanan::index');
    $routes->get('pesanan/selesai', 'Chef\Pesanan::selesai'); // ✅ TAMBAHKAN INI
    $routes->get('pesanan/detail/(:num)', 'Chef\Pesanan::detail/$1');
    $routes->get('pesanan/ubahStatus/(:num)/(:segment)', 'Chef\Pesanan::ubahStatus/$1/$2');

    // Menu
    $routes->get('menu', 'Chef\Menu::index');
    $routes->get('menu/create', 'Chef\Menu::create');
    $routes->get('menu/detail/(:num)', 'Chef\Menu::detail/$1');
    $routes->post('menu/store', 'Chef\Menu::store');
    $routes->get('menu/edit/(:num)', 'Chef\Menu::edit/$1');
    $routes->post('menu/update/(:num)', 'Chef\Menu::update/$1');

    // Bahan Baku
    $routes->get('bahan', 'Chef\Bahan::index');
    $routes->get('bahan/create', 'Chef\Bahan::create');
    $routes->post('bahan/store', 'Chef\Bahan::store');
    $routes->get('bahan/edit/(:num)', 'Chef\Bahan::edit/$1');
    $routes->post('bahan/update/(:num)', 'Chef\Bahan::update/$1');
});




// PELANGGAN ROUTES
$routes->group('pelanggan', function ($routes) {
    $routes->get('dashboard', 'Pelanggan\Dashboard::index');
    $routes->get('menu/kategori/(:segment)', 'Pelanggan\Menu::kategori/$1');
    $routes->get('menu/add/(:num)', 'Pelanggan\Menu::addToCart/$1');

    $routes->get('keranjang', 'Pelanggan\Keranjang::index');
    $routes->get('keranjang/hapus/(:num)', 'Pelanggan\Keranjang::hapus/$1');
    $routes->get('keranjang/kosongkan', 'Pelanggan\Keranjang::kosongkan');

    $routes->get('pesanan', 'Pelanggan\Pesanan::index');
    $routes->post('pesanan/simpan', 'Pelanggan\Pesanan::simpan');
    $routes->get('pesanan/riwayat', 'Pelanggan\Pesanan::riwayat');
    $routes->get('pesanan/struk/(:num)', 'Pelanggan\Pesanan::struk/$1');

    $routes->get('transaksi/riwayat', 'Pelanggan\Pesanan::riwayatTransaksi');


});



$routes->get('system/updateprofile', 'System\UpdateProfile::index');
$routes->get('system/updateprofile/edit', 'System\UpdateProfile::edit');
$routes->post('system/updateprofile/save', 'System\UpdateProfile::save');




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
