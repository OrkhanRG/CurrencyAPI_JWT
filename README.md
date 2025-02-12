# Currency Rates API with JWT Authentication

## About the Project

This project provides APIs secured with JWT (JSON Web Token) authentication. The API retrieves currency exchange rate data from the Central Bank of Azerbaijan (CBAR) for a given date and returns it in JSON format. It also implements JWT-based authentication for user registration and login.

## Features

- **Registration** (POST /api/register): Allows users to register.
- **Login** (POST /api/login): Allows users to log in.
- **Currency Rates** (GET /api/currency-rates): Retrieves currency exchange rates for a given date.
- **JWT Authentication**: All API requests are secured with JWT.

## Technologies Used

- Laravel 11
- JWT Authentication
- CBAR (Central Bank of Azerbaijan) API for retrieving XML data
- Cache functionality
- FormRequest and Validation

## Setup

### 1. Clone the Repository and Install Dependencies

Clone the repository and navigate to the project folder:

```bash
git clone https://github.com/yourusername/currency-rates-api.git
cd currency-rates-api
composer install
```


### 2. Create and Configure .env File

Create the `.env` file in the project root and configure it with the following details:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:your-key
APP_DEBUG=true
APP_URL=http://127.0.0.1

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

JWT_SECRET=your_jwt_secret
```

- Generate a JWT secret by running the following command:

```bash
php artisan jwt:secret
```

### 3. Run Migrations

```bash
php artisan migrate
```

### 4. Start the API

```bash
php artisan serve
```

## API Usage

### 1. User Registration
- Endpoint: 

```bash
            POST /api/register
```

- Parameters:

```bash
    name: User name (string, required)
    email: Email address (string, required, unique)
    password: Password (string, required, minimum 8 characters)
```

- Successful Response:

```bash
{
    "token": "your_jwt_token"
}
```

- Error Response:

```bash
{
    "message": "Invalid format of input parameters!",
    "errors": {
        "email": ["This email is already registered."]
    }
}
```

### 2. User Login
- Endpoint: 

```bash
            POST /api/login
```

- Parameters:

```bash

    email: Email address (string, required)
    password: Password (string, required)
```

- Successful Response:
```bash
{
    "token": "your_jwt_token"
}
```
- Error Response:
```bash
{
    "message": "Invalid credentials."
}
```

### 3. Get Currency Rates
- Endpoint: 
```bash
            GET /api/currency-rates
```

- Parameters:
```bash
            date: Date in the format YYYY-MM-DD (optional, default is today's date)
```
- Authentication: Requires a valid JWT token in the Authorization header.

- Successful Response:
```bash
{
    "date": "2025-02-05",
    "rates": {
        "USD": "1.7",
        "EUR": "1.85",
        "GBP": "2.15"
    }
}
```

- Error Response:
```bash
{
    "message": "CBAR connection failed.",
    "error": 500
}
```

## Note:
### All endpoints are in the postman export in the public/postman_collections folder
