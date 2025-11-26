<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\AdminController;

// registration
Route::get('/registrations', [RegistrationController::class, 'index'])->middleware(\App\Http\Middleware\Registration::class);
Route::post('/registrations', [RegistrationController::class, 'store'])->middleware(\App\Http\Middleware\Registration::class);
Route::get('/registrations/{id}', [RegistrationController::class, 'show'])->middleware(\App\Http\Middleware\Registration::class);

// authorization
Route::get('/authorizations', [AuthorizationController::class, 'index'])->middleware(\App\Http\Middleware\Authorization::class);
Route::post('/authorizations', [AuthorizationController::class, 'store'])->middleware(\App\Http\Middleware\Authorization::class);
Route::get('/authorizations/{id}', [AuthorizationController::class, 'show'])->middleware(\App\Http\Middleware\Authorization::class);

Route::get('/', function () {
    return view('home');
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

    if (! Auth::attempt([
        'email' => $data['email'],
        'password' => $data['password'],
    ], $request->boolean('remember'))) {
        return redirect('/login')
            ->withErrors(['email' => 'These credentials do not match our records.'])
            ->withInput();
    }

    $request->session()->regenerate();
    $user = Auth::user();

    if ($user && $user->is_admin) {
        return redirect()->intended('/admin/dashboard');
    }

    return redirect()->intended('/');
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

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
});
