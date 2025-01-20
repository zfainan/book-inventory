## Refactor legacy code

## User

| Username | Password | Jabatan        | 
|----------|----------|----------------| 
| admin    | password | Admin          |  
| operator | password | Kepala Sekolah |  
| peminjam | password | Petugas Perpus | 

## Cara Setup Aplikasi

Untuk menjalankan aplikasi ini, dibutuhkan PHP versi 8.1 dan database MySQL.

1. Install dependensi Composer:

    ```bash
    composer install
    ```

2. Copy file `env.example` dan paste dengan nama `.env`, kemudian sesuaikan isinya (Koneksi database dan lain-lain).

3. Generate app key:

    ```bash
    php artisan key:generate
    ```

4. Jalankan migrasi database:

    ```bash
    php artisan migrate
    ```

5. Jalankan Seeder:

    ```bash
    php artisan db:seed
    ```

6. Isi data dummy (jalankan sekali saja untuk menghindari duplikasi data):

    ```bash
    php artisan db:seed --class=DummySeeder
    ```

7. Jalankan aplikasi:

    ```bash
    php artisan serve
    ```
