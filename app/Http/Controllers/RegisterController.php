<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'regex:/^[A-ZĄČĘĖĮŠŲŪŽa-ząčęėįšųūž]+(?: [A-ZĄČĘĖĮŠŲŪŽa-ząčęėįšųūž]+)+$/',
                'max:255'
            ],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ], [
            'name.required' => 'Vardas yra privalomas.',
            'name.regex' => 'Vardas turi būti įvestas formatu „Vardas Pavardė“.',
            'email.required' => 'El. paštas yra privalomas.',
            'email.email' => 'Įveskite teisingą el. pašto adresą.',
            'email.unique' => 'Šis el. paštas jau užregistruotas.',
            'password.required' => 'Slaptažodis yra privalomas.',
            'password.min' => 'Slaptažodis turi būti bent 8 simbolių ilgio.',
            'password.confirmed' => 'Slaptažodžiai nesutampa.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'student',
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }
}
