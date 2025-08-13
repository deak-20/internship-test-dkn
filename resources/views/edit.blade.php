@extends('app')

@section('content')
<h2 class="mb-3">
    <i class="bi bi-pencil-square"></i> Edit Data
</h2>

<!-- Tombol Kembali di atas tabel -->
<div class="mb-3">
    <a href="{{ $isPicker ? route('filePicker') : route('read') }}" class="btn btn-secondary">
        ⬅ Kembali
    </a>
</div>

<form method="POST" action="{{ $isPicker ? route('filePickerUpdate') : route('update') }}">
    @csrf
    <input type="hidden" name="filePath" value="{{ $filePath }}">

    <!-- Tombol Tambah Baris & Kolom di kanan atas tabel -->
    <div class="table-actions-top">
        <button type="button" class="btn btn-info btn-sm" onclick="addRow()">➕ Tambah Baris</button>
        <button type="button" class="btn btn-warning btn-sm" onclick="addColumn()">➕ Tambah Kolom</button>
    </div>

    <!-- Tabel Edit -->
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle" id="dataTable">
            <thead class="table-dark">
                <tr id="headerRow">
                    @foreach ($headers as $header)
                        <th>
                            <input type="text" name="headers[]" value="{{ $header }}" class="form-control text-center">
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
                                <input type="text" name="data[{{ $rowIndex }}][{{ $colIndex }}]" 
                                    value="{{ $cell }}" class="form-control">
                            </td>
                        @endforeach
                        <td>
                            <button type="button" class="btn btn-outline-danger btn-sm w-100" onclick="removeRow(this)">🗑</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tombol Hapus Kolom di bawah tombol hapus baris -->
    <div class="mt-2">
        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteColumnModal">
            🗑 Hapus Kolom
        </button>
    </div>

    <!-- Tombol Simpan di tengah bawah -->
    <div class="save-btn-container">
        <button type="submit" class="btn btn-success">
            💾 Simpan Perubahan
        </button>
    </div>
</form>

<!-- Modal Hapus Kolom -->
<div class="modal fade" id="deleteColumnModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Hapus Kolom</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <label>Pilih Kolom:</label>
                <select id="columnSelect" class="form-select">
                    @foreach ($headers as $i => $header)
                        <option value="{{ $i }}">{{ $header }}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="deleteColumn()">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
function addRow() {
    let table = document.querySelector('#dataTable tbody');
    let rowCount = table.rows.length;
    let colCount = document.getElementById('headerRow').cells.length - 1;
    let newRow = table.insertRow();

    for (let i = 0; i < colCount; i++) {
        let cell = newRow.insertCell(i);
        cell.innerHTML = `<input type="text" name="data[${rowCount}][${i}]" class="form-control">`;
    }

    let aksiCell = newRow.insertCell(colCount);
    aksiCell.innerHTML = `<button type="button" class="btn btn-outline-danger btn-sm w-100" onclick="removeRow(this)">🗑</button>`;
}

function removeRow(btn) {
    btn.closest('tr').remove();
}

function addColumn() {
    let headerRow = document.getElementById('headerRow');
    let newHeaderIndex = headerRow.cells.length - 1;
    let newHeaderCell = headerRow.insertCell(newHeaderIndex);
    newHeaderCell.innerHTML = `<input type="text" name="headers[]" value="Kolom Baru" class="form-control text-center">`;

    let tbody = document.querySelector('#dataTable tbody');
    for (let rowIndex = 0; rowIndex < tbody.rows.length; rowIndex++) {
        let newCell = tbody.rows[rowIndex].insertCell(newHeaderIndex);
        newCell.innerHTML = `<input type="text" name="data[${rowIndex}][${newHeaderIndex}]" class="form-control">`;
    }
}

function deleteColumn() {
    let colIndex = parseInt(document.getElementById('columnSelect').value);
    document.querySelectorAll('#dataTable tr').forEach(row => {
        if (row.cells.length > colIndex) row.deleteCell(colIndex);
    });
    bootstrap.Modal.getInstance(document.getElementById('deleteColumnModal')).hide();
}
</script>
@endsection
