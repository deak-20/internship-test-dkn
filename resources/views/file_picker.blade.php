@extends('app')

@section('content')
<h2 class="mb-4"><i class="bi bi-folder2-open"></i> Pilih File TXT</h2>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form action="{{ route('filePickerRead') }}" method="POST" enctype="multipart/form-data" 
      class="p-3 border rounded bg-light shadow-sm">
    @csrf
    <div class="mb-3">
        <label for="txt_file" class="form-label fw-bold">Pilih File (.txt)</label>
        <input type="file" name="txt_file" id="txt_file" accept=".txt" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-search"></i> Lihat Data
    </button>
</form>
@endsection
