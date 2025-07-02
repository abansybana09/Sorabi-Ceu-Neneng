#!/bin/bash

# Jangan masukan komentar dalam kode

PROJECT_PATH="/home/sorabi/Sorabi-Ceu-Neneng"
WEB_USER="www-data"    # Berdasarkan hasil ls -ld dari proyek Laravel yang berhasil (grup web server)
PROJECT_OWNER="www-data" # Mengatur pemilik 'writable' ke www-data agar web server punya full control

if [[ $EUID -ne 0 ]]; then
   echo "Script ini harus dijalankan sebagai root atau dengan sudo."
   exit 1
fi

if [ ! -d "$PROJECT_PATH" ]; then
    echo "Error: Direktori proyek '$PROJECT_PATH' tidak ditemukan."
    exit 1
fi

cd "$PROJECT_PATH" || { echo "Gagal masuk ke direktori proyek."; exit 1; }

echo "Mengatur kepemilikan direktori 'writable' ke $PROJECT_OWNER:$WEB_USER..."
sudo chown -R "$PROJECT_OWNER":"$WEB_USER" writable

echo "Memberikan izin tulis untuk user dan grup pada 'writable' (ug+rwx), dan baca/eksekusi untuk 'others' (775/777)..."
# drwxrwxr-x (775) adalah umum untuk direktori
sudo chmod -R ug+rwx writable
sudo chmod -R o+rx writable # Memastikan 'others' bisa membaca dan masuk ke direktori

echo "Mengatur setgid bit pada 'writable' (g+s)..."
sudo chmod -R g+s writable

echo "Mengatur izin default untuk file (664) dan direktori (775) lainnya pada seluruh proyek..."
# Ini untuk memastikan file lain di luar 'writable' punya izin yang benar
sudo find . -type f -exec chmod 664 {} \;
sudo find . -type d -exec chmod 775 {} \;

# Opsional: Jika Anda ingin agar user 'sorabi' tetap bisa menulis ke seluruh direktori proyek
# Namun, untuk lingkungan produksi, lebih aman jika user web server yang punya kontrol penuh.
# Jika Anda tetap ingin 'sorabi' punya izin tulis di luar 'writable', Anda bisa tambahkan ini:
# sudo chown -R sorabi:www-data "$PROJECT_PATH"
# sudo chmod -R g+s "$PROJECT_PATH"


echo "Memastikan file .env ada..."
if [ ! -f ".env" ]; then
    echo "File .env tidak ditemukan. Menyalin dari 'env'..."
    cp env .env
    echo "PENTING: Harap edit file .env untuk mengkonfigurasi database, baseURL, dll.!"
fi

# CodeIgniter 4 tidak memiliki perintah 'php artisan key:generate' secara default
# Key diatur di file .env (misal: CI_ENCRYPTION_KEY)

echo "Pengaturan permission untuk deployment CodeIgniter 4 selesai."
echo "Pastikan konfigurasi web server (Nginx/Apache) sudah menunjuk ke '$PROJECT_PATH/public'."