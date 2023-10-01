<?php

use App\Http\Livewire\ClanGames;
use App\Http\Livewire\Members;
use App\Http\Livewire\Overview;
use Illuminate\Support\Facades\Route;

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

Route::get('/', Overview::class)->name('overview');
Route::get('/clan', Members::class)->name('members');
Route::get('/clan_game', ClanGames::class)->name('clan-game');
Route::view('/2', 'two')->name('two');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
