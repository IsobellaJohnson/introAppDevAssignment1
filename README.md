# intoAppDevAssignment1

**Heroku App URL:** https://introappdev.herokuapp.com/
**Postman API Documentation:** https://documenter.getpostman.com/view/13086928/TzRVeknn

**Setting up the environment for development:**
    1. run laravel, press start all
    2. open database, add 'api' database
    3. cmd + shift + `
    4. composer install
    5. php artisan key:generate
    6. php artisan migrate
    7. php artisan db:seed

**Run API tests:**
    1. cmd + shift + `
    2. ./vendor/bin/phpunit
 
**How to deploy API to Heroku:**
    1. download Heroku CLI
    2. create Procfile, add web: vendor/bin/heroku-php-apache2 public/
    3. cmd + shift + `
    4. heroku create
    5. heroku config:set APP_DEBUG=true
    6. heroku config:set APP_ENV=production
    7. heroku config:set APP_KEY= < app_key >
    8. heroku config:set APP_NAME=Laravel
    9. heroku config:set APP_URL=https://introappdev.herokuapp.com/
    10.heroku addons:create heroku-postgresql:hobby-dev
    11.update config/database to support pgsql
    12.heroku config
    13.add pgsql url to .env file
    14.add, commit and push to heroku