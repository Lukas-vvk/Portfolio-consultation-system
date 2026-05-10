@extends('app')

@section('title', 'Konsultacijų kalendorius')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Pasirinkite datą</h1>

        <form method="GET" action="{{ route('student.index') }}" class="mb-4 row g-2">
            <div class="col-auto">
                <input type="date" name="date" value="{{ request('date', now()->toDateString()) }}" min="{{ now()->toDateString() }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-view">Filtruoti</button>
            </div>
        </form>

        <h2 class="mb-3">Konsultacijos {{ request('date', now()->toDateString()) }} dieną</h2>

        @if($consultations->isEmpty())
            <div class="alert alert-info">Nėra konsultacijų.</div>
        @else
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                    <th>Pavadinimas</th>
                    <th>Data</th>
                    <th>Laikas</th>
                    <th>Dėstytojas</th>
                    <th>Statusas</th>
                    <th>Veiksmai</th>
                </tr>
                </thead>
                <tbody>
                @foreach($consultations as $consultation)
                    <tr>
                        <td>{{ $consultation->name }}</td>
                        <td>{{ $consultation->date }}</td>
                        <td>{{ $consultation->time }}</td>
                        <td>{{ $consultation->teacher?->name ?? 'Nepriskirta' }}</td>
                        <td>
                            @php
                                $registration = $consultation->users()->where('user_id', Auth::id())->first();
                            @endphp

                            @if(!$registration)
                                <form method="POST" action="{{ route('student.register', $consultation->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-view">Registruotis</button>
                                </form>
                            @elseif($registration->pivot->is_confirmed)
                                <span class="badge bg-success">Patvirtinta</span>
                            @else
                                <span class="badge bg-warning text-dark">Laukia patvirtinimo</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('student.show', ['id' => $consultation->id, 'date' => request('date')]) }}">
                            <button class="btn btn-view">Peržiūrėti</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
