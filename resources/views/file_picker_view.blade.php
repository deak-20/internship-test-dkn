@extends('app')

@section('content')
<h2>Hasil Pembacaan File</h2>

@if(empty($headers) || empty($data))
    <p><strong>⚠ File kosong atau format tidak sesuai.</strong></p>
@else
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
@endif

<br>
<p>
    <a href="{{ route('filePicker') }}">⬅ Kembali</a>
</p>
@endsection