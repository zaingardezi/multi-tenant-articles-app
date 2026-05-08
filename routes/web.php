<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Central\CentralAuthController;
use App\Http\Controllers\Central\TenantManagerController;


Route::prefix('admin')->group(function () {

    
    Route::get('/login', [CentralAuthController::class, 'showLogin'])
        ->name('central.login');
    Route::post('/login', [CentralAuthController::class, 'login']);
    Route::post('/logout', [CentralAuthController::class, 'logout'])
        ->name('central.logout');

    
    Route::middleware(['auth:superadmin'])->group(function () {
        Route::get('/dashboard', [TenantManagerController::class, 'index'])
            ->name('central.dashboard');
        Route::get('/tenants/create', [TenantManagerController::class, 'create'])
            ->name('central.tenants.create');
        Route::post('/tenants', [TenantManagerController::class, 'store'])
            ->name('central.tenants.store');
        Route::delete('/tenants/{tenant}', [TenantManagerController::class, 'destroy'])
            ->name('central.tenants.destroy');
    });

});

Route::get('/', function () {
    return redirect()->route('central.login');
});