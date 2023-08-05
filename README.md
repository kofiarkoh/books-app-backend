## Books App Backend
This is a laravel projects to provide the following APIs for a books app.
- user registration
- user login
- user email verification on sign up with token resending
- user password reset with token resending
- create books *[requires bearer token]*
- read books *[requires bearer token]*
- delete book *[requires bearer token]*
- update book *[requires bearer token]*

The APIs are defined insided `routes/api.php`.


## Project Set Up On Local Machine With mysql
- clone this repository
- `cd` into project directory via your terminal
- create a new `.env` file and copy the contents of `.env.example` to it
- modify the following section of your `.env` file
  ``` 
  DB_DATABASE=your_mysql_database_name
  DB_USERNAME=your_database_username
  DB_PASSWORD=your_database_password
  ```
- run `composer install` to install dependencies
- run `php artisan migrate` to set up database tables
- run `php artisan serve`
- copy the url shown in your terminal
- api endpoints can accessed via `http//yourdomain/api`

## Project Deployment To Live  (Render)
- add this repository in your render account [here](https://dashboard.render.com/)
- create a database in your render account and link it to the project following the [here](https://render.com/docs/deploy-php-laravel-docker)
- all further docker set up has been commit to this repo and should make deployment successfull

- api endpoints can accessed via `http//yourdomain/api`


- For live deployment you may have to update the following server environment variables with appropriate mail server credentials for email otp to work.
```
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```
