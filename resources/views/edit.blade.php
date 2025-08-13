@extends('layouts.app')

@section('content')
<h2 class="mb-4">✏ Edit Data Tabungan</h2>

<form method="POST" action="{{ route('update') }}" id="editForm">
    @csrf
    <div class="table-responsive shadow-sm">
        <table class="table table-bordered align-middle" id="dataTable">
            <thead class="table-dark">
                <tr id="headerRow">
                    @foreach ($headers as $headerIndex => $header)
                        <th>
                            <input type="text" name="headers[]" value="{{ $header }}" class="form-control">
                        </th>
                    @endforeach
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $rowIndex => $row)
                    <tr>
                        @foreach ($row as $colIndex => $cell)
                            <td>
                                <input type="text" name="data[{{ $rowIndex }}][{{ $colIndex }}]" value="{{ $cell }}" class="form-control">
                            </td>
                        @endforeach
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">🗑 Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex gap-2 mt-3">
        <button type="button" class="btn btn-info" onclick="addRow()">➕ Tambah Baris</button>
        <button type="button" class="btn btn-warning" onclick="addColumn()">➕ Tambah Kolom</button>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-success">💾 Simpan</button>
        <a href="{{ route('read') }}" class="btn btn-secondary">⬅ Kembali</a>
    </div>
</form>

@section('scripts')
<script>
    function addRow() {
        let table = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
        let rowCount = table.rows.length;
        let colCount = document.getElementById('headerRow').cells.length - 1; // exclude aksi

        let newRow = table.insertRow();
        for (let i = 0; i < colCount; i++) {
            let cell = newRow.insertCell(i);
            cell.innerHTML = `<input type="text" name="data[${rowCount}][${i}]" class="form-control">`;
        }
        let aksiCell = newRow.insertCell(colCount);
        aksiCell.innerHTML = `<button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">🗑 Hapus</button>`;
    }

    function removeRow(button) {
        button.closest('tr').remove();
    }

    function addColumn() {
        let headerRow = document.getElementById('headerRow');
        let newHeaderIndex = headerRow.cells.length - 1; // before "Aksi"
        let newHeaderCell = headerRow.insertCell(newHeaderIndex);
        newHeaderCell.innerHTML = `<input type="text" name="headers[]" value="Kolom Baru" class="form-control">`;

        let tbody = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
        for (let rowIndex = 0; rowIndex < tbody.rows.length; rowIndex++) {
            let newCell = tbody.rows[rowIndex].insertCell(newHeaderIndex);
            newCell.innerHTML = `<input type="text" name="data[${rowIndex}][${newHeaderIndex}]" class="form-control">`;
        }
    }
</script>
@endsection
@endsection
