@extends('app')

@section('title', 'Sukurti konsultaciją')

@section('content')
    <h1>Sukurti naują konsultaciją</h1>

    <form method="POST" action="{{ route('teacher.store') }}">
        @csrf
        <div>
            <label for="name">Pavadinimas:</label>
            <input type="text" name="name" required>
        </div>

        <div>
            <label for="description">Aprašymas:</label>
            <textarea name="description" required></textarea>
        </div>

        <div>
            <label for="date">Data:</label>
            <input type="date" name="date" required>
        </div>

        <div>
            <label for="time">Laikas:</label>
            <input type="time" name="time" required>
        </div>
        <br>
        <button type="submit" class="btn btn-view">💾 Išsaugoti</button>
    </form>
@endsection
