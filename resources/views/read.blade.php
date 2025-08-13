@extends('app')

@section('content')
<h2>Data Tabungan</h2>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif
@if(isset($info))
    <div>{{ $info }}</div>
@endif

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

<div>
    <a href="{{ route('edit') }}">Edit Data</a>
    <a href="{{ route('downloadDefault') }}">Download File</a>
</div>
@endsection