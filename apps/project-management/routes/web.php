<?php

use Illuminate\Support\Facades\Route;
use Project\Presentation\Controllers\ProjectIndexController;

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

Route::get(
    '/', function () {
        return view('welcome');
    }
);

Route::get(
    '/dashboard', function () {
        return view('dashboard');
    }
)->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';



Route::middleware(['auth', 'verified'])->group(
    function () {
        Route::prefix('project')->name('project.')->group(
            function () {
                Route::get('/', [ProjectIndexController::class, 'index'])->name('index');
                Route::get('create', [ProjectIndexController::class, 'create'])->name('create');
                Route::post('store', [ProjectIndexController::class, 'store'])->name('store');
                Route::get('{id}', [ProjectIndexController::class, 'show'])->name('show');
            }
        );
    }
);
