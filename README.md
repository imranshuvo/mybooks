# অক্ষর (Okkhor)

A family library management system built with Laravel 12.

## About

অক্ষর (meaning "letter" in Bengali) is a personal book collection manager designed for family use. It helps you organize, track, and discover books from your home library.

## Features

- **📚 Book Management** - Add, edit, and organize your book collection with cover images
- **👨‍👩‍👧‍👦 Multi-User Support** - Family members can collaborate together
- **📖 Reading Progress** - Track what page you're on and your reading status
- **🔄 Lending System** - Record who borrowed books and when they're due back
- **📝 Collaborative Notes** - Add notes and comments on books
- **🔍 Search & Filter** - Find books by title, author, language, category, or status
- **📊 Statistics Dashboard** - View library analytics and insights
- **📄 PDF Export** - Export your complete collection as a PDF

## Tech Stack

- **Framework**: Laravel 12
- **Frontend**: Blade templates with Tailwind CSS
- **Authentication**: Laravel Breeze
- **Database**: MySQL
- **Build Tool**: Vite

## Installation

```bash
# Clone the repository
git clone <repository-url>
cd mybooks

# Install dependencies
composer install
npm install

# Configure environment
cp .env.example .env
php artisan key:generate

# Set up database
php artisan migrate

# Create storage link for cover images
php artisan storage:link

# Build assets
npm run build

# Start the server
php artisan serve
```

## Configuration

Update your `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mybooks
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Usage

1. Log in with your account
2. Add books to your collection with details like title, author, ISBN, and cover image
3. Track your reading progress on each book
4. Record when you lend books to others
5. Add notes and collaborate with family members
6. View statistics about your library

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
