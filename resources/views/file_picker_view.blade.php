@extends('app')

@section('content')
<h2>Hasil Pembacaan File</h2>

@if(empty($headers) || empty($data))
    <div>File kosong atau format tidak sesuai.</div>
@else
    <table border="1">
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    @foreach ($row as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<div>
    <a href="{{ route('filePicker') }}">Kembali</a>
</div>
@endsection