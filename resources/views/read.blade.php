@extends('app')

@section('content')
<h2 class="mb-4"><i class="bi bi-table"></i> Data Tabungan</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(isset($info))
    <div class="alert alert-info">{{ $info }}</div>
@endif

<table class="table table-bordered table-striped text-center">
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

<a href="{{ route('edit') }}" class="btn btn-warning">
    <i class="bi bi-pencil-square"></i> Edit Data
</a>
<a href="{{ route('downloadDefault') }}" class="btn btn-success">
    <i class="bi bi-download"></i> Download File
</a>
@endsection
