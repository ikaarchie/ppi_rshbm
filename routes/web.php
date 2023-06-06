<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
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

Route::get('/', [SurveilansController::class, 'index'])->name('index');
Route::get('/', [SurveilansController::class, 'getData'])->name('getData');
Route::post('/save', [SurveilansController::class, 'save']);
Route::patch('/update/{id}', [SurveilansController::class, 'update'])->name('update');
Route::get('/delete/{id}', [SurveilansController::class, 'destroy'])->name('delete');

Route::get('/rekap', [SurveilansController::class, 'rekap'])->name('rekap');
Route::get('/rekap/excel/', [SurveilansController::class, 'excel'])->name('excel');
Route::get('/rekap/pdf/', [SurveilansController::class, 'pdf'])->name('pdf');
Route::post('/inputRekap', [SurveilansController::class, 'inputRekap'])->name('inputRekap');
Route::patch('/updateRekap/{id}', [SurveilansController::class, 'updateRekap'])->name('updateRekap');

Route::get('/feedback', [FeedbackController::class, 'index'])->name('index');
Route::get('/feedback', [FeedbackController::class, 'getData'])->name('getData');
Route::post('/feedback/save', [FeedbackController::class, 'save']);
Route::patch('/feedback/update/{id}', [FeedbackController::class, 'update'])->name('updateFeedback');
Route::get('/feedback/delete/{id}', [FeedbackController::class, 'destroy'])->name('deleteFeedback');
