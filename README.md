# Agri-GIS

Agri-GIS adalah aplikasi pemetaan lahan pertanian berbasis web yang dikembangkan menggunakan Laravel untuk backend, template Bootstrap untuk tampilan frontend, dan Leaflet.js untuk menampilkan koordinat wilayah.

## Fitur Utama

-   **Manajemen Lahan**: Tambah, edit, dan hapus data lahan.
-   **Pemetaan Koordinat**: Menampilkan batas wilayah lahan menggunakan Leaflet.js.
-   **CRUD Data**: Mengelola data lahan, dusun, dan komoditas.
-   **Validasi Data**: Memastikan input data yang sesuai sebelum disimpan.

## Teknologi yang Digunakan

-   **Backend**: Laravel
-   **Frontend**: Bootstrap
-   **Peta Interaktif**: Leaflet.js
-   **Database**: MySQL (file database tersedia dalam `agri.sql`)

## Instalasi

1. Clone repository ini:

    ```sh
    git clone https://github.com/harunid12/agri-gis.git
    cd agri-gis
    ```

2. Install dependensi menggunakan Composer:

    ```sh
    composer install
    ```

3. Copy file konfigurasi environment:

    ```sh
    cp .env.example .env
    ```

4. Sesuaikan konfigurasi database di `.env` dengan koneksi MySQL yang sesuai.

5. Import database dari file `agri.sql`:

    ```sh
    mysql -u username -p database_name < agri.sql
    ```

6. Generate application key:

    ```sh
    php artisan key:generate
    ```

7. Jalankan server lokal:
    ```sh
    php artisan serve
    ```

Akses aplikasi melalui `http://127.0.0.1:8000`.

## Kontak

Jika ada pertanyaan atau saran, hubungi : [ahmadharun.jambi@gmail.com](mailto:ahmadharun.jambi@gmail.com)
