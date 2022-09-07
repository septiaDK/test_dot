Aplikasi admin panel dengan fitur login dan CRUD 1 data yg mempunya relasi dengan menggunakan HTML CSS, PHP Laravel, MySQL, dan blade

Tata cara install 
1. Silahkan download ZIP atau menggunakan perintah git clone {{url project}} 
2. Setelah project telah terekstrak atau sudah di clone, masuk ke folder project nya, jalankan perintah :
  
   composer install
   
3. rename file .env_dev menjadi .env
4. Jalankan perintah

   php artisan config:cache
   
5. Setelah itu jalankan perintah untuk membuat tabel dan data dummy user

   php artisan migrate:fresh --seed
   
6. untuk menjalankan aplikasi, jalankan perintah :

   npm install
   
   npm run build

   php artisan serve


Data User untuk Login
email : admin@example.com
password : admin123
