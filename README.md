# laravel-ec-example
laravel電商 side project

>#### 實做說明 :
>#### 1.laravel socialite第三方登入(使用FB、GOOGLE)及一般註冊登入
>#### 2.基本電商功能=>新增商品、加入購物車、串接綠界API付費、成立訂單
>#### 3.contact us寄信功能(提供兩種不同寄信方式 mailtrap、sendgrid)

# 準備讓網站動起來

1.先把它 git clone 下來一份，然後照着指令一步一步往下做
```php
git clone https://github.com/ericsiang/laravel-ec-example.git
```

2.再來就是 composer install

```php
composer install
```

3.跑完的話，把.env.example給複製一份存成.env，然後修改.env檔

```php

#我這裡是用mysql DB連線
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

#我這裡是用mailtrap的參數設定
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

#這裡有補上sendgrid的參數設定，有使用sendgrid的可以直接使用
#MAIL_DRIVER=smtp
#MAIL_HOST=smtp.sendgrid.net
#MAIL_PORT=587
#MAIL_USERNAME=
#MAIL_PASSWORD=
#MAIL_ENCRYPTION=tls
#MAIL_FROM_NAME="Eric Chang"
#MAIL_FROM_ADDRESS=eric@eric.eric

#這裡是FB社群登入用的參數
FACEBOOK_ID=
FACEBOOK_SECRET=
FACEBOOK_URL=

#這裡是Google社群登入用的參數
GOOGLE_ID=
GOOGLE_SECRET=
GOOGLE_URL=

#這裡預設是用綠界的測試帳號，要換成正式帳號，可以在這裡設定
#ECPAY_HASHKEY=
#ECPAY_HASHIV=
ECPAY_RETURN_URL=
```

4.產生laravel 金鑰
```php
php artisan key:generate
```

5.產生DB資料表跟產生資料
```php
php artisan migrate

php artisan db:seed
```

6.產生上傳圖片儲存的資料夾
```php
php artisan storage:link
```
會在public資料夾內建立storage資料夾，接著在storage資料夾內手動建立upload_img資料夾
接著將resources\views\ec_tmp\img\shop內的圖片都複製到upload_img資料夾(假資料的圖片顯示)

7.如FB、GOOGLE登入，出現SSL錯誤
請設置php.ini檔內的curl.cainfo ="D:\pem\cacert.pem(絕對路徑)"，可以到https://curl.haxx.se/docs/caextract.html 下載cacert.pem檔

如果還是會出現一樣的錯誤，到vendor\guzzlehttp\guzzle\src\Handler\CurlFactory.php，做下面的修改(在本機才這樣做)

```php

//$conf[CURLOPT_SSL_VERIFYHOST] = 2; //SSL會報錯，因此修改
//$conf[CURLOPT_SSL_VERIFYPEER] = true; //SSL會報錯，因此修改
$conf[CURLOPT_SSL_VERIFYHOST] = 0;
$conf[CURLOPT_SSL_VERIFYPEER] = false;

```

8.啟動laravel
```php
php artisan serve
```