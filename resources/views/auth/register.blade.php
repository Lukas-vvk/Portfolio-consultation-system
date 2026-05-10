@extends('app')

@section('title', 'Konferencijų sąrašas')

@section('content')
    <form action="{{ route('register') }}" method="POST">
        @csrf

        <label for="name">Vardas:</label>
        <input type="text" id="name" name="name" required value="{{ old('name') }}">
        @error('name')
        <div style="color:red;">{{ $message }}</div>
        @enderror
        <br>

        <label for="email">El. paštas:</label>
        <input type="email" id="email" name="email" required value="{{ old('email') }}">
        @error('email')
        <div style="color:red;">{{ $message }}</div>
        @enderror
        <br>

        <label for="password">Slaptažodis:</label>
        <input type="password" id="password" name="password" required>
        @error('password')
        <div style="color:red;">{{ $message }}</div>
        @enderror
        <br>

        <label for="password_confirmation">Patvirtinkite slaptažodį:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        <br>

        <button type="submit" class="btn-view">Registruotis</button>
    </form>

@endsection
