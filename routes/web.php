<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => response()->json(['message' => 'Dizimo API']));

Route::get('/hello', fn () => response()->json(['message' => 'Hello World!']));
