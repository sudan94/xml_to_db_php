# XML Import PHP

The command reads a local XML file, processes its contents, and inserts the data into a database. It also handles errors and logs them accordingly.

## Requirements

- PHP >= 8.*
- Composer
- Laravel 11.x
- MySQL (or any other database of your choice)

## Installation

1. **Clone the repository:**

    ```sh
    git clone https://github.com/sudan94/xml_to_db_php.git
    cd xml_to_db_php
    ```

2. **Install dependencies:**

    ```sh
    composer install
    ```

3. **Create the `.env` file:**

    ```sh
    cp .env.example .env
    ```

4. **Update the `.env` file:**

    Configure your database settings in the `.env` file. You can use any database as you need, just make sure to change in `.env` file. Example, to use MySQL:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=xml_db
    DB_USERNAME=root
    DB_PASSWORD=my-secrete-password
    ```

    Make sure the MySQL database or any other are running:


5. **Run migrations:**

    ```sh
    php artisan migrate
    ```

## How to Run the Program


1. **Run the import command:**

    ```sh
    php artisan import:xml /feed/feed.xml
    ```

2. **Check the database:**

    Verify that the data has been imported into the `items` table in your database.

## Running Tests

1. **Run the tests:**

    The project includes tests to verify the import command functionality. Run the tests using PHPUnit:
    - Test file is in directory /tests/Feature/importXMLTest.php

    ```sh
    php artisan test
    ```

## Logging

Errors encountered during the import process are logged to the default log file specified in your Laravel application's logging configuration.
- log file can be found here storage/logs/laravel.log

## Notes

- Main import function is in app\console\importXML.php
- Migration file is inside directory database\migrations
