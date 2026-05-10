<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Konsultacijų sistema')</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <style>
        .btn-nav:visited {
            color: white;
        }
        .btn-nav:hover {
            text-decoration: none;
            color: #888888;
        }
        .btn-nav {
            font-size: 18px;
        }
        nav {
            background-color: #1c322a;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-view {
            background-color: #1f3a3a;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-view:hover {
            background-color: #2b5050;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            text-decoration: none;
            color: #a5a4a4;
        }

        .bg-success {
            background-color: #0f5132;
            border-radius: 5px;
        }

        .bg-warning {
            background-color: #ac8312;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<nav>
    <div class="logo" style="font-size: 22px; font-weight: bold;">
        <a href="{{ route('home') }}" style="color: white; text-decoration: none;">VVK</a>
    </div>
    <ul>
        @auth
            @if(Auth::user()->role === 'student')
                <li><a href="{{ route('student.index') }} " class="btn-nav">🎓 Studentams</a></li>
            @elseif(Auth::user()->role === 'teacher')
                <li><a href="{{ route('teacher.index') }}" class="btn-nav">👨‍🏫 Dėstytojams</a></li>
            @elseif(Auth::user()->role === 'admin')
                <li><a href="{{ route('student.index') }}" class="btn-nav">🎓 Studentams</a></li>
                <li><a href="{{ route('teacher.index') }}" class="btn-nav">👨‍🏫 Dėstytojams</a></li>
                <li><a href="{{ route('admin.index') }}" class="btn-nav">🛠️ Administratoriui</a></li>
            @endif
        @endauth
    </ul>

    <div class="user-info" style="display: flex; align-items: center; gap: 15px;">
        @auth
            {{-- Rodyti profilio nuotrauką arba numatytą paveikslėlį --}}
            <a href="{{ route('account.edit') }}">
                @if(Auth::user()->profile_pic)
                    <img src="{{ asset('storage/' . Auth::user()->profile_pic) }}" alt="Profilio nuotrauka" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                @else
                    <img src="{{ asset('images/default-picture.jpeg') }}" alt="Numatyta nuotrauka" style="width: 40px; height: 40px; border-radius: 50%;">
                @endif
            </a>

            {{-- Vartotojo vardas ir atsijungimas --}}
            <span>{{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">🚪 Atsijungti</button>
            </form>
        @else
            <a href="{{ route('login') }}">🔐 Prisijungti</a>
            <a href="{{ route('register') }}">✍️ Registruotis</a>
        @endauth
    </div>
</nav>

<div class="container">
    {{-- Flash messages --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</div>

<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
</body>
</html>
