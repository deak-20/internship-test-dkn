@extends('app')

@section('content')
<h2>Pilih File TXT</h2>

@if(session('error'))
    <div>{{ session('error') }}</div>
@endif

<form action="{{ route('filePickerRead') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="txt_file">Pilih File (.txt)</label>
        <input type="file" name="txt_file" id="txt_file" accept=".txt" required>
    </div>
    <button type="submit">Lihat Data</button>
</form>
@endsection