<?php

use App\Http\Controllers\API\AracController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\GirisController;
use App\Http\Controllers\API\KullanıcıController;
use App\Http\Controllers\API\OdemeController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\PlakaController;
use App\Http\Controllers\API\RezervasyonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('kullanici/add', [KullanıcıController::class, 'store']);





Route::post('arac_tablo/add', [AracController::class, 'store']);


Route::post('plaka',[PlakaController::class,'store']);
Route::post('login',[AuthController::class,'login']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    
}); 

Route::get('araclar/{kullanici_id}',[AracController::class, 'araclar']);
Route::get('araclar/{plaka}',[AracController::class,]);
Route::put('araclar/{id}', [AracController::class, 'guncelle']);
Route::put('users/{id}', [AracController::class, 'rezervasyon_guncelle']);

Route::delete('araclar/{id}', [AracController::class, 'delete_arac']);
Route::delete('delete_rezervasyon/{id}', [AracController::class, 'delete_rezervasyon']);
Route::delete('delete/{id}',[KullanıcıController::class,'delete_oge']);

Route::get('kullanici',[KullanıcıController::class,'getKullanicilar']);
Route::get('user',[AuthController::class,'register']);
Route::get('araclar',[AracController::class,'getArac']);
Route::get('plaka',[PlakaController::class,'getPlakalar']);
Route::get('user',[AuthController::class,'user']);
Route::get('get_total_distinct_plaka_count', [GirisController::class, 'getTotalDistinctPlakaCount']);
Route::get('get-total-vehicle-count', [GirisController::class, 'getTotalVehicleCount']);

Route::post('register',[AuthController::class,'register']);
Route::post('logout',[AuthController::class,'logout']);


