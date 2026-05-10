<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El. pašto laukas yra privalomas.',
            'email.email' => 'Įveskite teisingą el. pašto adresą.',
            'password.required' => 'Slaptažodžio laukas yra privalomas.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Naudotojas su tokiu el. paštu neegzistuoja.'])->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Neteisingas slaptažodis.'])->withInput();
        }

        Auth::login($user);

        if ($user->role === 'student') {
            return redirect()->route('student.index');
        } elseif ($user->role === 'teacher') {
            return redirect()->route('teacher.index');
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.index');
        }

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'You have logged out successfull');
    }
}
