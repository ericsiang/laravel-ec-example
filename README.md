# laravel-ec-example
laravel電商 side project


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

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

#sendgrid
#MAIL_DRIVER=smtp
#MAIL_HOST=smtp.sendgrid.net
#MAIL_PORT=587
#MAIL_USERNAME=
#MAIL_PASSWORD=
#MAIL_ENCRYPTION=tls
#MAIL_FROM_NAME="Eric Chang"
#MAIL_FROM_ADDRESS=eric@eric.eric


FACEBOOK_ID=
FACEBOOK_SECRET=
FACEBOOK_URL=

GOOGLE_ID=
GOOGLE_SECRET=
GOOGLE_URL=

#ECPAY_HASHKEY=
#ECPAY_HASHIV=
ECPAY_RETURN_URL=
```

4.產生laravel 金鑰
```php
php artisan key:generate
```
