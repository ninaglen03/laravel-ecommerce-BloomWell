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
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;

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

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product:slug}', [ShopController::class, 'show'])->name('shop.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

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

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    Auth::login($user);

    return redirect()->intended('/');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    Route::post('/checkout', CheckoutController::class)->name('checkout');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::resource('/admin/products', AdminProductController::class)->names('admin.products');
    Route::resource('/admin/orders', AdminOrderController::class)->only(['index', 'show', 'update'])->names('admin.orders');
});
