<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::get('/', function () {
    return view('welcome');
});

// Vista de ReDoc (pública)
Route::get('/docs', fn () => view('docs'))->name('docs');

// Sirve el openapi.json sin depender del symlink de storage
Route::get('/docs/openapi.json', function () {
    $path = storage_path('api-docs/api-docs.json');
    abort_unless(File::exists($path), 404, 'openapi.json no encontrado');
    return response()->file($path, ['Content-Type' => 'application/json']);
})->name('docs.openapi');