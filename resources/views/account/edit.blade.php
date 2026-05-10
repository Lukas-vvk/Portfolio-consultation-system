@extends('app')

@section('title', 'Mano paskyra')

@section('content')
    <h1>Mano paskyra</h1>

    @if(session('success'))
        <div style="color:green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('account.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="email">El. paštas:</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div>
            <label for="password">Naujas slaptažodis (neprivaloma):</label>
            <input type="password" name="password">
        </div>

        <div>
            <label for="password_confirmation">Pakartoti slaptažodį:</label>
            <input type="password" name="password_confirmation">
        </div>

        <div>
            <label for="profile_pic">Profilio nuotrauka:</label>
            <input type="file" name="profile_pic" accept="image/*">
        </div>

        @if($user->profile_pic)
            <div>
                <img src="{{ asset('storage/' . $user->profile_pic) }}" alt="Profilio nuotrauka" width="80">
            </div>
        @endif
        <br>
        <button type="submit" class= "btn-view">💾 Išsaugoti</button>
    </form>
@endsection
