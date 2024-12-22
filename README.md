###  Quick Start

1. Download and install `Docker Desktop` from https://www.docker.com/products/docker-desktop/

2. Download Repository `my-todoapi` from https://github.com/AlexH-prog/my-todoapi

3. Copy `.env.example` file and create duplicate. Use `cp` command for Linux or Max user.

        cp .env.example .env

   If you are using `Windows`, use `copy` instead of `cp`.

        copy .env.example .env

4. Create a database in MySQL with name `laravel10_dev` and fill the database details `DB_HOST=db`, `DB_PORT=3306`,
   `DB_DATABASE=laravel10_dev`, `DB_USERNAME=root`, `DB_PASSWORD=root` in `.env` file.

5. Start a command prompt window or terminal in the project root folder and enter the docker run  command

            docker-compose up -d

6. Grant permission to change project folders and files

            sudo chmod 777 -R ./

7. Run command that sets the `APP_KEY` value in `.env` file.

          php artisan key:generate

8. Get inside docker container run the command

          docker exec -it project_app bash

9. Make migrations and seed the table with test data

         php artisan migrat:fresh --seed


*********************************************************








<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packa gist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

###  Quick Start

1. Download Repository.


2. Download and install `Node.js` from Nodejs. The suggested version to install is `14.16.x LTS`.


3. Start a command prompt window or terminal and change directory to [unpacked path]:


4. Install the latest `NPM`:

        npm install --global npm@latest


5. To install `Composer` globally, download the installer from https://getcomposer.org/download/ Verify that Composer in successfully installed, and version of installed Composer will appear:

        composer --version


6. Install `Composer` dependencies.

        composer install


7. Install `NPM` dependencies.

        npm install


8. The below command will compile all the assets(sass, js, media) to public folder:

        npm run dev


9. Copy `.env.example` file and create duplicate. Use `cp` command for Linux or Max user.

        cp .env.example .env

   If you are using `Windows`, use `copy` instead of `cp`.

        copy .env.example .env


10. Create a table in MySQL database and fill the database details `DB_DATABASE` in `.env` file.


12. The below command will create tables into database using Laravel migration and seeder.

        php artisan migrate:fresh --seed


13. Generate your application encryption key:

        php artisan key:generate


14. Start the localhost server:

        php artisan serve
