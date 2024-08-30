# Installasi laravel

1. buka terminal ketik `composer install`
2. ketik migrate atau bisa langsung pakai sql yang telah saya kirimkan pada gdrive
3. tambahkan .env untuk midtrands

```
MIDTRANS_SERVER_KEY=
MIDTRANS_CLIENT_KEY=
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_3DS=true
MIDTRANS_IS_SANITIZED=true

```

4. ketik `php artisan key:generate` pada terminal
5. terakhir ketik `php artisan serve`
