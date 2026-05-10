<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index()
    {
        $teacherId = Auth::id();

        // Gaunamos tik to dėstytojo konsultacijos su registruotais studentais
        $consultations = Consultation::where('teacher_id', $teacherId)
            ->with(['students']) // Kad būtų galima gauti studentų sąrašą
            ->get();

        return view('teacher.index', compact('consultations'));
    }

    public function show($id)
    {
        $consultation = Consultation::with('users')->findOrFail($id);
        return view('teacher.show', ['consultation' => $consultation]);
    }

    public function approveStudent($consultationId, $studentId)
    {
        $consultation = Consultation::findOrFail($consultationId);
        $consultation->users()->updateExistingPivot($studentId, ['is_confirmed' => true]);

        return redirect()->back()->with('success', 'Studentas patvirtintas.');
    }

    public function create(): View
    {
        return view('teacher.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        // Sukuriama nauja konsultacija su priskirtu teacher_id
        Consultation::create([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'time' => $request->time,
            'teacher_id' => auth()->id(), // automatiškai priskiria prisijungusį dėstytoją
        ]);

        return redirect()->route('teacher.index')->with('success', 'Konsultacija sukurta sėkmingai!');
    }
}
