# User Management System

A user management system built with Laravel, Livewire, and Tailwind CSS that provides CRUD operations for user administration.

---

## Overview

This application provides a secure and efficient way to manage user records with the following features:

- User authentication and authorization
- Complete CRUD operations for user management
- **Fully responsive design** using Tailwind CSS
- **Real-time updates** powered by Livewire and Soketi
- Secure password handling

---

## Tech Stack

- **Backend Framework:** Laravel 10.x
- **Frontend:**
  - Livewire 3.x for reactive components
  - Tailwind CSS for styling
- **WebSocket Server:** Soketi for real-time updates
- **Database:** MySQL
- **Authentication:** Laravel Built-in Auth

---

## Prerequisites

Make sure you have the following installed on your system:

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL
- Soketi (can be installed globally via npm)

---

## Installation

1. **Clone the Repository**:

```bash
git clone https://github.com/juans-castellanosr/unbc_abm.git
cd unbc_abm
```

2. **Install PHP Dependencies**:

```bash
composer install
```

3. **Install NPM Dependencies**:

```bash
npm install
npm run build
```

4. **Configure Environment Variables**:

```bash
cp .env.example .env
php artisan key:generate
```

5. **Set Up Database Configuration**:
   Edit the `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

6. **Run Database Migrations**:

```bash
php artisan migrate
```

7. **Run Seeders** (if applicable):

```bash
php artisan db:seed
```

8. **Start Soketi** (in a separate terminal):

```bash
npm install -g @soketi/soketi
soketi start
```

---

## Running the Application

Start the development server:

```bash
composer run dev
```

The application should now be accessible at `http://localhost:8000`.

---

## Features

### User Management

- Create new user accounts
- View user details
- Update user information
- Delete user accounts
- Search and filter users

### Responsive Design

- The application is fully responsive, ensuring a seamless user experience across devices, from desktops to smartphones.

### Real-Time Updates
  
- Live updates for user data through Livewire and Soketi integration.

### Authentication

- Secure login system
- Password reset functionality
- Session management

---

## Project Structure

The project follows the standard Laravel directory structure with additional organization for Livewire components:

- `app/Livewire/` - Contains all Livewire components
  - `Actions/` - Action-specific components
  - `Forms/` - Form-related components
- `app/Models/` - Database models
- `resources/views/livewire/` - Livewire component views
- `database/migrations/` - Database migrations

---

## Security

This application implements several security measures:

- Secure password hashing
- Input validation
- Authentication middleware

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
