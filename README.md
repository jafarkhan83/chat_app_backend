# Chat App Backend

This is the backend API for a real-time Chat Application. It is built with the [Laravel](https://laravel.com) PHP framework and serves as the core backend structure for managing users, chat rooms, and real-time messaging.

## Features

- **User Authentication:** Register, login, and secure API access using Laravel Sanctum.
- **Real-Time Messaging:** Event broadcasting integration (e.g., Pusher, Laravel WebSockets, or Laravel Reverb) to deliver real-time messages.
- **Conversations & Groups:** Support for one-on-one direct messages and group chats.
- **RESTful API:** Predictable resource-oriented URLs and standard JSON responses.

## Requirements

- PHP 8.1+
- Composer
- A Database (MySQL, PostgreSQL, or SQLite)
- Node.js & NPM (for broadcasting setup if applicable)

## Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone <your-repository-url>
   cd chat_app_backend
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Environment Setup:**
   Copy the example `.env` file and set your local environment variables (like database credentials and broadcast drivers).
   ```bash
   cp .env.example .env
   ```

4. **Generate the application key:**
   ```bash
   php artisan key:generate
   ```

5. **Run the database migrations:**
   ```bash
   php artisan migrate
   ```

6. **Serve the application:**
   ```bash
   php artisan serve
   ```

## License

This project is open-sourced software licensed under the MIT license.
