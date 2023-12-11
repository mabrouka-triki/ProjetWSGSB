<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\controllerFrais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/getConnexion', [App\Http\Controllers\ControllerLogin::class, 'signIn']);

// Séance API Mise à jour des mots de passe
Route::get('/updatePassword/{pwd}',[\App\Http\Controllers\ControllerLogin::class,'updatePassword']);

Route::post('/login',[AuthController::class,'login']);

Route::get('/listeFrais/{id_visiteur}',[controllerFrais::class,'getListeFicheFrais']);



Route::post('/addFicheFrais',[controllerFrais::class,'addFicheFrais']);
Route::post('/updateFicheFrais',[controllerFrais::class,'updateFicheFrais']);

Route::delete('/suppressionFrais/{id_frais}', [controllerFrais::class, 'suppressionFrais']);



