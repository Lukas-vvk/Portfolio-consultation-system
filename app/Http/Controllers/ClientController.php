<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $conferences = Conference::where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->get();

        return view('student.index', compact('conferences'));
    }

    public function show($id)
    {
        $conference = Conference::with('attendees')->findOrFail($id);

        return view('student.show', compact('conference'));
    }

    public function register($id)
    {
        $user = Auth::user();
        $conference = Conference::findOrFail($id);

        if ($conference->users()->where('user_id', $user->id)->exists()) {
            return redirect()->route('student.show', $id)
                ->with('error', 'Jūs jau esate užsiregistravęs į šią konferenciją.');
        }

        $conference->users()->attach($user->id);

        return redirect()->route('student.show', $id)
            ->with('success', 'Sėkmingai užsiregistravote į konferenciją.');
    }
}
