<!DOCTYPE html>
<html>
<head>
    <title>{{ $title ?? 'Data Tabungan' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mobile responsive -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Umum */
        body {
            background-color: #f8f9fa;
        }
        h2 {
            font-weight: bold;
        }

        /* Tombol kecil di mobile */
        @media (max-width: 768px) {
            .btn {
                padding: 6px 10px;
                font-size: 14px;
            }
            .table-responsive {
                font-size: 14px;
            }
        }

        /* Untuk tombol di kanan atas tabel */
        .table-actions-top {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            justify-content: flex-end;
            margin-bottom: 10px;
        }

        /* Agar tombol hapus kolom di bawah aksi sejajar */
        td .btn-danger.btn-sm {
            width: 100%;
        }

        /* Tombol simpan di bawah tabel */
        .save-btn-container {
            text-align: center;
            margin-top: 20px;
        }

        /* Input tabel agar tidak terlalu lebar di mobile */
        table input.form-control {
            min-width: 100px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('read') }}">
            <i class="bi bi-bank"></i> Bank Tabungan
        </a>
        <div>
            <a href="{{ route('read') }}" class="btn btn-outline-light btn-sm me-2">Data Default</a>
            <a href="{{ route('filePicker') }}" class="btn btn-outline-info btn-sm">Pilih File</a>
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>
</body>
</html>
