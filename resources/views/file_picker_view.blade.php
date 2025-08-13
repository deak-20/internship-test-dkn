@extends('app')

@section('content')
<h2 class="mb-4"><i class="bi bi-table"></i> Hasil Pembacaan File</h2>

@if(empty($headers) || empty($data))
    <div class="alert alert-warning">File kosong atau format tidak sesuai.</div>
@else
    <div class="table-responsive">
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
    </div>
@endif

<a href="{{ route('filePicker') }}" class="btn btn-secondary mt-3">
    <i class="bi bi-arrow-left"></i> Kembali
</a>
@endsection
