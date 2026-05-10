<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\User;  // Add the User model to fetch teachers
use Illuminate\Http\Request;

class AdminConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::all()->map(function ($consultation) {
            if ($consultation->date < now() && $consultation->status === 'planuojama') {
                $consultation->status = 'ivykusi';
                $consultation->save();
            }
            return $consultation;
        });

        return view('admin.consultations.index', compact('consultations'));
    }

    public function create()
    {
        // Fetch all users with the "teacher" role
        $teachers = User::where('role', 'teacher')->get();

        return view('admin.consultations.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'teacher_id' => 'required|exists:users,id',
            'time' => 'required|date_format:H:i',
        ]);

        // Create the consultation and assign the teacher
        Consultation::create([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'teacher_id' => $request->teacher_id,  // Store the selected teacher's ID
            'time' => $request->time,
        ]);

        return redirect()->route('admin.consultations.index')->with('success', 'Konferencija sėkmingai sukurta.');
    }

    public function edit($id)
    {
        $consultation = Consultation::findOrFail($id);

        if ($consultation->date < now()) {
            return redirect()->route('admin.consultations.index')
                ->with('error', 'Negalima redaguoti jau įvykusios konsultacijos.');
        }

        return view('admin.consultations.edit', compact('consultation'));
    }

    public function update(Request $request, $id)
    {
        $consultation = Consultation::findOrFail($id);

        if ($consultation->date < now()) {
            return redirect()->route('admin.consultations.index')
                ->with('error', 'Negalima redaguoti jau įvykusios konsultacijos.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        $consultation->update($request->only(['name', 'description', 'date', 'time']));

        return redirect()->route('admin.consultations.index')->with('success', 'Konsultacija atnaujinta.');
    }

    public function destroy($id)
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->delete();

        return redirect()->route('admin.consultations.index')->with('success', 'Konferencija ištrinta.');
    }
}

