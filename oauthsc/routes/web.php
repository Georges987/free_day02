<?php

use App\Http\Controllers\UserManageController;
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
    Route::get('/dashboard', [UserManageController::class, 'index'])->name('dashboard');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/auth/redirect/github', function () {
        return Socialite::driver('github')->redirect();
    })->name('github.redirect');

    Route::get('/auth/callback/github', function () {
        $githubUser = Socialite::driver('github')->user();

        $user = User::where('email', $githubUser->email)->first();

        // if the user have basic auth, we will update the user with github info
        if ($user && $user->is_basic_auth) {
            $user->update([
                'github_id' => $githubUser->id,
                'github_token' => $githubUser->token,
                'github_refresh_token' => $githubUser->refreshToken,
                'profile_photo_path' => $githubUser->avatar,
            ]);

            Auth::login($user);

            return redirect('/dashboard');
        }
        else
        {
            $user = User::updateOrCreate([
                'email' => $githubUser->email,
            ], [
                'name' => $githubUser->name,
                'github_id' => $githubUser->id,
                'password' => bcrypt(Str::random(16)),
                'github_token' => $githubUser->token,
                'github_refresh_token' => $githubUser->refreshToken,
                'profile_photo_path' => $githubUser->avatar,
            ]);
        }

        Auth::login($user);

        return redirect('/dashboard');
    });


    Route::get('/auth/redirect/google', function () {
        return Socialite::driver('google')->redirect();
    })->name('google.redirect');

    Route::get('/auth/callback/google', function () {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->email)->first();

        // if the user have basic auth, we will update the user with google info
        if ($user && $user->is_basic_auth) {
            $user->update([
                'google_id' => $googleUser->id,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'profile_photo_path' => $googleUser->avatar,
            ]);

            Auth::login($user);

            return redirect('/dashboard');
        }
        else
        {
            $user = User::updateOrCreate([
                'email' => $googleUser->email,
            ], [
                'name' => $googleUser->name,
                'google_id' => $googleUser->id,
                'password' => bcrypt(Str::random(16)),
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'profile_photo_path' => $googleUser->avatar,
            ]);
        }

        Auth::login($user);

        return redirect('/dashboard');
    });

    Route::get('/auth/redirect/facebook', function () {
        return Socialite::driver('facebook')->redirect();
    })->name('facebook.redirect');

    Route::get('/auth/callback/facebook', function () {
        $facebookUser = Socialite::driver('facebook')->user();

        $user = User::where('email', $facebookUser->email)->first();

        // if the user have basic auth, we will update the user with facebook info
        if ($user && $user->is_basic_auth) {
            $user->update([
                'facebook_id' => $facebookUser->id,
                'facebook_token' => $facebookUser->token,
                'facebook_refresh_token' => $facebookUser->refreshToken,
                'profile_photo_path' => $facebookUser->avatar,
            ]);

            Auth::login($user);

            return redirect('/dashboard');
        }
        else
        {
            $user = User::updateOrCreate([
                'email' => $facebookUser->email,
            ], [
                'name' => $facebookUser->name,
                'facebook_id' => $facebookUser->id,
                'password' => bcrypt(Str::random(16)),
                'facebook_token' => $facebookUser->token,
                'facebook_refresh_token' => $facebookUser->refreshToken,
                'profile_photo_path' => $facebookUser->avatar,
            ]);
        }

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

        $user = User::where('email', $linkedinUser->email)->first();

        // if the user have basic auth, we will update the user with linkedin info
        if ($user && $user->is_basic_auth) {
            $user->update([
                'linkedin_id' => $linkedinUser->id,
                'linkedin_token' => $linkedinUser->token,
                'linkedin_refresh_token' => $linkedinUser->refreshToken,
                'profile_photo_path' => $linkedinUser->avatar,
            ]);

            Auth::login($user);

            return redirect('/dashboard');
        }
        else
        {
            $user = User::updateOrCreate([
                'email' => $linkedinUser->email,
            ], [
                'name' => $linkedinUser->name,
                'linkedin_id' => $linkedinUser->id,
                'password' => bcrypt(Str::random(16)),
                'linkedin_token' => $linkedinUser->token,
                'linkedin_refresh_token' => $linkedinUser->refreshToken,
                'profile_photo_path' => $linkedinUser->avatar,
            ]);
        }

        Auth::login($user);

        return redirect('/dashboard');
    });

    Route::get('/auth/redirect/microsoft', function () {
        return Socialite::driver('microsoft')->redirect();
    })->name('microsoft.redirect');

    Route::get('/auth/callback/microsoft', function () {
        $microsoftUser = Socialite::driver('microsoft')->user();

        $user = User::where('email', $microsoftUser->email)->first();

        // if the user have basic auth, we will update the user with microsoft info
        if ($user && $user->is_basic_auth) {
            $user->update([
                'microsoft_id' => $microsoftUser->id,
                'microsoft_token' => $microsoftUser->token,
                'microsoft_refresh_token' => $microsoftUser->refreshToken,
                'profile_photo_path' => $microsoftUser->avatar,
            ]);

            Auth::login($user);

            return redirect('/dashboard');
        }
        else
        {
            $user = User::updateOrCreate([
                'email' => $microsoftUser->email,
            ], [
                'name' => $microsoftUser->name,
                'microsoft_id' => $microsoftUser->id,
                'password' => bcrypt(Str::random(16)),
                'microsoft_token' => $microsoftUser->token,
                'microsoft_refresh_token' => $microsoftUser->refreshToken,
                'profile_photo_path' => $microsoftUser->avatar,
            ]);
        }

        Auth::login($user);

        return redirect('/dashboard');
    });
});
