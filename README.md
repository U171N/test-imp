Cara Menjalankan Program:

1.Ketik Command:composer install

2.Ketik Command:php artisan key:generate

3.Setting file .env sesuai database yang akan digunakan

4.Buat Database sesuai nama yang sudah di setting pada file .env tersebut

5.ketik command:php artisan migrate

6.Ketik Command:php aritsan db:seed --class=SubTaskSeeder (untuk mendapatkan kategori task)
