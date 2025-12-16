<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminAccessRequestController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserDashboardController;

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

    if ($user && $user->admin_requested_at) {
        return redirect()->route('admin.requests.pending');
    }

    return redirect()->intended(route('shop.index'));
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $data = $request->only(['name', 'email', 'password', 'password_confirmation', 'store_admin']);
    $isAdminRequest = $request->boolean('store_admin');

    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
        'store_admin' => 'nullable|boolean',
    ];

    $validator = Validator::make($data, $rules);

    if ($validator->fails()) {
        return redirect('/register')->withErrors($validator)->withInput();
    }

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'is_admin' => false,
        'must_change_password' => false,
        'admin_requested_at' => $isAdminRequest ? now() : null,
        'admin_approved_at' => null,
        'admin_denied_at' => null,
    ]);

    Auth::login($user);
    $request->session()->regenerate();

    if ($isAdminRequest) {
        return redirect()->route('admin.requests.pending')
            ->with('status', 'Your BloomWell HQ access request is pending review. The admin console unlocks once approved.');
    }

    return redirect()->intended(route('shop.index'));
});

Route::middleware('auth')->get('/admin/request/pending', function () {
    $user = auth()->user();

    if (! $user) {
        return redirect()->route('login');
    }

    if ($user->is_admin || ! $user->admin_requested_at) {
        return redirect()->route($user->is_admin ? 'admin.dashboard' : 'shop.index');
    }

    return view('admin.requests.pending');
})->name('admin.requests.pending');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    Route::post('/checkout', CheckoutController::class)->name('checkout');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/requests', [AdminAccessRequestController::class, 'index'])->name('admin.requests.index');
    Route::post('/admin/requests/{user}/approve', [AdminAccessRequestController::class, 'approve'])->name('admin.requests.approve');
    Route::post('/admin/requests/{user}/deny', [AdminAccessRequestController::class, 'deny'])->name('admin.requests.deny');
    Route::resource('/admin/products', AdminProductController::class)->names('admin.products');
    Route::resource('/admin/orders', AdminOrderController::class)->only(['index', 'show', 'update'])->names('admin.orders');
    Route::post('/admin/orders/{order}/fulfill', [AdminOrderController::class, 'fulfill'])->name('admin.orders.fulfill');
});
