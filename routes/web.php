<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $data = $request->only(['email', 'password']);

    $validator = Validator::make($data, [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    if ($validator->fails()) {
        return redirect('/login')->withErrors($validator)->withInput();
    }
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $data = $request->only(['name', 'email', 'password', 'password_confirmation']);

    $validator = Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    if ($validator->fails()) {
        return redirect('/register')->withErrors($validator)->withInput();
    }
});
