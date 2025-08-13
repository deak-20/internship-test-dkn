@extends('app')

@section('content')
<h2>Pilih File TXT</h2>

@if(session('error'))
    <p><strong>❌ {{ session('error') }}</strong></p>
@endif

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <td>
            <form action="{{ route('filePickerRead') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <p>
                    <label for="txt_file"><strong>Pilih File (.txt):</strong></label><br>
                    <input type="file" name="txt_file" id="txt_file" accept=".txt" required>
                </p>
                <p>
                    <button type="submit">🔍 Lihat Data</button>
                </p>
            </form>
        </td>
    </tr>
</table>
@endsection