@extends('app')

@section('title', 'Naudotojų valdymas')

@section('content')

    <h1>Naudotojų sąrašas</h1>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Vardas</th>
            <th>El. paštas</th>
            <th>Naudotojo tipas</th>
            <th>Veiksmas</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}">
                        <button class="btn btn-view">Redaguoti</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.index') }}" class="btn btn-secondary mt-3">← Atgal į pagrindinį</a>
@endsection
