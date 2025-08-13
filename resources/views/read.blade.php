@extends('layouts.app')

@section('content')
<h2 class="mb-4">📄 Data Tabungan</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive shadow-sm">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
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
</div>

<div class="mt-3">
    <a href="{{ route('edit') }}" class="btn btn-warning">✏ Edit Data</a>
    <a href="{{ route('downloadDefault') }}" class="btn btn-success">⬇ Download File</a>
</div>
@endsection
