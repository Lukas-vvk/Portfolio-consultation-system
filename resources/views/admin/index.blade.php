@extends('app')

@section('title', 'Administracijos puslapis')
<style>
    .admin-buttons {
        display: flex;
        gap: 20px;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    .btn-admin {
        background: linear-gradient(darkslategray, dimgrey);
        color: white;
        padding: 14px 28px;
        font-size: 16px;
        font-weight: 600;
        border: none;
        border-radius: 12px;
        text-decoration: none;
        transition: transform 0.2s ease, box-shadow 0.3s ease;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .btn-admin:visited {
             color: white;

         }

    .btn-admin:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        background: linear-gradient(darkslategray, dimgrey);
        text-decoration: none;
    }
</style>
@section('content')
    <div class="admin-dashboard">
        <h1 class="admin-heading">Administratoriaus posistemis</h1>

        <div class="admin-buttons">
            <a href="{{ route('admin.users.index') }}" class="btn-admin">👤 Sistemos naudotojų valdymas</a>
            <a href="{{ route('admin.consultations.index') }}" class="btn-admin">📅 Konsultacijų valdymas</a>
        </div>
    </div>
@endsection
