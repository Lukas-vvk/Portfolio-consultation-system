<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Nauja registracija į konsultaciją</title>
</head>
<body>
<h2>Studentas {{ $student->name }} užsiregistravo į Jūsų konsultaciją</h2>
<p><strong>Konsultacija:</strong> {{ $consultation->name }}</p>
<p><strong>Data:</strong> {{ $consultation->date }}</p>
<p><strong>Laikas:</strong> {{ $consultation->time }}</p>

<p>Norėdami patvirtinti šį studentą, prisijunkite prie sistemos.</p>
</body>
</html>
