@extends('app')

@section('title', 'Konferencijos Peržiūra')

@section('content')
    <h1>{{ $consultation->name }}</h1>
    <p><strong>Data:</strong> {{ $consultation->date }}</p>
    <p><strong>Aprašymas:</strong> {{ $consultation->description }}</p>

    <h2>Užsiregistravę klientai:</h2>
    <ul>
        @foreach($consultation->users as $user)
            <li>{{ $user->name }}</li>
        @endforeach
    </ul>

    <a href="{{ route('teacher.index') }}">
        <button class="btn btn-view">Atgal į konferencijų sąrašą</button>
    </a>
@endsection
