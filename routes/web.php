<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home', ['title' => 'Home - Sistema de estoque'])->name('home');
Route::view('/exibir', 'exibir', ['title' => 'Exibir - Sistema de estoque'])->name('exibir');
Route::view('/editar', 'editar', ['title' => 'Editar - Sistema de estoque'])->name('editar');
