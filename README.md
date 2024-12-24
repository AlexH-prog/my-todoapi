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

10. Now you can see the simplified task tree (http://localhost:8876/tree-web) in browser based on data that was entered 
into database in step №9. 
11. In step 9, the data of two users are entered randomly and one user with defined data. API routes use Sanctum, 
so you need to log in with the user data below and get an API token.
```php
{
    "email": "test@example.com",
    "password": 1234567
}
```
 12. This [file](https://docs.google.com/document/d/1hJfBsAvBjDpSLonEzSQ3UBIvMJ_oOXSxXJWJMyHSt8Q/edit?tab=t.0)
shows the results of the **my-todoapi** test in Postman.


 
