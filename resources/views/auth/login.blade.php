@extends('app')

@section('title', 'Konferencijų sąrašas')

@section('content')
    <h1>Prisijungimo forma</h1>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <label for="email">El. paštas:</label><br>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required><br>
        @error('email')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <label for="password">Slaptažodis:</label><br>
        <input type="password" id="password" name="password" required><br>
        @error('password')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <button type="submit" class="btn-view">Prisijungti</button>
    </form>

@endsection
