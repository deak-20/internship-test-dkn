@extends('app')

@section('content')
<h2>Edit Data</h2>

<p>
    <a href="{{ $isPicker ? route('filePicker') : route('read') }}">⬅ Kembali</a>
</p>

<form method="POST" action="{{ $isPicker ? route('filePickerUpdate') : route('update') }}">
    @csrf
    <input type="hidden" name="filePath" value="{{ $filePath }}">

    <p>
        <button type="button" onclick="addRow()">➕ Tambah Baris</button>
        <button type="button" onclick="addColumn()">➕ Tambah Kolom</button>
        <button type="button" onclick="showDeleteColumnModal()">🗑 Hapus Kolom</button>
    </p>

    <table id="dataTable" border="1" cellpadding="5" cellspacing="0" width="100%">
        <thead>
            <tr bgcolor="#f0f0f0" id="headerRow">
                @foreach ($headers as $header)
                    <th>
                        <input type="text" name="headers[]" value="{{ $header }}" size="15">
                    </th>
                @endforeach
                <th width="80">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $rowIndex => $row)
                <tr>
                    @foreach ($row as $colIndex => $cell)
                        <td>
                            <input type="text" name="data[{{ $rowIndex }}][{{ $colIndex }}]" value="{{ $cell }}" size="15">
                        </td>
                    @endforeach
                    <td align="center">
                        <button type="button" onclick="removeRow(this)">🗑</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <p align="center">
        <button type="submit">💾 Simpan Perubahan</button>
    </p>
</form>

<div id="deleteColumnModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:white; border:2px solid black; padding:20px;">
    <h4>Hapus Kolom</h4>
    <p>
        <label>Pilih Kolom:</label><br>
        <select id="columnSelect">
            @foreach ($headers as $i => $header)
                <option value="{{ $i }}">{{ $header }}</option>
            @endforeach
        </select>
    </p>
    <p>
        <button type="button" onclick="deleteColumn()">Hapus</button>
        <button type="button" onclick="hideDeleteColumnModal()">Batal</button>
    </p>
</div>

<script>
function addRow() {
    let table = document.querySelector('#dataTable tbody');
    let rowCount = table.rows.length;
    let colCount = document.getElementById('headerRow').cells.length - 1;
    let newRow = table.insertRow();

    for (let i = 0; i < colCount; i++) {
        let cell = newRow.insertCell(i);
        cell.innerHTML = `<input type="text" name="data[${rowCount}][${i}]" size="15">`;
    }

    let aksiCell = newRow.insertCell(colCount);
    aksiCell.align = "center";
    aksiCell.innerHTML = `<button type="button" onclick="removeRow(this)">🗑</button>`;
}

function removeRow(btn) {
    btn.closest('tr').remove();
}

function addColumn() {
    let headerRow = document.getElementById('headerRow');
    let newHeaderIndex = headerRow.cells.length - 1;
    let newHeaderCell = headerRow.insertCell(newHeaderIndex);
    newHeaderCell.innerHTML = `<input type="text" name="headers[]" value="Kolom Baru" size="15">`;

    let tbody = document.querySelector('#dataTable tbody');
    for (let rowIndex = 0; rowIndex < tbody.rows.length; rowIndex++) {
        let newCell = tbody.rows[rowIndex].insertCell(newHeaderIndex);
        newCell.innerHTML = `<input type="text" name="data[${rowIndex}][${newHeaderIndex}]" size="15">`;
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