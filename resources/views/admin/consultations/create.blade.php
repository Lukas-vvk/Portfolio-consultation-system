@extends('app')

@section('title', 'Nauja konferencija')

@section('content')
    <h1>Naujos konsultacijos kūrimas</h1>

    <form action="{{ route('admin.consultations.store') }}" method="POST">
        @csrf

        <label for="name">Pavadinimas:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="description">Aprašymas:</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="date">Data:</label>
        <input type="date" id="date" name="date" required><br><br>

        <label for="time">Laikas:</label>
        <input type="time" id="time" name="time" required><br><br>

        <label for="teacher_id">Pasirinkite dėstytoją:</label>
        <select name="teacher_id" id="teacher_id" required>
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
        </select><br><br>

        <button type="submit" class="btn-view btn">Sukurti konsultaciją</button>
    </form>

    <a href="{{ route('admin.consultations.index') }}">Atgal į sąrašą</a>
@endsection
