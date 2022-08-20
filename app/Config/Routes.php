<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->post('/login', 'Login::aksi_login'); 
$routes->get('/logout', 'Login::logout'); 
$routes->get('/dashboard', 'Dashboard::index');  

	$routes->get('sparepart', 'Sparepart::index'); 
    $routes->post('sparepart-store', 'Sparepart::store'); 
    $routes->post('sparepart-show', 'Sparepart::show'); 
	$routes->get('sparepart-edit/(:num)', 'Sparepart::edit/$1');  
	$routes->post('sparepart-hapus', 'Sparepart::delete');

	$routes->post('sparepart-search', 'Sparepart::list_sparepart');
	$routes->post('servis-search', 'Sparepart::list_servis');

	$routes->get('servis', 'Servis::index'); 
    $routes->post('servis-store', 'Servis::store'); 
    $routes->post('servis-show', 'Servis::show'); 
	$routes->get('servis-edit/(:num)', 'Servis::edit/$1');  
	$routes->post('servis-hapus', 'Servis::delete');

	$routes->post('sparepart-search', 'Sparepart::list_sparepart');

	$routes->get('supplier', 'Supplier::index'); 
    $routes->post('supplier-store', 'Supplier::store'); 
	$routes->get('supplier-edit/(:num)', 'Supplier::edit/$1'); 
	$routes->post('supplier-hapus', 'Supplier::delete');

	$routes->get('masuk', 'SparepartMasuk::index'); 
    $routes->post('masuk-store', 'SparepartMasuk::store'); 
	$routes->get('masuk-edit/(:num)', 'SparepartMasuk::edit/$1'); 
	$routes->post('masuk-hapus', 'SparepartMasuk::delete');

	$routes->get('keluar', 'SparepartKeluar::index'); 
    $routes->post('keluar-store', 'SparepartKeluar::store'); 
	$routes->get('keluar-edit/(:num)', 'SparepartKeluar::edit/$1'); 
	$routes->post('keluar-hapus', 'SparepartKeluar::delete'); 
	
	$routes->get('sparepart-nota/(:num)', 'SparepartKeluar::cetak_nota/$1'); 
	$routes->post('sparepart-detail_penjualan', 'SparepartKeluar::detail_penjualan'); 
	$routes->get('sparepart-nota/(:num)', 'ServisKeluar::cetak_nota/$1'); 
	$routes->post('sparepart-detail_servis', 'ServisKeluar::detail_servisn'); 

	$routes->get('servisKeluar', 'ServisKeluar::index'); 
    $routes->post('servis-keluar-store', 'ServisKeluar::store'); 
	$routes->get('servis-keluar-edit/(:num)', 'ServisKeluar::edit/$1'); 
	$routes->post('servis-keluar-hapus', 'ServisKeluar::delete');  

	$routes->get('user', 'User::index'); 
    $routes->post('user-store', 'User::store'); 
	$routes->get('user-edit/(:num)', 'User::edit/$1'); 
	$routes->post('user-hapus', 'User::delete');
	 
 
 

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
