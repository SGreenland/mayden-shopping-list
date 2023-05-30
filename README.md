<!-- <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p> -->

## Notes

So I confess I went over the 6 hours on this, probably more like 10 in total.

I couldn't get the tesco API working, think it might not exist anymore? Either way I hard coded some price values and implemented the other story points surrounding that.

I think the only story I didn't do was the email, there are a lot of things I would've liked to do/done differently given more time and would be grateful for the chance to discuss those and how I would've implemented the API should it have worked.

Hopefully all this setup is fairly straightforward and you don't have any issues!



## Run locally

After cloning the project:

#### create a .env file
```sh
cp .env.example .env
```

#### create a .env.testing file
```sh
cp .env.example .env.testing
```

#### install composer dependencies
```sh
composer install
```

#### install npm dependencies
```sh
npm install
```
#### generate a key for your application
```sh
php artisan key:generate
```

#### create a local MySQL database (make sure you have MySQL up and running)
```sh
mysql -u root

> create database {your_db_name};
> exit;
```

#### add the database connection config to your .env file
```sh
DB_CONNECTION=mysql
DB_DATABASE={your_db_name}
DB_USERNAME=root
DB_PASSWORD=
```

Follow the above two steps creating a new test_db and .env.testing config
#### run the migration files to generate the schema
```sh
php artisan migrate
```

#### Serve PHP
```sh
php artisan serve
```
#### Serve JavaScript
```sh
npm run dev
```

### Run Tests
```sh
php artisan test --filter ShoppingListTest
```

