<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class AccountController extends Controller
{
    public function edit()
    {
        return view('account.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email' => 'required|email',
            'password' => 'nullable|min:6|confirmed',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('profile_pic')) {
            if ($user->profile_pic) {
                Storage::delete($user->profile_pic);
            }
            $user->profile_pic = $request->file('profile_pic')->store('avatars', 'public');
        }


        $user->save();

        return redirect()->route('account.edit')->with('success', 'Paskyros informacija atnaujinta.');
    }
}
