<!DOCTYPE html>
<html>
<head>
    <title>{{ $title ?? 'Data Tabungan' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <nav>
        <div>
            <a href="{{ route('read') }}">🏦 Bank Tabungan</a>
            <a href="{{ route('read') }}">Data Default</a>
            <a href="{{ route('filePicker') }}">Pilih File</a>
        </div>
    </nav>

    <div>
        @yield('content')
    </div>
</body>
</html>