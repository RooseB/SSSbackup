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
    //premade stuff for the profile, BREEZE MADE THESE 3
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/create', [WebAppController::class, 'create'])->middleware('can:create,App\Models\Upload');
    // Route::post('/uploads/create', [WebAppController::class, 'store'])->name('profile.store');

    // Route::post('/uploads/create/{id}/{originalname}', [WebAppController::class, 'show'])->middleware('can:view, upload');
    Route::get('/create/{id}/{originalname}', [WebAppController::class, 'show'])->middleware('can:index,App\Models\Upload');

    
    //for editing
    //Route::get('/uploads/{upload}/edit', [WebAppController::class, 'change'])->middleware('can:change,App\Models\Upload');
    Route::get('/uploads/{id}/edit', [WebAppController::class, 'change'])->name('webapp.change');

    //for deletion
    //Route::delete('/uploads/{webapp}', [WebAppController::class, 'decimate'])->middleware('can:delete,user,App\Models\Upload')->name('webapp.decimate');
    Route::delete('/uploads/{webapp}', [WebAppController::class, 'decimate'])->name('webapp.decimate');

    //shows all the inputs on the database, username of uploader, etc
    Route::get('/uploads', [WebAppController::class, 'index'])->middleware('can:viewAny,App\Models\Upload');

    //Route::put('/uploads/{upload}/edit', [WebAppController::class, 'update'])->middleware('can:update,upload');
    Route::post('/uploads/{webapp}/edit', [WebAppController::class, 'update'])->name('webapp.update');

});

//Route::post('/uploads/{id}/edit', [WebAppController::class, 'change'])->middleware(['auth', 'verified'])->name('webapp.change');

Route::post('/create', [WebAppController::class, 'store'])->middleware(['auth', 'verified'])->name('webapp.store');

Route::post('/create/{id}/{originalname}', [WebAppController::class, 'show'])->middleware(['auth', 'verified'])->name('webapp.show');



//routes for when a user clicks on a file in the create page
Route::get('/uploads/{upload}/{originalName}', [WebAppController::class, 'show'])->middleware('can:view,webapp');





Route::middleware(['auth:sanctum', 'verified'])->get('/create/{id}/{originalname}', function () {
    return view('input');
})->name('profile.show');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

require __DIR__.'/auth.php';