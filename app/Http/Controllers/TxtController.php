<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TxtController extends Controller
{
    private function getFilePath()
    {
        return base_path('data/data.txt');
    }

    private function readFile($filePath = null)
    {
        $filePath = $filePath ?? $this->getFilePath();
        if (!file_exists($filePath)) {
            return [[], []];
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (empty($lines)) {
            return [[], []];
        }

        $headers = explode('|', array_shift($lines));
        $data = array_map(fn($line) => explode('|', $line), $lines);

        return [$headers, $data];
    }

    // 1. Data Default
    public function read()
    {
        [$headers, $data] = $this->readFile();
        return view('read', compact('headers', 'data'));
    }

    public function edit()
    {
        [$headers, $data] = $this->readFile();
        return view('edit', compact('headers', 'data'));
    }

    public function update(Request $request)
    {
        $headers = $request->input('headers', []);
        $data = $request->input('data', []);

        $lines = [];
        $lines[] = implode('|', $headers);
        foreach ($data as $row) {
            $lines[] = implode('|', $row);
        }

        file_put_contents($this->getFilePath(), implode("\n", $lines));
        return redirect()->route('read')->with('success', 'Data berhasil diperbarui!');
    }

    public function downloadDefault()
    {
        return Response::download($this->getFilePath(), 'data.txt');
    }

    // 2. File Picker
    public function filePicker()
    {
        return view('file_picker');
    }

    public function filePickerRead(Request $request)
    {
        if (!$request->hasFile('txt_file')) {
            return redirect()->back()->with('error', 'Tidak ada file yang diupload.');
        }

        $file = $request->file('txt_file');
        if ($file->getClientOriginalExtension() !== 'txt') {
            return redirect()->back()->with('error', 'File harus berformat .txt');
        }

        $path = $file->storeAs('uploads', $file->getClientOriginalName());
        [$headers, $data] = $this->readFile(storage_path('app/' . $path));

        return view('file_picker', [
            'headers' => $headers,
            'data' => $data,
            'file_path' => storage_path('app/' . $path)
        ]);
    }

    public function filePickerUpdate(Request $request)
    {
        $filePath = $request->input('file_path');
        $data = $request->input('data', []);
        $headers = $request->input('headers', []);

        $lines = [];
        if (!empty($headers)) {
            $lines[] = implode('|', $headers);
        }
        foreach ($data as $row) {
            $lines[] = implode('|', $row);
        }

        file_put_contents($filePath, implode("\n", $lines));
        return redirect()->route('filePicker')->with('success', 'File berhasil diperbarui & disimpan.');
    }

    public function filePickerDownload(Request $request)
    {
        $path = $request->query('path');
        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
        return Response::download($path, basename($path));
    }
}
