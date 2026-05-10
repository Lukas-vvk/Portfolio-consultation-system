@extends('app')

@section('title', 'Konsultacijų valdymo sistema')

@section('content')
    <div class="dashboard" style="text-align: center; padding: 40px 20px;">
        <h1 style="font-size: 36px; margin-bottom: 10px;">Sveiki atvykę į Konsultacijų valdymo sistemą!</h1>
        <p style="font-size: 18px; color: #555;">Čia galite registruotis į konsultacijas, jas kurti arba administruoti.</p>

        <div style="margin-top: 40px; display: flex; justify-content: center; gap: 30px; flex-wrap: wrap;">
            @auth
                @if(Auth::user()->hasRole('student'))
                    <a href="{{ route('student.index') }}">
                    <button class="btn btn-view">📘 Peržiūrėti konsultacijas</button>
                    </a>
                @elseif(Auth::user()->hasRole('teacher'))
                    <a href="{{ route('teacher.index') }}">
                    <button class="btn btn-view">👨‍🏫 Mano konsultacijos</button>
                    </a>
                @elseif(Auth::user()->hasRole('admin'))
                    <a href="{{ route('admin.index') }}">
                    <button class="btn btn-view">⚙️ Administratoriaus valdymas</button>
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}">🔐 Prisijungti</a>
                <a href="{{ route('register') }}">✍️ Registruotis</a>
            @endauth
        </div>

        <div style="margin-top: 60px;">
            <img src="https://cdn-icons-png.flaticon.com/512/4341/4341139.png" alt="Consultation Icon" width="100">
            <p style="margin-top: 20px; font-size: 14px; color: #888;">Sistema skirta efektyviai valdyti studentų ir dėstytojų konsultacijas.</p>
        </div>
    </div>
@endsection
