<!DOCTYPE html>
<html>
<head>
    <title>{{ $title ?? 'Bank Tabungan' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('read') }}">🏦 Bank Tabungan</a>
        <div>
            <a href="{{ route('read') }}" class="btn btn-outline-light btn-sm">Data Default</a>
            <a href="{{ route('edit') }}" class="btn btn-outline-warning btn-sm">Edit</a>
            <a href="{{ route('filePicker') }}" class="btn btn-outline-info btn-sm">Pilih File</a>
        </div>
    </div>
</nav>

<div class="container py-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
