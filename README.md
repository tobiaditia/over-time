
## GETTING STARTED

    1. Install dependencies
        - Jalankan "composer install"
    2. .env
        - Sesuaikan konfigurasi database pada bagian
            DB_DATABASE=overtime
            DB_USERNAME=root
            DB_PASSWORD=
    2. Database
        - Buat database baru dengan nama misal:"overtime"
        - Jalankan "php artisan migrate"
        - Jalankan "php artisan db:seed"
    3. Run
        - Jalankan "php artisan serve"

## PHP Unit Testing
    1. Jalankan "php artisan test"

## API Documentation
    1. Jalankan "php artisan serve"
    2. Buka tautan "http://127.0.0.1:8000/api/documentation"
