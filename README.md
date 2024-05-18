## Setup Guide

### Dependencies

1. **NPM (Node Package Manager)**
   
   Download and install Node.js from https://nodejs.org/

2. **Composer**
   
   Download and install Composer from https://getcomposer.org/

3. **PostgreSQL**
   
   Download and install PostgreSQL from https://www.postgresql.org/download/

### Create a Database in PostgreSQL

1. Open a database manager (E.G: DBeaver, pgAdmin) or use a terminal.
2. Create a new postgres database for your Laravel project.

### Install Laravel

1. Open a command prompt or terminal.
2. Navigate to the project directory:

    ```sh
    cd project-name
    ```

3. Run the following command to install PHP dependencies:

    ```sh
    composer install
    ```

4. Run the following command to install JavaScript dependencies:

    ```sh
    npm install
    ```

### Configure Environment Variables

1. Make a copy of the `.env.example` file:

2. Open the `.env` file in a text editor and update the following lines to configure your PostgreSQL database connection:

    ```env
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```
3. In database.php, change the default connection to postgres

```php 'default' => env('DB_CONNECTION', 'pgsql'),
```
### Generate Application Key

1. Run the following command to generate the application key:

    ```sh
    php artisan key:generate
    ```

### Run Migrations

1. Run the following command to create the necessary database tables:

    ```sh
    php artisan migrate
    ```

### Serve the Application
1. Run the following command to build NPM:
   
   ```sh
    npm run dev
    ```
 
3. Open a new terminal and run the following command to start the Laravel development server:

    ```sh
    php artisan serve
    ```

4. Open your web browser and navigate to `http://localhost:8000` to see your Laravel application in action.
