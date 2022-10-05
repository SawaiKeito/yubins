<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YubinController;
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
    return view('welcome');
});


Route::get('/', function(){return redirect('/yubins');});
Route::get('/yubins', [App\Http\Controllers\YubinController::class, 'index'])->middleware('auth');
Route::post('/yubins', [App\Http\Controllers\YubinController::class, 'store'])->middleware('auth');
//csvアップロード
Route::post('/upload', [App\Http\Controllers\YubinController::class, 'upload'])->middleware('auth');
//CSVダウンロード
Route::post('/csvexport',[YubinController::class, 'csvexport'])->name('yubins.csvexport')->middleware('auth');
// 登録画面の表示
Route::get('/create', [YubinController::class, 'create'])->name('yubins.create')->middleware('auth');
// 住所の登録処理
Route::post('/show', [YubinController::class, 'show'])->name('yubins.show')->middleware('auth');
//変更・編集
Route::get('/edit/{id}', [YubinController::class, 'edit'])->name('yubins.edit')->middleware('auth');
//更新処理
Route::post('/update/{id}', [YubinController::class, 'update'])->name('yubins.update')->middleware('auth');
//削除
Route::post('/destroy', [YubinController::class, 'destroy'])->name('yubins.destroy')->middleware('auth');

\URL::forceScheme('https');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

