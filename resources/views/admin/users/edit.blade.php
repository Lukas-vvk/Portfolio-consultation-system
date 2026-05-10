@extends('app')

@section('title', 'Naudotojo redagavimas')

@section('content')
    <h1>Redaguoti naudotojo duomenis</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 1rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.edit', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 1rem;">
            <label for="name">Prisijungimo vardas (login):</label><br>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="email">El. paštas:</label><br>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="password">Naujas slaptažodis:</label><br>
            <input type="password" name="password" id="password">
            <p style="font-size: 0.9em; color: gray;">(Palikite tuščią, jei nenorite keisti slaptažodžio)</p>
        </div>

        <button type="submit" class="btn btn-view">💾 Išsaugoti</button>
    </form>

    <a href="{{ route('admin.users.index') }}">← Grįžti į naudotojų sąrašą</a>
@endsection
