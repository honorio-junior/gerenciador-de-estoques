<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home', ['title' => 'Gerenciador de estoques'])->name('home');