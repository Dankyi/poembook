# PoemBook

An advanced web application built with Laravel framework to illustrate CRUD operations.

## Setup/Configuration
1. Clone repo
2. `$ composer install`
3. `$ npm install`
4. `$ npm run dev`
5. `$ cp .env.example .env`

The following settings are required:

- A database connection, with username and password. 
  MySQL or MariaDB are fine. [XAMPP](https://www.apachefriends.org/index.html)
  recommended.
- Configure database and mail in .env file, as well as setup Google and Github OAuths.
  
## Initialisation

1. `$ php artisan key:generate`

2. `$ php artisan migrate:fresh --seed`

## Startup

`$ php artisan serve`

App will be available at the URI displayed.