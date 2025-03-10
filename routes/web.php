<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApdController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\BundleIADController;
use App\Http\Controllers\BundleIDOController;
use App\Http\Controllers\BundleISKController;
use App\Http\Controllers\BundleVAPController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CuciTanganController;
use App\Http\Controllers\SurveilansController;
use App\Http\Controllers\MstKodeBundleController;
use App\Http\Controllers\BundlePlebitisController;
use App\Http\Controllers\PenggunaController;

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

Route::get('/surveilans', [SurveilansController::class, 'index'])->name('indexSurveilans');
Route::get('/surveilans', [SurveilansController::class, 'getData'])->name('getDataSurveilans');
Route::post('/surveilans/save', [SurveilansController::class, 'save']);
Route::patch('/surveilans/update/{id}', [SurveilansController::class, 'update'])->name('updateSurveilans');
Route::get('/surveilans/delete/{id}', [SurveilansController::class, 'destroy'])->name('deleteSurveilans');

Route::get('/rekapSurveilans', [SurveilansController::class, 'rekap'])->name('rekapSurveilans');
Route::get('/rekapSurveilans/excel/', [SurveilansController::class, 'excel'])->name('excelSurveilans');
Route::get('/rekapSurveilans/pdf/', [SurveilansController::class, 'pdf'])->name('pdfSurveilans');
Route::post('/inputRekapSurveilans', [SurveilansController::class, 'inputRekap'])->name('inputRekapSurveilans');
Route::patch('/updateRekapSurveilans/{id}', [SurveilansController::class, 'updateRekap'])->name('updateRekapSurveilans');

Route::get('/feedback', [FeedbackController::class, 'index'])->name('indexFeedback');
Route::get('/feedback', [FeedbackController::class, 'getData'])->name('getDataFeedback');
Route::post('/feedback/save', [FeedbackController::class, 'save']);
Route::patch('/feedback/update/{id}', [FeedbackController::class, 'update'])->name('updateFeedback');
Route::get('/feedback/delete/{id}', [FeedbackController::class, 'destroy'])->name('deleteFeedback');

Route::get('/cuciTangan', [CuciTanganController::class, 'index'])->name('indexCuciTangan');
Route::get('/cuciTangan', [CuciTanganController::class, 'getData'])->name('getDataCuciTangan');
Route::post('/cuciTangan/save', [CuciTanganController::class, 'save']);
Route::patch('/cuciTangan/update/{id}', [CuciTanganController::class, 'update'])->name('updateCuciTangan');
Route::get('/cuciTangan/delete/{id}', [CuciTanganController::class, 'destroy'])->name('deleteCuciTangan');

Route::get('/rekapCuciTangan', [CuciTanganController::class, 'rekap'])->name('rekapCuciTangan');
Route::get('/rekapCuciTangan/excel/', [CuciTanganController::class, 'excel'])->name('excelCuciTangan');
Route::get('/rekapCuciTangan/pdf/', [CuciTanganController::class, 'pdf'])->name('pdfCuciTangan');
Route::post('/inputRekapCuciTangan', [CuciTanganController::class, 'inputRekap'])->name('inputRekapCuciTangan');
Route::patch('/updateRekapCuciTangan/{id}', [CuciTanganController::class, 'updateRekap'])->name('updateRekapCuciTangan');

Route::get('/mstKodeBundle', [MstKodeBundleController::class, 'index'])->name('indexMstKodeBundle');
Route::get('/mstKodeBundle', [MstKodeBundleController::class, 'getData'])->name('getDataMstKodeBundle');
Route::post('/mstKodeBundle/save', [MstKodeBundleController::class, 'save']);
Route::patch('/mstKodeBundle/update/{id}', [MstKodeBundleController::class, 'update'])->name('updateMstKodeBundle');
Route::get('/mstKodeBundle/delete/{id}', [MstKodeBundleController::class, 'destroy'])->name('deleteMstKodeBundle');

Route::get('/bundle', [BundleIADController::class, 'index'])->name('indexBundleIad');
Route::get('/bundle', [BundleIADController::class, 'getData'])->name('getDataBundleIad');
Route::post('/bundle/save', [BundleIADController::class, 'save']);
Route::patch('/bundle/update/{id}', [BundleIADController::class, 'update'])->name('updateBundleIad');
Route::get('/bundle/delete/{id}', [BundleIADController::class, 'destroy'])->name('deleteBundleIad');

Route::get('/bundleIdo', [BundleIDOController::class, 'index'])->name('indexBundleIdo');
Route::get('/bundleIdo', [BundleIDOController::class, 'getData'])->name('getDataBundleIdo');
Route::post('/bundleIdo/save', [BundleIDOController::class, 'save']);
Route::patch('/bundleIdo/update/{id}', [BundleIDOController::class, 'update'])->name('updateBundleIdo');
Route::get('/bundleIdo/delete/{id}', [BundleIDOController::class, 'destroy'])->name('deleteBundleIdo');

Route::get('/bundleIsk', [BundleISKController::class, 'index'])->name('indexBundleIsk');
Route::get('/bundleIsk', [BundleISKController::class, 'getData'])->name('getDataBundleIsk');
Route::post('/bundleIsk/save', [BundleISKController::class, 'save']);
Route::patch('/bundleIsk/update/{id}', [BundleISKController::class, 'update'])->name('updateBundleIsk');
Route::get('/bundleIsk/delete/{id}', [BundleISKController::class, 'destroy'])->name('deleteBundleIsk');

