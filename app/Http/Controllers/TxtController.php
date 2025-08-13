<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TxtController extends Controller
{
    private function getDefaultFilePath()
    {
        return base_path('data/data.txt');
    }

    private function readFile($filePath)
    {
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

    private function writeFile($headers, $data, $filePath)
    {
        $lines = [];
        $lines[] = implode('|', $headers);
        foreach ($data as $row) {
            $lines[] = implode('|', $row);
        }
        file_put_contents($filePath, implode("\n", $lines));
    }

    // ================= DEFAULT FILE =================
    public function read()
    {
        [$headers, $data] = $this->readFile($this->getDefaultFilePath());
        return view('read', compact('headers', 'data'));
    }

    public function edit()
    {
        [$headers, $data] = $this->readFile($this->getDefaultFilePath());
        return view('edit', [
            'headers' => $headers,
            'data' => $data,
            'filePath' => $this->getDefaultFilePath(),
            'isPicker' => false
        ]);
    }

    public function update(Request $request)
    {
        $headers = $request->input('headers', []);
        $data = $request->input('data', []);
        $this->writeFile($headers, $data, $this->getDefaultFilePath());
        return redirect()->route('read')->with('success', 'Data berhasil diperbarui!');
    }

    public function downloadDefault()
    {
        return response()->download($this->getDefaultFilePath(), 'data_tabungan.txt');
    }

    // ================= FILE PICKER (VIEW ONLY) =================
    public function filePicker()
    {
        return view('file_picker');
    }

    public function filePickerRead(Request $request)
    {
        if (!$request->hasFile('txt_file')) {
            return back()->with('error', 'Pilih file terlebih dahulu.');
        }

        $file = $request->file('txt_file');
        if ($file->getClientOriginalExtension() !== 'txt') {
            return back()->with('error', 'File harus berformat .txt');
        }

        // Gunakan path asli file upload
        $filePath = $file->getRealPath();

        [$headers, $data] = $this->readFile($filePath);

        return view('file_picker_view', compact('headers', 'data'));
    }
}
