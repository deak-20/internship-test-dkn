<!DOCTYPE html>
<html>
<head>
    <title>{{ $title ?? 'Data Tabungan' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <nav>
        <h3>🏦 Bank Tabungan</h3>
        <a href="{{ route('read') }}">Data Default</a> | 
        <a href="{{ route('filePicker') }}">Pilih File</a>
        <hr>
    </nav>

    <div>
        @yield('content')
    </div>
</body>
</html>