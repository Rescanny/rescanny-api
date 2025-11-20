<?php

use App\Http\Actions\App\StatusAction;
use App\Http\Actions\Auth\LogoutAction;
use App\Http\Actions\Auth\MagicLinkAuthenticationAction;
use App\Http\Actions\Auth\MagicLinkValidationAction;
use App\Http\Actions\User\DeleteAction;
use App\Http\Actions\User\MeAction;
use Illuminate\Support\Facades\Route;

Route::get('/status', StatusAction::class);

Route::middleware(['web'])->group(function () {
    Route::prefix('auth')
        ->middleware(['throttle:6,1'])
        ->group(function () {
            Route::post('/magic-link', MagicLinkAuthenticationAction::class)->middleware('api.quest');
            Route::post('/magic-link/validate', MagicLinkValidationAction::class);

            Route::post('/logout', LogoutAction::class)->middleware('auth');
        });

    Route::prefix('user')
        ->middleware('auth')
        ->group(function () {
            Route::get('/me', MeAction::class);
            Route::post('/delete', DeleteAction::class);
        });
});
