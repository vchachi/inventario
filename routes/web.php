<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
})->name('inciio');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/forgetpassword', [App\Http\Controllers\UserController::class, 'forgetpassword'])->name('password.emails');
Route::post('/authenticate', [App\Http\Controllers\UserController::class, 'authenticate'])->name('authenticate');


Auth::routes();




Route::resource('repairs', App\Http\Controllers\repairsController::class);

Route::resource('sales', App\Http\Controllers\salesController::class);

Route::resource('clients', App\Http\Controllers\clientsController::class);

Route::resource('products', App\Http\Controllers\productsController::class);

Route::resource('parts', App\Http\Controllers\partsController::class);

Route::resource('orders', App\Http\Controllers\ordersController::class);

Route::resource('budgets', App\Http\Controllers\budgetsController::class);

Route::resource('categories', App\Http\Controllers\categoriesController::class);

Route::resource('warranties', App\Http\Controllers\warrantiesController::class);

Route::resource('safeguards', App\Http\Controllers\safeguardsController::class);

Route::resource('users', App\Http\Controllers\UserController::class);
Route::resource('suscriptions', App\Http\Controllers\suscriptionsController::class);
Route::resource('employees', App\Http\Controllers\employeesController::class);

Route::resource('tickets', App\Http\Controllers\ticketsController::class);
Route::resource('factura', App\Http\Controllers\FacturaController::class);

Route::resource('invoiceSeries', App\Http\Controllers\invoice_seriesController::class);

Route::resource('invoiceCustoms', App\Http\Controllers\invoice_customController::class);

Route::resource('companies', App\Http\Controllers\companiesController::class);

Route::resource('accessLevels', App\Http\Controllers\access_levelsController::class);
Route::post('/profile/cahnge_empresa/{id}', [App\Http\Controllers\ProfileController::class, 'cahnge_empresa'])->name('profile.cahngeempresa');
Route::post('/profile/changepassw/{id}', [App\Http\Controllers\ProfileController::class, 'changepassw'])->name('profile.changepassw');
Route::post('/profile/ChangeProfile', [App\Http\Controllers\ProfileController::class, 'ChangeProfile'])->name('profile.ChangeProfile');

Route::get('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
Route::post('/sales/paid', [App\Http\Controllers\salesController::class, 'paid'])->name('sales.paid');
Route::get('/sales/paid/{id}', [App\Http\Controllers\salesController::class, 'paidshow'])->name('sales.paidshow');
Route::get('/sales/paidrepairs/{id}', [App\Http\Controllers\salesController::class, 'paidshowRepairs'])->name('sales.paidshowRepairs');

Route::get('export/plantillacsv/products',[App\Http\Controllers\productsController::class, 'exportCSVFile'])->name('exportproductplan.csv');

Route::get('export/clientes',[App\Http\Controllers\clientsController::class, 'exportcliente'])->name('exportcliente.create');

Route::post('import/plantillacsv/products',[App\Http\Controllers\productsController::class, 'import'])->name('importproductplan.csv');
Route::post('import/woocomerce',[App\Http\Controllers\productsController::class, 'woocomerceimport'])->name('products.woocomerce');
Route::post('import/shopify',[App\Http\Controllers\productsController::class, 'shopifyimport'])->name('products.shopify');
Route::post('import/repairss',[App\Http\Controllers\productsController::class, 'repairsImport'])->name('products.repairs');

Route::get('export/plantillacsv/categories',[App\Http\Controllers\categoriesController::class, 'exportCSVFile'])->name('exportcategories.csv');
Route::post('import/plantillacsv/categories',[App\Http\Controllers\categoriesController::class, 'import'])->name('importcategories.csv');
Route::get('/showticketfactura/{id}/{tipo}', [App\Http\Controllers\DocumentGeneController::class, 'showticketfactura'])->name('documentsgenerate.showticketfactura');
Route::get('/showfactura1/{id}/{tipo}', [App\Http\Controllers\DocumentGeneController::class, 'showfactura1'])->name('documentsgenerate.showfactura1');
Route::get('/repairspdf/{id}', [App\Http\Controllers\repairsController::class, 'pdfGenerate'])->name('repairs.pdfGenerate');
Route::post('/documentsglobal', [App\Http\Controllers\DocumentGeneController::class, 'documentsglobal'])->name('Documents.pdfGlobal');
Route::post('/factura/excel', [App\Http\Controllers\FacturaController::class, 'exportAllFacturaFecha'])->name('factura.excel');

Route::get('/exportRepairsCSVFile', [App\Http\Controllers\repairsController::class, 'exportRepairsCSVFile'])->name('repairs.exportRepairsCSVFile');

Route::get('/estadisticas', [App\Http\Controllers\EstadisticasController::class, 'index'])->name('estadisticas');
Route::post('/estadisticas/earnings', [App\Http\Controllers\EstadisticasController::class, 'earnings'])->name('stat-earnings');
Route::post('/estadisticas/performance', [App\Http\Controllers\EstadisticasController::class, 'performance'])->name('stat-performance');
Route::post('/estadisticas/products', [App\Http\Controllers\EstadisticasController::class, 'products'])->name('stat-products');