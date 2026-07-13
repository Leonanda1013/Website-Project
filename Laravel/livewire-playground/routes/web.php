<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/counter', function(){
    return view('counter-page');
});

Route::get('/contact-form', function(){
    return view('contact-form-page');
});

Route::get('/admin-only', function(){
    return 'Selamat datang, kamu admin!';
})->middleware('role:admin');
