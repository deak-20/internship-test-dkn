# Internship Test DKN - Laravel TXT Data App

Aplikasi web sederhana menggunakan **Laravel** untuk membaca, mengedit, dan menyimpan file `.txt` dengan format **pipe-separated values** (`|`).

## 📌 Fitur Utama

1. **Read (`/read`)**

    - Membaca file `data/data.txt` dan menampilkannya dalam bentuk tabel.
    - Nama kolom otomatis diambil dari baris pertama file (bukan hardcode di HTML).

2. **Edit (`/edit`)**

    - Mengubah semua data kecuali baris pertama (nama kolom).
    - Data dapat diubah melalui form HTML.

3. **Update (POST `/edit`)**

    - Menyimpan perubahan data langsung ke file `data/data.txt`.

4. **Bonus: File Picker (`/file-picker`)**
    - Mengunggah file `.txt` dari komputer untuk dibaca (read-only).
    - Format file harus sama dengan file `data/data.txt`.

---

## 📂 Struktur Folder Penting
