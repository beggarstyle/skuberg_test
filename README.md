## วิธีติดตั้ง

1.ก้อปปี้โปรเจคลงใน workspace ด้วยคำสั่ง
```
git clone --recurse-submodules https://github.com/beggarstyle/skuberg_test.git
```
2.เข้าไปในโฟลเดอร์ skuberg_test

```
cd skuberg_test
```
3.ก้อปปี้ไฟล์ .env เพื่อใช้ในการตั้งค่าในระบบ
```
cp .env.example .env
```
4.แก้ไขข้อมูลสำหรับการเชือมต่อกับฐานข้อมูล mysql ในไฟล์ .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
5.สร้างคีย์สำหรับโปรเจค laravel
```
php artisan key:generate
```
6.ติดตั้ง package สำหรับ laravel
```
composer install
```
7.เริ่ม server
```
php artisan server
```

#### ใช้งานกับ Laradock
```
cd laradock
```

ก๊อปปี้ .env ขึ้นด้วยคำสั่ง

```
cp .env.example .env
```

รัน docker-compose ด้วยคำสั่ง
```
docker-compose up -d nginx mysql phpmyadmin
```
shell เข้า container ของ workspace ด้วย user laradock

```
docker exec -it -u laradock $(docker ps -a -q --filter="name=workspace")
```