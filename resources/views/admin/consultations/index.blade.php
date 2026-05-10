@extends('app')

@section('title', 'Konferencijų sąrašas')

@section('content')
    <h1>Konferencijų sąrašas</h1>
    <a href="{{ route('admin.consultations.create') }}">
        <button class="btn btn-view">Nauja konferencija</button>
    </a>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Pavadinimas</th>
            <th>Dėstytojas</th>
            <th>Data</th>
            <th>Veiksmai</th>
        </tr>
        @foreach($consultations as $consultation)
            <tr>
                <td>{{ $consultation->id }}</td>
                <td>{{ $consultation->name }}</td>
                <td>{{ $consultation->teacher?->name ?? 'Nepriskirta' }}</td>
                <td>{{ $consultation->date }}</td>
                <td>
                    <a href="{{ route('admin.consultations.edit', $consultation->id) }}">
                        <button class="btn btn-view">Redaguoti</button>
                    </a>
                    <form action="{{ route('admin.consultations.destroy', $consultation->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-view">Ištrinti</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('admin.index') }}">Atgal i pagrindini</a>
@endsection
