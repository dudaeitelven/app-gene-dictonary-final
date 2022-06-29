<?php

use App\Http\Controllers\ResearchMailController;
use App\Http\Livewire\ResearchesShowDetail;
use App\Mail\ResearchMail;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ResearchesShow;


Route::redirect('/','login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    Route::get('/researches-tab', function () {return view('researches-tab');})->name('researches-tab');
    //Route::get('/researches-tab-detail/{id}', function () {return view('researches-tab-detail');})->name('researches-tab-detail');
    Route::get('/researches-tab-detail/{id}', ResearchesShowDetail::class)->name('researches-tab-detail');

    Route::get('/email', [ResearchMailController::class, 'email']);
});
