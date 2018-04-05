<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\bedrijven;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\CreatesCustomUsers;

class CustomRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use CreatesCustomUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function Custom_validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'Bedrijfsnaam' => 'required|string|max:255',
            'Adres' => 'required|string|max:255',
            'Postcode' => 'required|string|max:6|alpha_num', 
            'Telefoonnummer' => 'required|string|max:13',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    protected function CustomDocent_validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function Custom_create(array $data)
    {
        bedrijven::create([
            'naam' => $data['Bedrijfsnaam'], 
            'adres' => $data['Adres'], 
            'postcode' => $data['Postcode'], 
            'telefoonnr' => $data['Telefoonnummer'], 
            'email' => $data['email'], 
        ]);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'rank' => "Bedrijf",
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function Custom_createDocent(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'rank' => "Docent",
        ]);
    }
}