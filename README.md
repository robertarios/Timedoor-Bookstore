# Timedoor Backend Programming Exam - Bookstore Project

## Project Overview

This project was built using **Laravel 10** and **PHP 8.1** in accordance with the backend programming exam requirements.
The application simulates a simple system to manage books, authors, categories, and customer ratings.

There are three main pages within the exam scope:

1. **Book List with Filter**

    - Displays a list of books with pagination and search feature.
    - Data is sorted based on the highest average rating.

2. **Top 10 Most Famous Authors**

    - Displays a list of the 10 authors with the most voters.
    - Only counts voters with a rating greater than 5.

3. **Input Rating**
    - A form to give a rating for a book.
    - Validation: the selected book must match the selected author.
    - Ratings must be between 1 and 10.

---

## Requirements

-   PHP >= 8.1
-   Laravel >= 10.x
-   MySQL

---

## Installation Steps

1. **Clone repository**

    ```bash
    git clone https://github.com/robertarios/timedoor-bookstore.git
    cd timedoor-bookstore
    ```

2. **Install dependencies**

    ```bash
    composer install
    ```

3. **Copy .env file and configure database**  
    Copy the .env.example file to .env and adjust the following values according to your local database.

    ```bash
    cp .env.example .env
    ```

4. **Generate application key**

    ```bash
    php artisan key:generate
    ```

5. **Run migration and seed data**  
   The seeder will generate:
    - 1000 authors (faker)
    - 3000 categories (faker)
    - 100,000 books (faker)
    - 500,000 ratings (faker)
      This process may take **15–30 minutes**, depending on your computer specifications.

    ```bash
    php artisan migrate --seed
    ```

6. **Run the application**
    ```bash
    php artisan serve
    ```
