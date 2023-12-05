<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facade\Auth;


use App\Http\Controllers\WebAppController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/create', [WebAppController::class, 'create'])->middleware('can:create,App\Models\Upload');
    // Route::post('/uploads/create', [WebAppController::class, 'store'])->name('profile.store');


    // Route::post('/uploads/create/{id}/{originalname}', [WebAppController::class, 'show'])->middleware('can:view, upload');
    Route::get('/create/{id}/{originalname}', [WebAppController::class, 'show'])->middleware('can:index,App\Models\Upload');
});

Route::post('/create', [WebAppController::class, 'store'])->middleware(['auth', 'verified'])->name('profile.store');

Route::post('/create/{id}/{originalname}', [WebAppController::class, 'show'])->middleware(['auth', 'verified'])->name('profile.show');
    
Route::get('/uploads', [WebAppController::class, 'index'])->middleware('can:viewAny,App\Models\Upload');

Route::post('/uploads', [WebAppController::class, 'store'])->middleware('can:create,App\Models\Upload');

Route::get('/uploads/{upload}/edit/', [WebAppController::class, 'edit'])->middleware('can:update,webapp');

Route::get('/uploads/{upload}/{originalName}', [WebAppController::class, 'show'])->middleware('can:view,webapp');

Route::get('/uploads/{upload}/file/{originalName?}', [WebAppController::class, 'file'])->middleware('can:view,upload');

Route::delete('/uploads/{upload}', [WebAppController::class, 'destroy'])->middleware('can:delete,upload');

Route::put('/uploads/{upload}', [WebAppController::class, 'update'])->middleware('can:update,upload');

//routes for when a user clicks on a file in the create page


Route::middleware(['auth:sanctum', 'verified'])->get('/create/{id}/{originalname}', function () {
    return view('input');
})->name('profile.show');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

require __DIR__.'/auth.php';