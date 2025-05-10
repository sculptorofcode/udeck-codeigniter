# Task Management System

A simple task management application built with CodeIgniter 4 and PHP 8+. This application allows users to register, login, and manage their tasks efficiently.

## Features

- **User Authentication**
  - User registration with name, email, and password
  - Secure login/logout functionality
  - Protected routes for authenticated users

- **Dashboard**
  - Overview of task statistics (pending, in-progress, completed)
  - Quick view of recent tasks
  - Quick access to create new tasks

- **Task Management**
  - Create new tasks with title, description, priority, status, and due date
  - View tasks with filtering by status (all, pending, in-progress, completed)
  - Edit existing tasks
  - Delete tasks
  - Task prioritization (low, medium, high)

## What is CodeIgniter?

This application is built on CodeIgniter 4, which is a PHP full-stack web framework that is light, fast, flexible and secure.
More information about CodeIgniter can be found at the [official site](https://codeigniter.com).

## Installation & Setup

1. **Clone the repository**

   ```bash
   git clone https://github.com/sculptorofcode/udeck-codeigniter.git
   cd udeck-codeigniter
   ```

2. **Install dependencies**

   ```bash
   composer install
   ```

3. **Configure environment**

   Copy the `env` file to `.env` and update the database settings:

   ```bash
   cp env .env
   ```

   Update the following settings in the `.env` file:

   ```
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost:8080/'
   
   database.default.hostname = localhost
   database.default.database = task_management
   database.default.username = root
   database.default.password = your_password
   ```

4. **Create the database**

   Create a MySQL database named `task_management`.

5. **Run migrations**

   ```bash
   php spark migrate
   ```

6. **Start the development server**

   ```bash
   php spark serve
   ```

   The application will be available at `http://localhost:8080`

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Security

- Passwords are securely hashed using PHP's `password_hash()`
- Form validation is implemented for all input
- CSRF protection is enabled
- Authentication checks for all protected routes

## Credits

- Built with [CodeIgniter 4](https://codeigniter.com/)
- Styled with [Bootstrap 5](https://getbootstrap.com/)
- Icons by [Font Awesome](https://fontawesome.com/)

## Project Structure

- **Models**
  - `UserModel.php`: Handles user authentication and data
  - `TaskModel.php`: Manages task CRUD operations

- **Controllers**
  - `Auth.php`: Handles user registration, login, and logout
  - `AuthController.php`: Base controller for authenticated routes
  - `Tasks.php`: Manages task listing, creation, editing, and deletion
  - `Dashboard.php`: Displays task statistics and recent tasks
  - `Home.php`: Routes to appropriate pages based on authentication status

- **Views**
  - `layouts/main.php`: Main layout template
  - `auth/login.php`: Login form
  - `auth/register.php`: Registration form
  - `dashboard.php`: Dashboard view
  - `tasks/index.php`: Task listing
  - `tasks/create.php`: Task creation form
  - `tasks/edit.php`: Task editing form

## Usage

1. **Register a new account**
   - Navigate to `/register`
   - Fill in your details and create an account

2. **Login**
   - Navigate to `/login`
   - Enter your credentials

3. **Dashboard**
   - View task statistics
   - See your most recent tasks
   - Quick access to task management

4. **Managing Tasks**
   - Create new tasks with the "New Task" button
   - View all tasks or filter by status
   - Edit tasks by clicking the edit button
   - Delete tasks when no longer needed

## Server Requirements

PHP version 8.0 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- json (enabled by default)
- [mysqli](http://php.net/manual/en/mysqli.installation.php) for database operations
