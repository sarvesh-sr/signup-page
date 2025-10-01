# Signup Page Project

A responsive web application with user registration functionality built with HTML, CSS (Bootstrap), JavaScript (jQuery), and PHP with MySQL database integration.

## Project Structure

```
signup-page/
├── index.html              # Main dashboard page
├── login.html              # User login page
├── profile.html            # User profile page
├── register.html           # User registration page
├── hlo/                    # Alternative version directory
│   ├── index.html
│   ├── login.html
│   ├── profile.html
│   ├── register.html
│   └── js/
│       └── register.js
├── js/
│   └── register.js         # Registration form JavaScript
└── php/
    └── register.php        # User registration backend
```

## Features

- **User Registration**: Secure user registration with email, password, and mobile number
- **Form Validation**: Client-side and server-side validation
- **Responsive Design**: Bootstrap-powered responsive UI
- **Database Integration**: MySQL database for user data storage
- **Password Security**: Hashed password storage using PHP's `password_hash()`
- **AJAX Form Submission**: Seamless form submission without page refresh
- **Error Handling**: Comprehensive error messages and validation feedback

## Technologies Used

- **Frontend**: HTML5, CSS3, Bootstrap 5.3.8, jQuery 3.7.1
- **Backend**: PHP 8.x
- **Database**: MySQL
- **Server**: XAMPP/LAMPP

## Setup Instructions

### Prerequisites

- XAMPP/LAMPP installed
- MySQL server running
- Web server (Apache) running

### Database Setup

1. Create a MySQL database named `web_app`
2. Create a `users` table with the following structure:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Installation

1. Clone or download the project to your XAMPP/LAMPP htdocs directory:

   ```
   /opt/lampp/htdocs/signup-page/
   ```

2. Update database credentials in [`php/register.php`](php/register.php):

   ```php
   $servername = "localhost";
   $username = "your_db_username";
   $password = "your_db_password";
   $dbname = "web_app";
   ```

3. Start your XAMPP/LAMPP services (Apache and MySQL)

4. Access the application at: `http://localhost/signup-page/`

## File Descriptions

### HTML Files

- **[`index.html`](index.html)**: Main dashboard/home page
- **[`register.html`](register.html)**: User registration form with Bootstrap styling
- **[`login.html`](login.html)**: User login form (frontend only)
- **[`profile.html`](profile.html)**: User profile display page

### JavaScript Files

- **[`js/register.js`](js/register.js)**: Handles registration form submission, validation, and AJAX communication

### PHP Files

- **[`php/register.php`](php/register.php)**: Backend registration logic with database operations and validation

## Registration Form Validation

### Client-side Validation (JavaScript)

- Email format validation using regex
- Password minimum length (6 characters)
- Mobile number format (10-digit validation)

### Server-side Validation (PHP)

- Email format validation using `filter_var()`
- Password length validation
- Duplicate email check
- Database connection error handling

## Security Features

- Password hashing using PHP's `password_hash()` function
- Prepared statements to prevent SQL injection
