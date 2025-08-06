# imedoor Backend Programming Exam - Bookstore System

## Project Description

This is a simple web application built for managing a bookstore system. The application helps John Doe manage his book collection by providing insights into the most popular books and authors based on customer ratings. Customers can rate books on a scale of 1-10, and the system provides analytics to help improve customer experience.

## Features

- **List of Books with Filter**: View books ordered by average rating with search and pagination
- **Top 10 Most Famous Authors**: Display authors ranked by votes (ratings > 5)
- **Input Rating**: Allow customers to rate books

## Technical Specifications

- **Framework**: Laravel 10.x
- **PHP Version**: 8.1+
- **Database**: MySQL
- **Fake Data Generated**:
  - 1,000 fake authors
  - 3,000 fake book categories
  - 100,000 fake books
  - 500,000 fake ratings

## Requirements

Before installing this project, make sure you have:

- PHP 8.1 or higher
- Composer
- MySQL 5.7 or higher

## Installation Steps

### 1. Clone the Repository

```bash
git clone https://github.com/infinity-dream-code/Backend-Programming-Exam.git
cd Backend-Programming-Exam
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration

Edit your `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookstore
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Create Database

Create a new MySQL database named `bookstore` (or whatever name you specified in .env):

```sql
CREATE DATABASE bookstore_db;
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Seed Database with Fake Data

```bash
php artisan db:seed
```

**Note**: The seeding process may take several minutes as it generates:
- 1,000 authors
- 3,000 book categories
- 100,000 books
- 500,000 ratings

### 8. Start the Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Database Schema

### Tables Structure

- **authors**: id, name, created_at, updated_at
- **categories**: id, name, created_at, updated_at
- **books**: id, author_id, category_id, title, avg_rating, created_at, updated_at
- **ratings**: id, book_id, rating, created_at, updated_at

### Relationships

- Books belong to Authors (one-to-many)
- Books belong to Categories (one-to-many)
- Ratings belong to Books (one-to-many)

## Application Routes

```php
Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/authors-top', [AuthorController::class, 'index'])->name('author.index');
Route::get('/rating/create', [RatingsController::class, 'create'])->name('rating.create');
Route::post('/rating', [RatingsController::class, 'store'])->name('rating.store');
Route::get('/books/by-author/{author}', [RatingsController::class, 'getBooksByAuthor']);
```

## Application Pages

### 1. Books List (`/`)
- Default view shows top 10 books by average rating
- Filter options:
  - **Show**: Dropdown (10, 20, 30, ..., 100 items per page)
  - **Search**: Text input for book name or author name
- Results ordered by average rating (highest to lowest)

### 2. Top Authors (`/authors-top`)
- Displays top 10 authors by vote count
- Only includes votes with ratings greater than 5
- Shows author name and vote count

### 3. Add Rating (`/rating/create`)
- Dropdown for selecting author
- Dropdown for selecting book (dynamically loaded via AJAX based on selected author)
- Dropdown for rating (1-10)
- Uses AJAX endpoint: `/books/by-author/{author}` to fetch books by author
- Redirects to books list after successful submission

## Key Features Implementation

### AJAX Book Loading
The rating page uses AJAX to dynamically load books based on selected author:
- When user selects an author, JavaScript makes a request to `/books/by-author/{author}`
- This provides better user experience and faster loading
- Ensures only books from selected author are shown

### Optimized Book Rating System
- Books table includes `avg_rating` column for performance
- Average rating is calculated and stored to avoid real-time calculations
- Improves query performance on large datasets

### Fake Data Generation
All fake data is generated using Laravel's Factory classes with Faker library:

```bash
# Seeder runs automatically when you execute:
php artisan db:seed
```

### No Caching
As per requirements, no caching mechanisms are implemented in this application.

### MySQL Database
The application uses MySQL as the primary database without providing dump files.

## Troubleshooting

### Common Issues

1. **Migration Errors**
   - Ensure MySQL is running
   - Check database credentials in `.env`
   - Verify database exists

2. **Seeding Takes Too Long**
   - This is normal due to large dataset (500,000 ratings)
   - You can reduce numbers in `DatabaseSeeder.php` for testing

3. **Memory Limit Issues**
   - Increase PHP memory limit in `php.ini`:
     ```ini
     memory_limit = 4098M
     ```

## Testing the Application

1. Visit `http://localhost:8000` - should show books list
2. Use search functionality to filter books
3. Change pagination settings
4. Visit `/authors-top` to see top authors
5. Visit `/rating/create` to add new ratings
6. Test AJAX functionality: select author and see books load dynamically
7. Verify data updates after adding ratings

## Performance Notes

- Initial load may be slow due to large dataset
- Search queries are optimized with proper indexing
- Pagination is implemented for better performance

## Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── BookController.php
│   │   ├── AuthorController.php
│   │   └── RatingsController.php
│   ├── Models/
│   │   ├── Author.php
│   │   ├── Book.php
│   │   ├── Category.php
│   │   └── Rating.php
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
├── resources/views/
└── routes/web.php
```

## Submission Notes

This project fulfills all requirements specified in the programming exam:
- ✅ Laravel 10+ with PHP 8.1+
- ✅ MySQL database
- ✅ Fake data generation (1K authors, 3K categories, 100K books, 500K ratings)
- ✅ Three main pages with specified functionality
- ✅ No caching implementation
- ✅ No database dump files provided
