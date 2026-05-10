@extends('app')

@section('content')
    <h1>Mano konsultacijos</h1>

    {{-- ➕ Mygtukas sukurti naują konsultaciją --}}
    <a href="{{ route('teacher.create') }}">
    <button type="submit" class="btn btn-view">➕ Sukurti konsultaciją</button>
    </a>
    <br>
    @foreach($consultations as $consultation)
        <div class="consultation" style="margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; border-radius: 8px;">
            <h3>{{ $consultation->name }}</h3>
            <p><strong>Aprašymas:</strong> {{ $consultation->description }}</p>
            <p><strong>Laikas:</strong> {{ $consultation->time }}</p>
            <p><strong>Data:</strong> {{ $consultation->date }}</p>

            <h4>Registruoti studentai:</h4>
            <ul>
                @forelse($consultation->students as $student)
                    <li>
                        {{ $student->name }} -
                        @if($student->pivot->is_confirmed)
                            <span style="color:green;">Patvirtinta</span>
                        @else
                            <form action="{{ route('teacher.consultations.approve', [$consultation->id, $student->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn-view">Patvirtinti</button>
                            </form>
                        @endif
                    </li>
                @empty
                    <li>Nėra studentų</li>
                @endforelse
            </ul>
            <td>
                <a href="{{ route('teacher.show', $consultation->id) }}">
                <button type="submit" class="btn btn-view">Peržiūrėti</button>
                </a>
            </td>
        </div>
    @endforeach
@endsection
