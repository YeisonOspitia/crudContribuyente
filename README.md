<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Requirements

1. **Php 8.3.6**
2. **MySql 8.0.3**
2. **Node >20**

## Getting Started

To get started with this project, follow these steps:

1. **Install dependencies:**
    ```bash
    composer install
    npm install
    ```

2. **Set up environment variables:**
    Copy the `.env.example` file to `.env` and update the necessary environment variables.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

3. **Run database migrations and seeders:**
    ```bash
    php artisan migrate --seed
    ```

4. **Start the development server:**
    ```bash
    npm run dev
    ```

5. **Use one of the following users to start:**
    Usuario con todos los privilegios:
        email --> superadmin@example.com  
        password --> password

    Usuario con privilegios limitados    
    email --> admin@example.com
    password --> password
            

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