Route::get('/bundlePlebitis', [BundlePlebitisController::class, 'index'])->name('indexBundlePlebitis');
Route::get('/bundlePlebitis', [BundlePlebitisController::class, 'getData'])->name('getDataBundlePlebitis');
Route::post('/bundlePlebitis/save', [BundlePlebitisController::class, 'save']);
Route::patch('/bundlePlebitis/update/{id}', [BundlePlebitisController::class, 'update'])->name('updateBundlePlebitis');
Route::get('/bundlePlebitis/delete/{id}', [BundlePlebitisController::class, 'destroy'])->name('deleteBundlePlebitis');

Route::get('/bundleVap', [BundleVAPController::class, 'index'])->name('indexBundleVap');
Route::get('/bundleVap', [BundleVAPController::class, 'getData'])->name('getDataBundleVap');
Route::post('/bundleVap/save', [BundleVAPController::class, 'save']);
Route::patch('/bundleVap/update/{id}', [BundleVAPController::class, 'update'])->name('updateBundleVap');
Route::get('/bundleVap/delete/{id}', [BundleVAPController::class, 'destroy'])->name('deleteBundleVap');

Route::get('/rekapBundle', [BundleIADController::class, 'rekap'])->name('rekapBundle');
Route::get('/rekapBundle/excel/', [BundleIADController::class, 'excel'])->name('excelBundle');
Route::get('/rekapBundle/pdf/', [BundleIADController::class, 'pdf'])->name('pdfBundle');
Route::post('/inputRekapBundle', [BundleIADController::class, 'inputRekap'])->name('inputRekapBundle');
Route::patch('/updateRekapBundle/{id}', [BundleIADController::class, 'updateRekap'])->name('updateRekapBundle');

Route::get('/rekapBundleIdo', [BundleIDOController::class, 'rekap'])->name('rekapBundleIdo');
Route::get('/rekapBundleIdo/excel/', [BundleIDOController::class, 'excel'])->name('excelBundleIdo');
Route::get('/rekapBundleIdo/pdf/', [BundleIDOController::class, 'pdf'])->name('pdfBundleIdo');
Route::post('/inputRekapBundleIdo', [BundleIDOController::class, 'inputRekap'])->name('inputRekapBundleIdo');
Route::patch('/updateRekapBundleIdo/{id}', [BundleIDOController::class, 'updateRekap'])->name('updateRekapBundleIdo');

Route::get('/rekapBundleIsk', [BundleISKController::class, 'rekap'])->name('rekapBundleIsk');
Route::get('/rekapBundleIsk/excel/', [BundleISKController::class, 'excel'])->name('excelBundleIsk');
Route::get('/rekapBundleIsk/pdf/', [BundleISKController::class, 'pdf'])->name('pdfBundleIsk');
Route::post('/inputRekapBundleIsk', [BundleISKController::class, 'inputRekap'])->name('inputRekapBundleIsk');
Route::patch('/updateRekapBundleIsk/{id}', [BundleISKController::class, 'updateRekap'])->name('updateRekapBundleIsk');

Route::get('/rekapBundlePlebitis', [BundlePlebitisController::class, 'rekap'])->name('rekapBundlePlebitis');
Route::get('/rekapBundlePlebitis/excel/', [BundlePlebitisController::class, 'excel'])->name('excelBundlePlebitis');
Route::get('/rekapBundlePlebitis/pdf/', [BundlePlebitisController::class, 'pdf'])->name('pdfBundlePlebitis');
Route::post('/inputRekapBundlePlebitis', [BundlePlebitisController::class, 'inputRekap'])->name('inputRekapBundlePlebitis');
Route::patch('/updateRekapBundlePlebitis/{id}', [BundlePlebitisController::class, 'updateRekap'])->name('updateRekapBundlePlebitis');

Route::get('/rekapBundleVap', [BundleVAPController::class, 'rekap'])->name('rekapBundleVap');
Route::get('/rekapBundleVap/excel/', [BundleVAPController::class, 'excel'])->name('excelBundleVap');
Route::get('/rekapBundleVap/pdf/', [BundleVAPController::class, 'pdf'])->name('pdfBundleVap');
Route::post('/inputRekapBundleVap', [BundleVAPController::class, 'inputRekap'])->name('inputRekapBundleVap');
Route::patch('/updateRekapBundleVap/{id}', [BundleVAPController::class, 'updateRekap'])->name('updateRekapBundleVap');

Route::get('/apd', [ApdController::class, 'index'])->name('indexAPD');
Route::get('/apd', [ApdController::class, 'getData'])->name('getDataAPD');
Route::post('/apd/save', [ApdController::class, 'save']);
Route::patch('/apd/update/{id}', [ApdController::class, 'update'])->name('updateAPD');
Route::get('/apd/delete/{id}', [ApdController::class, 'destroy'])->name('deleteAPD');

Route::get('/rekapAPD', [ApdController::class, 'rekap'])->name('rekapAPD');
Route::get('/rekapAPD/excel/', [ApdController::class, 'excel'])->name('excelAPD');
Route::get('/rekapAPD/pdf/', [ApdController::class, 'pdf'])->name('pdfAPD');
Route::post('/inputRekapAPD', [ApdController::class, 'inputRekap'])->name('inputRekapAPD');
Route::patch('/updateRekapAPD/{id}', [ApdController::class, 'updateRekap'])->name('updateRekapAPD');

// Route::get('/login', [LoginController::class, 'index']);

// Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');


// Route::get('/', function () {
//     return redirect('login');
// });


Route::get('/register', function () {
    return view('register-form');
});

Route::post('/register', [PenggunaController::class, 'store'])->name('register.store');

Route::get('/data/{penggunaId}', [PenggunaController::class, 'showDataForm'])->name('data.form');
Route::post('/data/{penggunaId}', [PenggunaController::class, 'storeData'])->name('data.store');
