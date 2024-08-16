<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {

        $user = User::where('email', $input['email'])->first();

        if ($user && !$user->is_basic_auth) {
            $user->is_basic_auth = true;
            // update the user password if it has changed
            if (!Hash::check($input['password'], $user->password)) {
                $user->password = Hash::make($input['password']);
            }
            $user->save();

            return $user;
        }

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user->is_basic_auth = true;
        $user->save();
        
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'is_basic_auth' => true,
            'password' => Hash::make($input['password']),
        ]);
    }
}
