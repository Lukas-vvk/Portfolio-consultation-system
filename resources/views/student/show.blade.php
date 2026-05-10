@extends('app')

@section('title', $consultation->name)

@section('content')
    <div class="title">
        <h1>{{ $consultation->name }}</h1>
        <p><strong>Aprašymas: </strong>{{ $consultation->description }}</p>
        <p><strong>Data: </strong>{{ $consultation->date }}</p>
        <a href="{{ route('student.index', ['date' => request('date')]) }}">
            <button class="btn btn-view">Atgal</button>
        </a>
    </div>
@endsection
