<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\CuciTanganController;
use App\Http\Controllers\SurveilansController;

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
