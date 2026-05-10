<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentRegistered;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', now()->toDateString());

        $consultations = Consultation::whereDate('date', $date)->with('teacher', 'users')->get();

        return view('student.index', compact('consultations'));
    }

    public function show($id)
    {
        $consultation = Consultation::with('attendees')->findOrFail($id);

        return view('student.show', compact('consultation'));
    }

    public function register($id)
    {
        $consultation = Consultation::findOrFail($id);

        // Neleisti registruotis antrą kartą
        if ($consultation->users()->where('user_id', Auth::id())->exists()) {
            return redirect()->back()->with('warning', 'Jūs jau esate užsiregistravęs.');
        }

        $consultation->users()->attach(Auth::id(), ['is_confirmed' => false]);

        // Siunčiam el. laišką dėstytojui
        $teacher = $consultation->teacher;
        $student = Auth::user();

        if ($teacher && $teacher->email) {
            Mail::to($consultation->teacher->email)->send(new StudentRegistered(Auth::user(), $consultation));
        }

        return redirect()->back()->with('success', 'Užsiregistravote. Laukiama dėstytojo patvirtinimo.');
    }
}
