<?php


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;




Route::get('/categories', [CategoryController::class, 'dohvatiKategorije']);
Route::post('/categories', [CategoryController::class, 'spremiKategoriju']);
Route::get('/obrisiKategoriju/{id}', [CategoryController::class, 'obrisiKategoriju']);
Route::post('/urediKategoriju', [CategoryController::class, 'urediKategoriju']);


Route::get('/posts/{category}', [PostController::class, 'dohvatiObjave']);
Route::post('/posts', [PostController::class, 'novaObjava']);

/*Objava info*/
Route::get('/objavaInfo/{id}', [PostController::class, 'dohvatiObjavu']);


/*Uredi objavu*/
Route::post('/urediObjavu', [PostController::class, 'urediObjavu']);

/*Obriši objavu*/
Route::get('/obrisiObjavu/{id}', [PostController::class, 'obrisiObjavu']);
