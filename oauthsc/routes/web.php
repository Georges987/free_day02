<?php

use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::get('/auth/redirect/github', function () {
    return Socialite::driver('github')->redirect();
})->name('github.redirect');

Route::get('/auth/callback/github', function () {
    $githubUser = Socialite::driver('github')->user();

    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'profile_photo_path' => $githubUser->avatar,
        'password' => bcrypt('TheNexus@7'),
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});


Route::get('/auth/redirect/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.redirect');

Route::get('/auth/callback/google', function () {
    $googleUser = Socialite::driver('google')->user();

    // dd($googleUser);

    $user = User::updateOrCreate([
        'google_id' => $googleUser->id,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'password' => bcrypt('TheNexus@7'),
        'google_token' => $googleUser->token,
        'google_refresh_token' => $googleUser->refreshToken,
        'profile_photo_path' => $googleUser->avatar,
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});

Route::get('/auth/redirect/facebook', function () {
    return Socialite::driver('facebook')->redirect();
})->name('facebook.redirect');

Route::get('/auth/callback/facebook', function () {
    $facebookUser = Socialite::driver('facebook')->user();

    // dd($facebookUser);

    $user = User::updateOrCreate([
        'facebook_id' => $facebookUser->id,
    ], [
        'name' => $facebookUser->name,
        'email' => $facebookUser->email,
        'password' => bcrypt('TheNexus@7'),
        'google_token' => $facebookUser->token,
        'google_refresh_token' => $facebookUser->refreshToken,
        'profile_photo_path' => $facebookUser->avatar,
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});

Route::get('/auth/redirect/linkedin', function () {
    return Socialite::driver('linkedin-openid')
        // ->setScopes([
        //     "openid",
        //     "profile",
        //     "email"
        // ])
        ->redirect();
})->name('linkedin.redirect');


Route::get('/auth/callback/linkedin', function () {
    $linkedinUser = Socialite::driver('linkedin-openid')->user();

    // dd($linkedinUser);

    $user = User::updateOrCreate([
        'google_id' => $linkedinUser->id,
    ], [
        'name' => $linkedinUser->name,
        'email' => $linkedinUser->email,
        'password' => bcrypt('TheNexus@7'),
        'linkedin_token' => $linkedinUser->token,
        'linkedin_refresh_token' => $linkedinUser->refreshToken,
        'profile_photo_path' => $linkedinUser->avatar,
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});
