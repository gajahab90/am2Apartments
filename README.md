Requirements: 
- php 7.3
- MySql 8.0
- Redis 3.2

Configuration and quick start

1. Clone project
2. Create .env file from .env.example
3. Create MySql database and configure DB connection params in .env
4. run: composer install
5. run: php artisan key:generate
6. run: php artisan migrate
7. run: php artisan db:seed
8. run: php artisan schedule:work (for local use, else configure cron on server like "* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
")
9. Get https://fixer.io/ API Key and configure in .env

Routes:
- /api/register               method: POST
- /api/login                  method: POST
- /api/logout                 method: POST
- /api/apartments             method: POST, GET, PATCH/PUT, DELETE
- /api/apartments/search      method: GET
- /api/categories             method: POST, GET, PATCH/PUT, DELETE
- /api/rating                 method: POST
