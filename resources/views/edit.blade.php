@extends('app')

@section('content')
<h2>Edit Data</h2>

<div>
    <a href="{{ $isPicker ? route('filePicker') : route('read') }}">Kembali</a>
</div>

<form method="POST" action="{{ $isPicker ? route('filePickerUpdate') : route('update') }}">
    @csrf
    <input type="hidden" name="filePath" value="{{ $filePath }}">

    <div>
        <button type="button" onclick="addRow()">Tambah Baris</button>
        <button type="button" onclick="addColumn()">Tambah Kolom</button>
    </div>

    <table id="dataTable" border="1">
        <thead>
            <tr id="headerRow">
                @foreach ($headers as $header)
                    <th>
                        <input type="text" name="headers[]" value="{{ $header }}">
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
                            <input type="text" name="data[{{ $rowIndex }}][{{ $colIndex }}]" value="{{ $cell }}">
                        </td>
                    @endforeach
                    <td>
                        <button type="button" onclick="removeRow(this)">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        <button type="button" onclick="showDeleteColumnModal()">Hapus Kolom</button>
    </div>

    <div>
        <button type="submit">Simpan Perubahan</button>
    </div>
</form>

<div id="deleteColumnModal" style="display:none;">
    <div>
        <h5>Hapus Kolom</h5>
        <label>Pilih Kolom:</label>
        <select id="columnSelect">
            @foreach ($headers as $i => $header)
                <option value="{{ $i }}">{{ $header }}</option>
            @endforeach
        </select>
        <button type="button" onclick="deleteColumn()">Hapus</button>
        <button type="button" onclick="hideDeleteColumnModal()">Batal</button>
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
        cell.innerHTML = `<input type="text" name="data[${rowCount}][${i}]">`;
    }

    let aksiCell = newRow.insertCell(colCount);
    aksiCell.innerHTML = `<button type="button" onclick="removeRow(this)">Hapus</button>`;
}

function removeRow(btn) {
    btn.closest('tr').remove();
}

function addColumn() {
    let headerRow = document.getElementById('headerRow');
    let newHeaderIndex = headerRow.cells.length - 1;
    let newHeaderCell = headerRow.insertCell(newHeaderIndex);
    newHeaderCell.innerHTML = `<input type="text" name="headers[]" value="Kolom Baru">`;

    let tbody = document.querySelector('#dataTable tbody');
    for (let rowIndex = 0; rowIndex < tbody.rows.length; rowIndex++) {
        let newCell = tbody.rows[rowIndex].insertCell(newHeaderIndex);
        newCell.innerHTML = `<input type="text" name="data[${rowIndex}][${newHeaderIndex}]">`;
    }
}

function showDeleteColumnModal() {
    document.getElementById('deleteColumnModal').style.display = 'block';
}

function hideDeleteColumnModal() {
    document.getElementById('deleteColumnModal').style.display = 'none';
}

function deleteColumn() {
    let colIndex = parseInt(document.getElementById('columnSelect').value);
    document.querySelectorAll('#dataTable tr').forEach(row => {
        if (row.cells.length > colIndex) row.deleteCell(colIndex);
    });
    hideDeleteColumnModal();
}
</script>
@endsection