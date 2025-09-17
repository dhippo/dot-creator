<?php

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/lang-switch', function (Request $request) {
    $locale = $request->string('locale')->toString();
    if (in_array($locale, ['en','fr'], true)) {
        Session::put('locale', $locale);
    }
    return back(status: 303); // évite le repost du formulaire
})->name('lang.switch');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
