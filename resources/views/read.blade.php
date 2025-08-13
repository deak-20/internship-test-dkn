@extends('app')

@section('content')
<h2>Data Tabungan</h2>

@if(session('success'))
    <p><strong>✓ {{ session('success') }}</strong></p>
@endif
@if(isset($info))
    <p><em>ℹ {{ $info }}</em></p>
@endif

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr bgcolor="#f0f0f0">
            @foreach ($headers as $header)
                <th>{{ $header }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                @foreach ($row as $cell)
                    <td align="center">{{ $cell }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

<br>
<p>
    <a href="{{ route('edit') }}">📝 Edit Data</a> | 
    <a href="{{ route('downloadDefault') }}">📥 Download File</a>
</p>
@endsection