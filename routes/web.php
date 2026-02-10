<?php

use App\Livewire\Auth\Register;
use App\Livewire\Admin\AdminLogin;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\TenantShow;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

// Central/Landing routes — must be domain-scoped to coexist with tenant routes.
foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return view('landing');
        })->name('home');

        Route::get('/register', Register::class)->name('register');

        Route::get('/pricing', function () {
            return view('pricing');
        })->name('pricing');

        Route::get('/login', function () {
            return view('central-login');
        })->name('central.login');

        // Admin routes
        Route::get('/admin/login', AdminLogin::class)->name('admin.login');

        Route::middleware(AdminAuth::class)->prefix('admin')->group(function () {
            Route::get('/', AdminDashboard::class)->name('admin.dashboard');
            Route::get('/tenants/{tenant}', TenantShow::class)->name('admin.tenants.show');
            Route::post('/logout', function () {
                auth()->guard('admin')->logout();
                request()->session()->invalidate();
                request()->session()->regenerateToken();
                return redirect()->route('admin.login');
            })->name('admin.logout');
        });
    });
}
