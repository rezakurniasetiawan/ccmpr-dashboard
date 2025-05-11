<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	// return redirect('/dashboard');
	return view('welcome');
});
